<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\LinkedSocialAccount;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($socialProvider)
    {
        return Socialite::driver($socialProvider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback($socialProvider)
    {

        // interrogo il social network e mi faccio tornare le informazioni che immagazzino in $user
        try {
            $socialUser = Socialite::driver($socialProvider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $account = LinkedSocialAccount::whereSocialProviderName($socialProvider)->whereSocialProviderId($socialUser->getId())->first(); // cerco se le info tornare appartengono ad un utente
        if ($account) {
            $user = $account->user; // se trovo corrispondenza torna l'utente
        } else {
            $user = User::whereEmail($socialUser->getEmail())->first(); // altrimenti cerco un utente con l'email tornata dal social network

            $avatar = ($socialUser->avatar_original) ?? $socialUser->avatar;

            if(!$user){

                $user = User::create([
                    'email' => $socialUser->getEmail(),
                    'name'  => $socialUser->getName(),
                    'avatar' => $avatar
                ]);
            }

            // controllo se è la prima volta che mi associo un account social e se non ho settato un avatar custom
            if(!$user->custom_avatar && ($user->accounts()->count() == 0)){
                $user->update(['avatar' => $avatar]);
            }

            $user->accounts()->create([ // associo il social account all'utente appena creato o esistente
                'social_provider_id'   => $socialUser->getId(),
                'social_provider_name' => $socialProvider,
            ]);

        }

        auth()->login($user, true); // loggo l'utente

        return redirect()->route('dashboard');
    }

}
