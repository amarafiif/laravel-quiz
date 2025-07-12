<?php

namespace App\Console\Commands;

use App\Models\QuizAttempt;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BackfillQuizAttemptUuids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backfill-quiz-attempt-uuids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill UUIDs for existing quiz attempts that are missing one.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Starting to backfill UUIDs for quiz attempts...');
        QuizAttempt::whereNull('uuid')->chunkById(200, function ($attempts) {
            foreach ($attempts as $attempt) {
                $attempt->uuid = (string) Str::uuid();
                $attempt->saveQuietly();
            }

            $this->info(count($attempts).' records processed.');
        });

        $this->info('✅ UUID backfill completed successfully.');
    }
}
