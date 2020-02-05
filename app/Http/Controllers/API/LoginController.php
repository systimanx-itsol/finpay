<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Dashboard; 
use Response;
use Auth;
use Hash;




class LoginController extends Controller
{
    /**
     *
     * @SWG\Post(
     *     path="/login",
     *     description="Login",
     *     tags={"LOGIN"},
     *     summary="Login",
     *      @SWG\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          description="password",
     *          required=true,
     *          type="string",in="formData",
     *      ),
     *    
     *    @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *  security={
     *           {"Bearer": {}}
     *       }
     * )
     * )
     */

    public function login(Request $request)
    {
        //$inputs = file_get_contents("php://input");
         $formData = $request->all();
       
       // $data = json_decode($inputs);
        $email = $request->email;
        $password = $request->password;

         $user = User::where('email', $email)->first();
            

       

          
 
         // echo"<pre>";print_r($user);exit();

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            //  echo"<pre>";print_r($token);exit();
            $results = array(
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            );
      

           // echo"<pre>";print_r($results);exit();
            return response::json(array('status' => 1, 'message' => 'User LoggedIn successfully..', 'result' => $results), 200)
                        ->header('token', $token);
        }
        else{
            return response::json(array('status' => 0, 'message' => 'invalid email or password'));
        }
    }

    public function register(){
        $inputs = file_get_contents("php://input");
        $data = json_decode($inputs);
        $email = $data->email;
        $password = $data->password;
        $name = $data->name;
        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password)
        ]);
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            $results = array(
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            );
            return response::json(array('status' => 1, 'message' => 'User LoggedIn successfully..', 'result' => $results), 200)
                        ->header('token', $token);
        }
        else{
            return response::json(array('status' => 0, 'message' => 'invalid email or password'));
        }
    }
}