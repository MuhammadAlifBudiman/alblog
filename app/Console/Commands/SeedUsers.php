<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SeedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:users {--count=1 : Number of users to seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the users table with a custom count';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = (int) $this->option('count');
        $this->info("Seeding {$count} user(s)...");

        User::factory()->count($count)->create();

        $this->info("Done seeding users.");
    }
}
