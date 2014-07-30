<?php


class AuthController extends Controller {

    // --- login ---

    public function getLogin(){
        return View::make('login');
    }


    public function postLogin(){

        
        $username = Input::get('username');
        $password = Input::get('password');

        // remember me
        if( Auth::attempt(array('username'=>$username, 'password'=>$password), true)){
            // login successful
            return Redirect::intended('demo');
        } else {
            return Redirect::route('login');
        }
    }


    // --- register ---

    public function getRegister(){
        return View::make('register');
    }


    public function postRegister(){

        $username = Input::get('username');
        $password = Input::get('password');

        $user = new User;
        $user->username = $username;
        $user->password = Hash::make($password);

        $user->save();
        
    }
    
    // --- logout ---
    public function getLogout(){
        Auth::logout();
        Redirect::to('/');
    }

    // --- check ---
    public function getCheck(){
        if( !Auth::check() ){
            App::abort(401);
        }
    }



}