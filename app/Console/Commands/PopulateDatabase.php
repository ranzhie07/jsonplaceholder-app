<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PopulateDatabase extends Command
{
    protected $signature = 'populate:database';
    protected $description = 'Run all fetch commands to populate the database';

    public function handle(): void
    {
        $commands = [
            'fetch:users',
            'fetch:albums',
            'fetch:comments',
            'fetch:photos',
            'fetch:todos',
            'fetch:posts',
        ];

        foreach ($commands as $command) {
            $this->info("Running {$command}...");
            $this->call($command);
        }

        $this->info('✅ All fetch commands completed. Database populated.');
    }
}
