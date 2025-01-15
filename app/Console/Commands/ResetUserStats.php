<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserStat;

class ResetUserStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userstats:reset-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the user stats daily at midnight';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Reset logic (assuming you're resetting some stats daily)
        UserStat::query()->update([
            'calories' => 0,
            'protein' => 0,
            'fat' => 0,
            'carbs' => 0,
            'liquid_intake' => 0,
        ]);

        $this->info('User stats have been reset for the day.');
    }
}