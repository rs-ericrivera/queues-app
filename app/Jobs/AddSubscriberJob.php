<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\UserService;
 class AddSubscriberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected UserService $userService;
     private mixed $userData;
     private mixed $queueId;

     /**
     * Create a new job instance.
     */
    public function __construct($userData,$queueId)
    {
        $this->userData = $userData;
        $this->queueId = $queueId;
    }

    /**
     * Execute the job.
     */
    public function handle(UserService $userService): void
    {

        $userService->createUser($this->userData,$this->queueId);
    }
}
