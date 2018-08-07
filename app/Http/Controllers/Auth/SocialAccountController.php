<?php

namespace App\Http\Controllers\Auth;

//use App\SocialAccountService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\LinkedSocialAccount;
use Laravel\Socialite\Contracts\User as ProviderUser;

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

        $account = LinkedSocialAccount::whereProviderName($provider)->whereProviderId($socialUser->getId())->first(); // cerco se le info tornare appartengono ad un utente
        if ($account) {
            $user = $account->user; // se trovo corrispondenza torna l'utente
        } else {
            $user = User::whereEmail($socialUser->getEmail())->first(); // altrimenti cerco un utente con l'email tornata dal social network

            if (!$user) { // se l'utente non esiste lo creo
                $user = User::create([
                    'email' => $socialUser->getEmail(),
                    'name'  => $socialUser->getName(),
                ]);
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
