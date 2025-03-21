<?php

namespace App\Console\Commands;

use League\Csv\Writer;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Console\Command;
use SplTempFileObject;
use Illuminate\Support\Facades\Storage;

class ExportFinance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fintrack:export {--user= : User ID to export data for}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export income and expense data as a CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->option('user');

        if (!$userId) {
            $this->error('Please provide a user ID using --user=<id>');
            return;
        }

        $this->info("Exporting finance data for User ID: $userId...");

        // Fetch data
        $incomes = Income::where('user_id', $userId)->get();
        $expenses = Expense::where('user_id', $userId)->get();

        if ($incomes->isEmpty() && $expenses->isEmpty()) {
            $this->warn('No finance data found for this user.');
            return;
        }

        // Generate CSV
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(['Type', 'Source/Category', 'Amount', 'Status', 'Date']);

        foreach ($incomes as $income) {
            $csv->insertOne(['Income', $income->source, $income->amount, $income->status, $income->date]);
        }

        foreach ($expenses as $expense) {
            $csv->insertOne(['Expense', $expense->category, $expense->amount, '-', $expense->date]);
        }

        // Save to storage
        $filePath = "exports/finance_user_{$userId}.csv";
        Storage::put($filePath, $csv->toString());

        $this->info("Export complete! File saved at: storage/app/$filePath");
    }
}
