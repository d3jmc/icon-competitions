<?php

use App\Console\Commands\EndCompetitions;
use App\Console\Commands\StartCompetitions;
use Illuminate\Support\Facades\Schedule;

Schedule::command(StartCompetitions::class)->everyMinute();
Schedule::command(EndCompetitions::class)->everyMinute();