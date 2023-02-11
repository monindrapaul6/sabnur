<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;

    //Login Api
    public function login()
    {
        if (Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')]) || Auth::attempt(['mobile' => '+91'.request('mobile'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function firebaselogin(Request $request)
    {
        $auth = app('firebase.auth');
        $idTokenString = request('token');

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        } catch (InvalidToken $e) {
            return response()->json([
                'error' => 'Unauthorized - Token is invalid: ' . $e->getMessage()
            ], 401);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'error' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
            ], 401);
        }

        $uid = $verifiedIdToken->claims()->get('sub');
        $phone = $verifiedIdToken->claims()->get('phone_number');
        $phoneWithoutCountry = preg_replace("/^\+?\+91/", '', $phone);


        $user = User::query()
            ->whereIn('mobile', [$phone, $phoneWithoutCountry])
            ->first();

        if ($user == null) {
            $user = User::create([
                'firebase_id' => $uid,
                'mobile' => $phone,
                'name' => 'Guest',
                'status' => User::STATUS_INACTIVE,
            ]);
        }

        if ($user->firebase_id == null) {
            $user->update(['firebase_id' => $uid]);
        }

        if ($user->name == null) {
            $user->update(['name' => 'Guest']);
        }

        $data = [
            'token' => $user->createToken('MyApp')->accessToken,
            'user' => $user->fresh(),
        ];

        return response()->json(['success' => $data]);
    }
}
