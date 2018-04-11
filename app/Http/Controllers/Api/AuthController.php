<?php

namespace VendingDroid\Http\Controllers\Api;

use Illuminate\Http\Request;
use VendingDroid\Http\Requests;
use VendingDroid\Http\Controllers\Controller;

use Auth;
use Response;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = array(
            'name' => $request->json('name'),
            'password' => $request->json('password')
        );
        if (! Auth::once($credentials)) {
            // send to mobile with {'error':'invalid_credentials'}
            return Response::json(['error' => 'invalid_credentials'], 401);
        }

        // send to mobile with {'name':'admin', 'role':'admin'}
        return Response::json(array(
            'name' => Auth::user()->name,
             'role' => Auth::user()->role,
        ));
    }
}
