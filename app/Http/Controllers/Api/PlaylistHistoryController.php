<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaylistHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistHistoryController extends Controller
{
    public function save(Request $request) {
        PlaylistHistory::updateOrCreate(['user_id' => Auth::id()], ['education_id' => $request->education_id]);
    }
}