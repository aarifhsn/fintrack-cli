<?php

namespace App\Console\Commands;

use App\Models\Income;
use Illuminate\Console\Command;

class AddIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fintrack:add-income';

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
        $source = $this->ask('Enter income source (Upwork, Fiverr, Direct Client)');
        $amount = $this->ask('Enter amount');
        $status = $this->choice('Select payment status', ['Pending', 'Paid'], 1);

        Income::create([
            'income' => $source,
            'amount' => $amount,
            'status' => $status,
            'date' => now(),
        ]);
        $this->info('Income entry added successfully!');

    }
}
