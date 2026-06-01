<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function authenticated(Request $request, $user)
    {
        $role = $user->roles->first();

        if ($role) {
            switch ($role->name) {
                case 'admin':
                    return redirect('/evento/dashboard');
                case 'organizer':
                    return redirect('/evento-org/account');
                case 'spectator':
                    return redirect('user/home')->with('status', "Welcome Back find a Tickets!");
                default:
                    return redirect($this->redirectTo);
            }
        } else {
            return redirect($this->redirectTo)->with('status', 'Your account does not have role assigned. Please contact administrator.');
        }
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $userExisted = User::where('oauth_id', $socialUser->id)->first();

            if ($userExisted) {
                Auth::login($userExisted);
                return redirect('user/home');
            } else {
                $newUser = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'oauth_id' => $socialUser->id,
                    'password' => Hash::make($socialUser->id),
                ]);

                $profilePictureUrl = $socialUser->getAvatar();
                $newUser->avatar = $profilePictureUrl;
                $newUser->save();

                $newUser->roles()->attach(3);

                Auth::login($newUser);

                return redirect('user/home');
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}
