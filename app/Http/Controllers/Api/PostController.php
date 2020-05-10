<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param City $city
     * @param int $postType
     * @return void
     */
    public function index(Request $request, City $city, $postType = 1)
    {
        $posts = Post::where('city_id', $city->id)->where('type_id', $postType)->get();

        $posts->load('city');

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validated_data = request()->validate([
            'title' => 'required|max:255|string',
            'ingress' => 'required|max:255|string',
            'content' => 'required|string',
            'type_id' => 'required|integer',
            'email' => 'required|email|unique:posts',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        try {
            $post = new Post();
            $post->user_id = $request->user()->id;
            $post->city_id = $request->user()->city_id;
            $post->title = $request->input('title');
            $post->ingress = $request->input('ingress');
            $post->content = $request->input('content');
            $post->type_id = $request->input('type_id');
            $post->email = $request->input('email');
            $post->phone = $request->input('phone');
            $post->website = $request->input('website');
            $post->published = true;

            $post->save();

        } catch (\Exception $e) {
            return response('Något gick fel när inlägget skulle sparas. Var vänlig prova igen.', 500);
        }

        return response($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getUserPost(User $user)
    {
        $post = Post::where('user_id', $user->id)->latest()->first();

        return response($post, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getPost(Request $request, Post $post)
    {
        return response($post, 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->validate([
            'title' => 'required|max:255|string',
            'ingress' => 'required|max:255|string',
            'content' => 'required|string',
            'type_id' => 'required|integer',
            'email' => ['required', 'email', 'unique:posts,email,' . $post->id],
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
        ]));

        return response($post->fresh(), 200);
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
