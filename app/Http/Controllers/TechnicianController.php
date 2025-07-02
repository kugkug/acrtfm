<?php

namespace App\Http\Controllers;

use App\Mail\AcrtfmMailer;
use App\Models\Comment;
use App\Models\Discussion;
use App\Models\PasswordResetToken;
use App\Models\Ratings;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class TechnicianController extends Controller
{
    public function register(Request $request) {
        // dd($request->all());
        try {
            $validated = $request->validate([
                "fname" => ['required'],
                "lname" => ['required'],
                "email" => ['required', 'email', Rule::unique('users', 'email')],
                "contact" => ['required'],
                "company" => ['sometimes'],
                "password" => 'required|confirmed|min:6',
                'password_confirmation' => 'min:6'
            ],
            [
                'fname.required'    => 'Firstname is required',
                'lname.required'    => 'Lastname is required',
                'email.required'    => 'Email Address is required',
                'contact.required'    => 'Contact number is required',
                'password.required'    => 'Password is required!',
            ]);

            if (! $this->validatePhoneNumber($validated['contact']) ) {
                return back()->withInput()->withErrors(['error_msg' => 'Invalid phone number']);
            }

            $user_data = [
                'name' => $validated['fname'] . " " . $validated['lname'],
                'email' => $validated['email'],
                'contact' => $validated['contact'],
                'company' => $validated['company'],
                'user_type' => 'client',
                'is_hvac_tech' => 'Yes',
                'status' => 'active',
                'password' => Hash::make($validated['password']),
            ]; 
            $user = User::create($user_data);

            return redirect("/login");
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error_msg' => $e->getMessage()]);
        }   
    }

    public function login(Request $request) {
        
        $validated = $request->validate([            
            "email" => ['required', 'email'],
            "password" => 'required'
        ]);

        // $validated['user_type'] = "client";

        if (auth()->attempt($validated)) {
            $request->session()->regenerateToken();
            return redirect("/home");
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgot_password(Request $request) {
        
        try {
            $validated = $request->validate([ "email" => ['required', 'email'] ]);
            $user = User::where('email', $validated['email'])->get()->first();
            
            if ($user) {
                $token = bin2hex(random_bytes(32));
                $body = URL::to("/"."reset-password?token=".$token);
                $content = [
                    'type'=> 'fp',
                    'subject' => 'Password Reset Request',
                    'body' => $body,
                    'name' => $user->name,
                ];
                
                PasswordResetToken::create([
                    'email' => $validated['email'],
                    'token' => $token,
                    'is_enabled' => 1,
                    'created_at' => now()
                ]);
                Mail::to($validated['email'])->send(new AcrtfmMailer($content));
                return back()->with('message','We have send a link to reset your password, please check your email.');
            } else {
                return back()->withInput()->withErrors(['error_msg' => "Email not found!"]);
            }

        } catch (Exception $e) {
            
            return back()->withInput()->withErrors(['error_msg' => 'Failed to continue.']);
        }
    }

    public function reset_password(Request $request) {
        $email = Session::get('user_email');

        try {
            $validated = $request->validate([
                "password" => 'required|confirmed|min:6',
                'password_confirmation' => 'min:6'
            ]);

            User::where('email', $email)->update( ["password" => Hash::make($validated['password'])] );
            PasswordResetToken::where('email', $email)->update( ['is_enabled' => 0] );

            return redirect("/");
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error_msg' => $e->getMessage()]);
        }
    }

    public function post(Request $request) {
        
        try {
            
            if (trim($request->post) === "") {
                 return 'toastr.error("Empty post is not allowed!")';
            }
            
            $post_data = [
                'user_id' => Auth::id(),
                "post" => trim( nl2br($request->post) ),
                'is_notification_enabled' => (int) $request->is_notification_enabled,
            ];
            
            Discussion::create($post_data);
            
            return 'location.reload();';
        } catch(Exception $e) {
            return 'toastr.error("Failed to continue, please try again later!");';
            // return json_encode([
            //     'status' => 'error',
            //     'message' => 'Failed to continue, please try again later',
            // ], 500);
        }
    }

    public function posts(Request $request) {
        try {
            $posts = Discussion::orderBy('created_at', 'desc')->paginate(10)->toArray();
            $formatted_post = Discussion::formatDiscussions($posts);
            
            return $formatted_post;
        } catch(Exception $e) {
            
            return json_encode([
                'status' => 'error',
                'message' => 'Failed to continue, please try again later',
            ], 500);
        }
    }

    public function comment(Request $request) {
        try {
            $posts = Discussion::where('id', $request->discussion_id)->get()->first();
            if ($posts) {
                $user = User::where('id', $posts->user_id)->get()->first();
                $comment_data = [
                    'user_id' => Auth::id(),
                    "discussion_id" => $request->discussion_id,
                    "comment" => trim( nl2br( $request->comment ) ),
                ];
                Comment::create($comment_data);

                $content = [
                    'type'=> 'pn',
                    'subject' => 'Notification',
                    'link' => URL::to("/"."discussions?comment_id=".$request->discussion_id),
                ];

                if ($posts->is_notification_enabled === 1) {
                    Mail::to($user->email)->send(new AcrtfmMailer($content));
                }
                
                return back();
            } else {
                return back();
            }
        } catch(Exception $e) {
            // return json_encode([
            //     'status' => 'error',
            //     'message' => 'Failed to continue, please try again later' . $e->getMessage(),
            // ], 500);
        }
    }

    public function delete_comment(Request $request) {
        try {
            
            Comment::find($request->comment_id)->delete();
            
            return back();
        } catch(Exception $e) {
            
            // return json_encode([
            //     'status' => 'error',
            //     'message' => 'Failed to continue, please try again later' . $e->getMessage(),
            // ], 500);
        }
    }

    public function delete_post(Request $request) {
        try {
            
            Discussion::where('id',$request->post_id)->delete();
            
            return back();
        } catch(Exception $e) {
            
            // return json_encode([
            //     'status' => 'error',
            //     'message' => 'Failed to continue, please try again later' . $e->getMessage(),
            // ], 500);
        }
    }

    public function search_comment(Request $request) {
        try {
            $posts = Discussion::where('post', 'like', '%'.$request->input('keyword').'%')
            ->orderBy('created_at', 'desc')->paginate(10);

            if ($posts) {
                $formatted_post = Discussion::formatDiscussions($posts);
                
                $data = [
                    'title' => '', 
                    'header' => $this->headers['discussions']['title'] ?? "Discussions",
                    'posts' => $formatted_post,
                    'keyword' => $request->input('keyword')
                ];

                return view("clients.discussions", $data)->with("root_url", URL::current());
            } else {
                return view("clients.discussions", [])->with("root_url", URL::current());
            }
        } catch(Exception $e) {}
    }

    public function rate_comment(Request $request) {
        try {
            $rate = ['rate' => $request->rate];
            $rate_data =[
                'user_id' => Auth::id(),
                'comment_id' =>$request->comment_id
            ];

            Ratings::updateOrCreate($rate_data, $rate);
            
        } catch(Exception $e) {
            return 'toastr.error("Failed to continue, please try again later!'.$e->getMessage().'");';
        }
    }

    private function validatePhoneNumber($phone) {
        // Define the pattern for a phone number with optional country code
        $pattern = "/^\+?[0-9]{1,4}?[-.\s]?[0-9]{1,14}([-\s]?[0-9]{1,14}){0,2}$/";
        
        // Check if the phone number matches the pattern
        if (preg_match($pattern, $phone)) {
            return true;
        } else {
            return false;
        }
    }
}