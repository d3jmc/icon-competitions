<?php

namespace App\Actions;

use App\Models\Competition;
use App\Pipelines\TicketGeneration\AssignPrizesToTickets;
use App\Pipelines\TicketGeneration\ConvertTickets;
use App\Pipelines\TicketGeneration\CreateTickets;
use Illuminate\Pipeline\Pipeline;

class GenerateTickets
{
    /**
     * @param Competition $competition
     * @return Competition
     */
    public function handle(Competition $competition): Competition
    {
        return app(Pipeline::class)
            ->send($competition)
            ->through([
                CreateTickets::class,
                ConvertTickets::class,
                AssignPrizesToTickets::class,
            ])
            ->thenReturn();
    }
}