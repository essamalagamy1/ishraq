<?php

namespace App\Console\Commands;

use App\Services\GoogleReviewsService;
use Illuminate\Console\Command;

class SyncGoogleReviewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:sync-reviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and synchronize reviews automatically from Google Places API into testimonials';

    /**
     * Execute the console command.
     */
    public function handle(GoogleReviewsService $service): int
    {
        $this->info('Starting Google Reviews synchronization...');

        $result = $service->syncReviews();

        if ($result['success']) {
            $this->info($result['message']);
            return Command::SUCCESS;
        }

        $this->warn($result['message']);
        return Command::FAILURE;
    }
}
