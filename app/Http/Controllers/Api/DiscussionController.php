<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DiscussionController extends Controller
{
    public function list(Request $request): mixed {
        
        $posts = Discussion::orderBy('created_at', 'desc')->paginate(5);
        
        if ($posts) {
            return Discussion::createDiscussionTable($posts, $request->type);
        }

        return [];
    }
}