<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Expense;
use Illuminate\Support\Facades\Cache;

class AddExpense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fintrack:add-expense';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new expense entry';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = Cache::get('cli_user_id');

        if (!$userId) {
            $this->error('User ID is not set. Run `php artisan user:set` first.');
            return;
        }

        $category = $this->ask('Enter expense category');
        $amount = $this->ask('Enter amount');

        Expense::create([
            'user_id' => $userId,
            'category' => $category,
            'amount' => $amount,
            'date' => now(),
        ]);

        $this->info('Expense entry added successfully!');
    }
}
