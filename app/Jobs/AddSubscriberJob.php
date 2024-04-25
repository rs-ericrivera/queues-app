<?php

namespace App\Jobs;

use App\Http\Controllers\UserController;
use App\Models\JobStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Faker\Factory as Faker;

class AddSubscriberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private mixed $userData;

    /**
     * Create a new job instance.
     */
    public function __construct($userData)
    {
        //
        $this->userData = $userData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $faker = Faker::create();
        $queueId = $faker->regexify('[A-Za-z0-9_\-]{10}');
        $jobStatus = JobStatus::where('queue_id',$queueId)->first();
        JobStatus::create(
            [
                "queue_id"=>$queueId,
                "status"=>"STARTED",
                "action"=>"AddSubscriber",
                "remarks"=>"[StartQueue] - AddSubscriber"
            ]);
        UserController::store($this->userData,$queueId);
    }
}
