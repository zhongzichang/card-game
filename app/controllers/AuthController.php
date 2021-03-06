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
            return Response::json(array('success'=>true, 'message'=>'success'));
        } else {
            return Response::json(array('success'=>false, 'message'=>'fail to login, username or password not match'));
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
        if( Auth::check() ){
            return Response::json(array('logined' => true));
        } else {
            return Response::json(array('logined' => false));
        }
    }



}