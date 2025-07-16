<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Todo;
use App\Models\User;

class FetchAllTodos extends Command
{
    protected $signature = 'fetch:todos';
    protected $description = 'Fetch todos from JSONPlaceholder and store in database';

    public function handle(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');
        $todos = $response->json();

        foreach ($todos as $todo) {
            $user = User::find($todo['userId']);

            if ($user) {
                Todo::updateOrCreate(
                    ['id' => $todo['id']],
                    [
                        'user_id' => $user->id,
                        'title' => $todo['title'],
                        'completed' => $todo['completed'],
                    ]
                );
            }
        }

        $this->info('Todos fetched and stored successfully.');
    }
}
