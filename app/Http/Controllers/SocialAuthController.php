<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{


    private function createOrUpdateUser($user, $provider)
    {

        try {
            $saveUser = User::updateOrCreate(
                ['provider_id' => $user->getId()],
                [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'provider' => $provider,
                    'avatar' => $user->avatar,

                ]
            );
            Auth::loginUsingId($saveUser->id);
            return redirect("/");
        } catch (Throwable $th) {
            toast($user->getEmail() . ' đã đăng nhập bằng phương thức khác', 'warning');
            return redirect('/login');
        }


        // $user = User::where('email', $userGoogle->email)->where('provider', $provider)->first();
        // if ($user) {
        //     $user->update([
        //         'provider' => $provider,
        //         'provider_id' => $userGoogle->id,
        //         'avatar' => $userGoogle->avatar,
        //     ]);
        // } else {
        //     $user = User::create([
        //         'name' => $userGoogle->name,
        //         'email' => $userGoogle->email,
        //         'provider' => $provider,
        //         'provider_id' => $userGoogle->id,
        //         'avatar' => $userGoogle->avatar,
        //     ]);
        // }
        // Auth::login($user);
    }

    function socialRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    function socialCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        return $this->createOrUpdateUser($user, $provider);
    }
}
