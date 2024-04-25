<?php

namespace App\Http\Controllers\Api;
use illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        //remove token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if($removeToken) {
            //return success JSON
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil!'
            ]);
        }
    }
}
