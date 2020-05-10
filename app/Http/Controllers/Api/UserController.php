<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
//        $validated_data = request()->validate([
//            'title' => 'required|max:255|string',
//            'ingress' => 'required|max:255|string',
//            'content' => 'required|string',
//            'type_id' => 'required|integer',
//            'email' => 'required|email|unique:posts',
//            'phone' => 'nullable|string',
//            'website' => 'nullable|url',
//        ]);
//
//        try {
//            $post = new Post();
//            $post->user_id = $request->user()->id;
//            $post->city_id = $request->user()->city_id;
//            $post->title = $request->input('title');
//            $post->ingress = $request->input('ingress');
//            $post->content = $request->input('content');
//            $post->type_id = $request->input('type_id');
//            $post->email = $request->input('email');
//            $post->phone = $request->input('phone');
//            $post->website = $request->input('website');
//            $post->published = true;
//
//            $post->save();
//
//        } catch (\Exception $e) {
//            return response('Något gick fel när inlägget skulle sparas. Var vänlig prova igen.', 500);
//        }
//
//        return response($post, 201);
    }

    public function getUser() {
        $user = Auth::user();

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->validate([
            'first_name' => 'required|max:255|string',
            'last_name' => 'required|max:255|string',
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'city_id' => 'required|integer',
            'account_type_id' => 'required|integer',
        ]));

        return response($user->fresh(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
