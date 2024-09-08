<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class Initialization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:initialization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize project like create database and run migration and seeder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = Config::get('database.connections.mysql');
        
        $pdo = new \PDO(
            "{$connection['driver']}:host={$connection['host']}",
            $connection['username'],
            $connection['password']
        );

        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$connection['database']}`");
        $this->info("Database '{$connection['database']}' created successfully.");
        $this->call('migrate');
        $this->info('Migration successfully');
        $this->call('db:seed', ['--class', 'CriteriaSeeder']);
        $this->call('db:seed', ['--class', 'CriteriaDetailSeeder']);
        $this->info('Seeder successfully');
    }
}
