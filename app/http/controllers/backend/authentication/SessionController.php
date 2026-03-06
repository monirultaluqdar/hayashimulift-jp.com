<?php

namespace app\http\controllers\backend\authentication;

use app\http\requests\LoginRequest;
use core\Auth;
use core\Session;

class SessionController
{
    public function Hash()
    {
        echo hash_make("admin1234");
    }

    public function Create()
    {
        return view('backend/login');
    }

    public function Store(LoginRequest $req)
    {
        $arr = [
            'email' => $req->request('email'),
            'password' => $req->request('password'),
        ];

        $status = attempt($arr);

        if (!$status) {
            Session::flash('message', 'Credential is not correct !! Try again with correct credential !!');

            return back();
        }

        redirect('/admin/dashboard');
    }

    public function showForgotPasswordForm()
    {
        return view('backend/forgot_password');
    }

    public function forgotPassword()
    {
        $old_password = $_POST['old_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Validation
        $errors = [];
        
        if(empty($old_password)){
            $errors[] = "Old password is required";
        }
        
        if(empty($new_password)){
            $errors[] = "New password is required";
        } elseif(strlen($new_password) < 6){
            $errors[] = "New password must be at least 6 characters";
        }
        
        if(empty($confirm_password)){
            $errors[] = "Confirm password is required";
        } elseif($new_password !== $confirm_password){
            $errors[] = "New password and confirm password do not match";
        }

        // Check if old password matches current password
        if(empty($errors) && !Auth::validatePassword($old_password)){
            $errors[] = "Old password is incorrect";
        }

        if(!empty($errors)){
            Session::flash('errors', $errors);
            return back();
        }

        // Update password
        $user = Auth::user();
        $user_model = \app\http\models\User::find($user['id']);
        $user_model->update(['password' => hash_make($new_password)]);

        Session::flash('success', "Password updated successfully!");
        return redirect("/admin/dashboard");
    }

    public function Destroy()
    {
        // logout();

        Auth::logout();

        redirect('/session/create');
    }
}
