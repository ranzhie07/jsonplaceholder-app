<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class FetchAllUsers extends Command
{
    protected $signature = 'fetch:users';
    protected $description = 'Fetch users from JSONPlaceholder and store in database';

    public function handle(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        if (!$response->successful()) {
            $this->error('Failed to fetch users.');
            return;
        }

        $users = $response->json();

        foreach ($users as $user) {
            \App\Models\User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'] ?? null,
                    'username' => $user['username'] ?? null,
                    'phone' => $user['phone'] ?? null,
                    'website' => $user['website'] ?? null,
                    'street' => $user['address']['street'] ?? null,
                    'suite' => $user['address']['suite'] ?? null,
                    'city' => $user['address']['city'] ?? null,
                    'zipcode' => $user['address']['zipcode'] ?? null,
                    'geo_lat' => $user['address']['geo']['lat'] ?? null,
                    'geo_lng' => $user['address']['geo']['lng'] ?? null,
                    'company_name' => $user['company']['name'] ?? null,
                    'company_catch_phrase' => $user['company']['catchPhrase'] ?? null,
                    'company_bs' => $user['company']['bs'] ?? null,
                ]
            );
        }

        $this->info('Users fetched and stored successfully.');
    }
}
