<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{

    public function __construct()
    {
    }

    /**
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        if(auth()->user()->cannot('update', $user)) {
            return response()->json([], 401);
        }

        $request->validate([
            'avatar' => ['required', 'image']
        ]);

        Storage::disk('public')->delete(auth()->user()->getOriginal('avatar'));

        auth()->user()->update([
            'avatar' => $request->file('avatar')->store('avatars', 'public')
        ]);

        return response()->json(['avatar' => $user->fresh()->avatar], 200);
    }
}
