<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\throwException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home($userDetails)
    {
        //
        return $userDetails;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        /* if $email  get to see if email exist

            route to index() -
        */

         $hashedPassword = Hash::make($request->password);

        if (isset($request->email) && isset($request->password)) {

            if (User::where('email', $request->email)->exists()) {

                $user = User::where('email', $request->email)->get();

                return response()->json([
                    "message" => "Login successful",
                    "data" => $user
                ], 200);

            } else {

                return response()->json([
                    "message" => "Wrong Email/Phone provided."
                ], 404);

            }
        }

         elseif (isset($request->phone) && isset($request->password)) {
            if (User::where('phone', $request->phone)->exists()) {

                $user = User::where('phone', $request->phone)->get();

                return response()->json([
                    "message" => "Login successful",
                    "data" => $user
                ], 200);

            } else {

                return response()->json([
                    "message" => "Wrong Email/Phone/Password provided."
                ], 404);

            }
        }
        else {

            return response()->json([
                "message" => "Wrong Email/Phone/Password provided."
            ], 404);

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:14',

        ]);


        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->password === $request->repeat_password){

            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                "message" => "User account created."
            ], 201);

        }
        else{
            return response()->json([
                "message" => "Passwords don't match."
            ], 403);
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $users = User::get();


        return response()->json([
            "data" => $users
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
