<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;

class DeleteIncompletePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:incompletePosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all the posts that have no title or slug.';

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
     * @return mixed
     */
    public function handle()
    {
        $incompletePosts = Post::where('title', null)->where('slug', null)->get();

        if ($incompletePosts->count() > 0) {
            foreach ($incompletePosts as $post) {
                $post->forceDelete();
            }

            $this->info('Incomplete posts deleted successfully!');
        }
        else{
            $this->info('No incomplete posts to delete!');
        }

        
    }
}
