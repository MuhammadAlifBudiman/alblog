<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class SeedPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:posts {--count=1 : Number of posts to seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the posts table with a custom count';

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
        $this->info("Seeding {$count} post(s)...");

        Post::factory()->count($count)->create();

        $this->info("Done seeding posts.");
    }
}
