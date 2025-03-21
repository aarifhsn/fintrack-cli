<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Console\Command;

class ViewReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fintrack:view-report {--monthly} {--yearly}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View income vs. expenses report';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $month = now()->format('Y-m');

        $incomeTotal = Income::where('date', 'like', "$month%")->sum('amount');

        $expenseTotal = Expense::where('date', 'like', "$month%")->sum('amount');

        $savings = $incomeTotal - $expenseTotal;

        $this->table(['Total Income', 'Total Expenses', 'Savings'], [
            [$incomeTotal, $expenseTotal, $savings]
        ]);
    }
}
