<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Exception;
use Auth;

class FacebookController extends Controller
{
    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function redirectToFacebook()

    {

         // return url('auth/facebook');

        return Socialite::driver('facebook')->redirect();

    }


    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleFacebookCallback()

    {

        try {

            $user = Socialite::driver('facebook')->user();

            $create['name'] = $user->getName();

            $create['email'] = $user->getEmail();

            $create['facebook_id'] = $user->getId();


            $userModel = new User;

            $createdUser = $userModel->addNew($create);

            Auth::loginUsingId($createdUser->id);


            return redirect('/');


        } catch (Exception $e) {


            return redirect('auth/facebook');


        }

    }
}
