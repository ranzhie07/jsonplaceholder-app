<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'address' => [
                    'street' => $user->street,
                    'suite' => $user->suite,
                    'city' => $user->city,
                    'zipcode' => $user->zipcode,
                    'geo' => [
                        'lat' => $user->geo_lat,
                        'lng' => $user->geo_lng,
                    ],
                ],
                'phone' => $user->phone,
                'website' => $user->website,
                'company' => [
                    'name' => $user->company_name,
                    'catchPhrase' => $user->company_catch_phrase,
                    'bs' => $user->company_bs,
                ],
            ];
        });

        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'website' => $user->website,
            'address' => [
                'street' => $user->street,
                'suite' => $user->suite,
                'city' => $user->city,
                'zipcode' => $user->zipcode,
                'geo' => [
                    'lat' => $user->geo_lat,
                    'lng' => $user->geo_lng
                ],
            ],
            'company' => [
                'name' => $user->company_name,
                'catchPhrase' => $user->company_catch_phrase,
                'bs' => $user->company_bs
            ],
        ]);
    }
}
