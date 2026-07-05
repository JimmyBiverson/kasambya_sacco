<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicationApproved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $applicationId;
    public $applicantName;

    public function __construct($application)
    {
        $this->applicationId = $application->id ?? null;
        $this->applicantName = $application->full_name ?? null;
    }

    public function broadcastOn()
    {
        return new Channel('admin');
    }

    public function broadcastWith()
    {
        return [
            'application_id' => $this->applicationId,
            'applicant' => $this->applicantName,
        ];
    }
}
