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
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        // interrogo il social network e mi faccio tornare le informazioni che immagazzino in $user
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        //dd($socialUser);

        $account = LinkedSocialAccount::whereProviderName($provider)->whereProviderId($socialUser->getId())->first(); // cerco se le info tornare appartengono ad un utente
        if ($account) {
            $user = $account->user; // se trovo corrispondenza torna l'utente
        } else {
            $user = User::whereEmail($socialUser->getEmail())->first(); // altrimenti cerco un utente con l'email tornata dal social network

            if(!$user){
                $user = User::create([
                    'email' => $socialUser->getEmail(),
                    'name'  => $socialUser->getName(),
                    'avatar' => $socialUser->avatar_original
                ]);
            }

            // controllo se è la prima volta che mi associo un account social e se non ho settato un avatar custom
            if(!$user->custom_avatar && ($user->accounts()->count() == 0)){
                $user->update(['avatar' => $socialUser->avatar_original]);
            }

            $user->accounts()->create([ // associo il social account all'utente appena creato o esistente
                'provider_id'   => $socialUser->getId(),
                'provider_name' => $provider,
            ]);

        }

        auth()->login($user, true); // loggo l'utente

        return redirect()->route('dashboard');
    }

}
