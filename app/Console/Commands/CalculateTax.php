<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CalculateTax extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fintrack:calculate-tax {--user= : User ID} {--year= : Tax year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate tax for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = Cache::get('cli_user_id');
        $year = $this->option('year') ?? now()->year;

        $income = Income::where('user_id', $userId)
            ->whereYear('date', $year)
            ->where('tax_deducted', false)
            ->sum('amount');

        $taxableExpenses = Expense::where('user_id', $userId)
            ->whereYear('date', $year)
            ->where('tax_deductible', true)
            ->sum('amount');

        $taxableIncome = $income - $taxableExpenses;

        // Progressive tax brackets (example)
        $taxBrackets = [
            ['limit' => 10000, 'rate' => 0.10],
            ['limit' => 40000, 'rate' => 0.20],
            ['limit' => 100000, 'rate' => 0.30],
            ['limit' => PHP_INT_MAX, 'rate' => 0.35],
        ];

        $taxOwed = $this->calculateTax($taxableIncome, $taxBrackets);

        $this->table(
            ['Year', 'Total Income', 'Deductible Expenses', 'Taxable Income', 'Estimated Tax'],
            [[$year, $income, $taxableExpenses, $taxableIncome, $taxOwed]]
        );
    }

    /**
     * Calculate the tax based on progressive tax brackets.
     */
    private function calculateTax($income, $brackets)
    {
        $tax = 0;
        $previousLimit = 0;

        foreach ($brackets as $bracket) {
            if ($income > $previousLimit) {
                $taxableAmount = min($income, $bracket['limit']) - $previousLimit;
                $tax += $taxableAmount * $bracket['rate'];
                $previousLimit = $bracket['limit'];
            } else {
                break;
            }
        }

        return round($tax, 2);
    }

}
