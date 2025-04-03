<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ManageClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fintrack:clients {action : list|add|view|update} {--id= : Client ID for view/update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage clients';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'list':
                $this->listClients();
                break;
            case 'add':
                $this->addClient();
                break;
            case 'view':
                $clientId = $this->option('id') ?? $this->ask('Enter client ID');
                $this->viewClient($clientId);
                break;
            case 'update':
                $clientId = $this->option('id') ?? $this->ask('Enter client ID');
                $this->updateClient($clientId);
                break;
        }
    }
}
