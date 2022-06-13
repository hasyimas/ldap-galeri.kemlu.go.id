<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json("Api", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $ldaprdn = "dummy.basic02";
        $ldapPass = "pejambon#6";

        if ($request->username == 'admin' && $request->password == 'admin') {
            $data = [
                "username" => $ldaprdn,
                "password" => $request->password,
                "token" => md5($ldapPass . $ldaprdn)
            ];

            return response()->json($data, 200);
        } else {
            return response()->json(['error' => "Login Failure"], 401);
        }

        // $ldapconnServer = "172.16.200.50";

        // $ldapconn = ldap_connect($ldapconnServer) or die("Could not connect to LDAP server ");

        // ldap_set_option($ldapconn, LDAP_OPT_NETWORK_TIMEOUT, 2); /* 2 second timeout */

        // $ldaprdn = $request->username;

        // $ldapPass = $request->password;

        // $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldapPass);

        // if ($ldapbind) {
        //     $data = [
        //         "username" => $ldaprdn,
        //         "token" => md5($ldapPass . $ldaprdn)
        //     ];

        //     return response()->json($data, 200);
        // } else {
        //     return response()->json("Login Failure", 200);
        // }
    }
}
