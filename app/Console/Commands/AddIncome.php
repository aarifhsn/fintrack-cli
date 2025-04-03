<?php

namespace App\Console\Commands;

use App\Models\Income;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class AddIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fintrack:add-income {--user= : User ID} {--date= : Optional date (YYYY-MM-DD)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new income entry';

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

        $category = $this->choice('Select income category', ['Upwork', 'Fiverr', 'Direct Client', 'Retainer', 'Projects', 'Others']);
        $description = $this->ask('Enter description (optional)');
        $currency = $this->choice('Select currency', ['USD', 'EUR', 'GBP', 'BDT', 'AUD']);
        $amount = $this->ask('Enter amount');
        $status = $this->choice('Select payment status', ['Pending', 'Processing', 'Paid', 'Failed'], 1);
        $taxDeducted = $this->confirm('Tax already deducted?', false);

        Income::create([
            'user_id' => $userId,
            'source' => $category,
            'description' => $description,
            'amount' => $amount,
            'currency' => $currency,
            'status' => $status,
            'tax_deducted' => $taxDeducted,
            'date' => now(),
        ]);
        $this->info('Income entry added successfully!');

    }
}
