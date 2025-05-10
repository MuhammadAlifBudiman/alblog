<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class SeedCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:categories {--count=1 : Number of categories to seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the categories table with a custom count';

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
        $this->info("Seeding {$count} category(ies)...");

        Category::factory()->count($count)->create();

        $this->info("Done seeding categories.");
    }
}
