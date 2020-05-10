<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Användarnamn och / eller lösenord är felaktigt']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city_id' => ['required', 'int'],
            'account_type_id' => ['required', 'int']
        ]);

        event(new Registered($user = $this->createAccount($request->all())));

        $this->guard()->login($user);

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return new Response($response, 201);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return
     */
    protected function createAccount(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'city_id' => $data['city_id'],
            'account_type_id' => $data['account_type_id'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function updatePassword(Request $request, User $user)
    {
        if(auth()->user()->cannot('update', $user)) {
            abort(401);
        }

        $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);

        Auth::user()->update(['password' => Hash::make($request->input('password'))]);

        return new Response([], 200);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
