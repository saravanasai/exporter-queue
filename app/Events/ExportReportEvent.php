<?php

namespace App\Events;

use App\Models\Reports;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExportReportEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public  $reportId;
    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        $this->reportId =  $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::info("broadast On", [$this->reportId]);
        return [
            new PrivateChannel('report.' . $this->reportId),
        ];
    }
}
