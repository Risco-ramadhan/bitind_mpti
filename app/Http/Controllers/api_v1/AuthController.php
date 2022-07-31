<?php

namespace App\Http\Controllers\api_v1;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Notifications\VerifyEmailCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use JWTFactory;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'resend']]);
    } //end __construct()


    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'    => 'required|email',
                'password' => 'required|string|min:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'validation error',
                    'data'     => 400
                ],
                400

            );
        }

        $token_validity = (24 * 60);

        $this->guard()->factory()->setTTL($token_validity);

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    } //end login()


    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fullname'          => 'required|string|between:2,100',
                'email'             => 'required|email|unique:users',
                'password'          => 'required|min:6',
                'bussiness_name'    => 'required|string|between:2,100',
                'id_country'        => 'required|numeric|exists:countries,id',
                'id_city'           => 'required|numeric|exists:indonesia_cities,id',
                'phone_number'      => 'required|numeric',
                'role'              => 1,

            ]
        );


        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'Error',
                    'message' => 'Validation Error',
                    'data' => $validator->errors(),
                    'ErrorCode' => 422,
                ],
                422
            );
        }
        if (is_string($rule)) { //2 isnt a string
            return explode('|', $rule);
        } elseif (is_object($rule)) { //2 isnt an object
            return [$this->prepareRule($rule)];
        }

        return array_map([$this, 'prepareRule'], $rule); //rule here is an integer = fail





        $user = User::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );

        $user->generateEmailCode();
        // $user->notify(new VerifyEmailCode());

        $token_bearer = $user->createToken('authoken');
        event(new Registered($user));
        //coba
        $token_validity = (24 * 60);

        $this->guard()->factory()->setTTL($token_validity);

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
        //coba

        //     return response()->json([
        //         'status'        => 'succes',
        //         'message'       => 'User Created successfully',
        //         'data'          => $user,
        //         'token_verify'  => $token_bearer ->plainTextToken
        //     ],
        //     201
        // );
    } //end register()


    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'User logged out successfully']);
    } //end logout()



    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    } //end refresh()


    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'status' => 'Success',
                'message' => 'Login successfully',
                'data' => [
                    'token'          => $token,
                    'token_type'     => 'bearer',
                    'token_validity' => ($this->guard()->factory()->getTTL() * 60),

                ]

            ]
        );
    } //end respondWithToken()


    protected function guard()
    {
        return Auth::guard();
    } //end guard()

    // public function resend(Request $request)
    // {
    //     $user = User::where('email',$request->email)->first();
    //     $user->generateEmailCode();
    //     $user->notify(new VerifyEmailCode());

    //     die;
    //     $data = array('email' => $email, );
    //     $validator = Validator::make(
    //         $data,
    //         [
    //             'email'             => 'required|email|exists:users,email',
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return response()->json(
    //             [
    //                 'status' => 'Error',
    //                 'message' => 'Validation Error',
    //                 'data' => $validator->errors(),
    //                 'ErrorCode' => 422,
    //             ],
    //             422
    //         );
    //     }
    //     $user = auth()->user();


    //     //$user = User::find($request->email);
    //     return print_r($user);
    //     dd($user->email);
    //     $user->generateEmailCode();
    //     $user->notify(new VerifyEmailCode());

    //     $token_bearer = $user->createToken('authoken');
    //     event(new Registered($user));

    //     return response()->json([
    //         'status'        => 'succes',
    //         'message'       => 'Resend successfully',
    //         'data'          => $user,
    //         'token_verify'  => $token_bearer ->plainTextToken
    //     ],
    //     201);
    // }

    // public function resend(Request $request)
    // {
    //     $user = User::where('email',$request->email)->first();
    //     $user->generateEmailCode();
    // }



    public function resend(Request $request)
    {
        $user =  $request->Auth::user();
        //$user = User::find($request->route('email'));
        //$user->generateEmailCode();
        dd($user);
        $user->notify(new VerifyEmailCode());

        return response()->json([
            'status' => 'success',
            'data' => null,
            'message' => 'Email Verified successfully',
        ]);
    }
}//end class
