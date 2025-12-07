<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students_table;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function stu_reg_log(){
        return view('stu_reg_log');
    }

    function userindex1()
    {
        return view('change_password');
    }
    function Datainsert(Request $request){

        try {
            $validatedData = $request->validate([
                'username' => 'required|unique:students,username',
                'password' => 'required|min:8|max:15',
                'confirm_password' => 'required|min:8|max:15|same:password',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();
    
            echo '<br><h2 style="color: red;">You cannot register due to following errors :</h2><br>';
            foreach ($errorMessages as $errorMessage) {
                echo '<center>' . '<h1>'. $errorMessage . '<br>' . '</h1>' . '</center>';
            }
    
            return;
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        $hashedPassword = Hash::make($request->input('password'));

        $isinsertsuccessfull = students_table::insert(['name'=>$name, 'email'=>$email, 'username'=>$username, 'password'=>$hashedPassword, 'confirm_password'=>$confirm_password]);

            // if($isinsertsuccessfull) echo '<h1>Account created successfully...</h1>';
            // else echo '<h1>Failed to create account</h1>';

        if($isinsertsuccessfull)
        {
            return redirect()->route('student_dashboard');
        }  
        else
        {
            echo '<h1>Failed to create account</h1>';
        } 

    }

    function changepassword(Request $request)
    {
        // echo "hello from the changepassword";
        try {
            $validatedData = $request->validate([
                'username' => 'required|exists:students,username',
                'password' => 'required|min:8|max:15',
                'n_password' => [
                    'required',
                    'min:8',
                    'max:15',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($value === $request->input('password')) {
                            $fail('New password must be different from the current password field.');
                        }
                    },
                ],        
                'confirm_password' => 'required|min:8|max:15|same:n_password',
            ],
            [
                'confirm_password.same' => 'The confirm password and new password must match.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->all();
    
            echo '<br><h2 style="color: red;">Here are following errors :</h2><br>';
            foreach ($errorMessages as $errorMessage) {
                echo '<center>' . '<h1>'. $errorMessage . '<br>' . '</h1>' . '</center>';
            }
    
            return;
        }
        $username = $request->input('username');
        $password = $request->input('password');
        $newpassword = $request->input('n_password');
        $cnewpassword = $request->input('confirm_password');

        $hashedPassword = Hash::make($request->input('n_password'));

        $user = students_table::where('username', $username)->first();
    
        if ($user) {
            // echo "<br>Username is valid...";
    
            if (Hash::check($password, $user->password)) {
                echo "<br>Password match...";
            } else {
                echo "<br>Password not match";
                // echo "<br>Provided Password: " . $password;
                // echo "<br>Hashed Password from Database: " . $user->password;
            }
        } else {
            echo "<br>Username is invalid...";
        }
        $isupdatesuccessfull = students_table::where('username', $username)->update(['password' => $hashedPassword,'confirm_password' => $cnewpassword,]);
        if($isupdatesuccessfull) echo '<h1>Account updated successfully...</h1>';
            else echo '<h1>Failed to update account</h1>';
    }
    
    function Loginuser(Request $request){
        // echo "Hello from Loginuser function";
        $username = $request->input('username');
        $password = $request->input('password');
        
        $user = students_table::where('username', $username)->first();
    
        if ($user) {
            // echo "<br>Username is valid...";
    
            if (Hash::check($password, $user->password)) {
                echo "<br>Password match...";
                echo "<center><h1>WELCOME TO OUR HOME PAGE</h1></center>";
                return redirect()->route('student_dashboard');
                // return redirect()->route('stu_dashboard');
            } else {
                echo '<h2 style="color: red; margin:0 0 0 50px;">'. "<br><br>Error Occured :" . '</h2>' . '<center>' . '<h1>'. "<br>Incorrect Password" . '<br>' . '</h1>' . '</center>'; 
                // echo "<br>Provided Password: " . $password;
                // echo "<br>Hashed Password from Database: " . $user->password;
            }
        } else {
            echo '<h2 style="color: red; margin:0 0 0 50px;">'. "<br><br>Error Occured :" . '</h2>' . '<center>' . '<h1>'. "<br>Username is invalid..." . '<br>' . '</h1>' . '</center>'; 
        }
    }

    function student_dashboard()
    {
        return view('student_dashboard');
    }
    
}
