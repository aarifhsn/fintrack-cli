<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SetUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the default user ID for CLI commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->ask('Enter user ID');

        // Check if the user exists
        if (!\App\Models\User::find($userId)) {
            $this->error('User does not exist.');
            return;
        }

        Cache::put('cli_user_id', $userId);
        $this->info("User ID set to $userId");
    }
}
