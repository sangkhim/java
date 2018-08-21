<?php

namespace App\Http\Controllers;

use App\Traits\PassportToken;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class UserRestController extends Controller
{

    use PassportToken;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $stoken = $request->get('token');
        $user = Socialite::driver($request->provider)->userFromToken($stoken);
        return response()->json($user, 200);

        // TODO: return refresh_token, access_token to client
        $authUser = $this->findOrCreateUser($user, $request->provider);
        return $this->getBearerTokenByUser($authUser, 1, true);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
