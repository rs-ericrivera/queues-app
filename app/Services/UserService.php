<?php
namespace App\Services;

use App\Models\JobStatus;
use App\Models\User;

class UserService
{

    public function createUser($userData, $queueId)
    {
        $jobStatus = JobStatus::where('queue_id', $queueId)->first();
        $updates = [
            "status"=>"STARTED",
            "remarks" => "Processing Subscriber"
        ];
        $jobStatus->update($updates);
        sleep(2);
        $updates = [
            "remarks" => "Checking Subscriber Details"
        ];
        $jobStatus->update($updates);

        sleep(2);
        $updates = [
            "remarks" => "Adding Subscriber Details"
        ];
        $jobStatus->update($updates);

        sleep(2);
        $updates = [
            "remarks" => "Saving Subscriber Details"
        ];
        $jobStatus->update($updates);
        $userData["password"] = bcrypt("tempPass0!");

        $user = User::create($userData);

        if($user){
            $updates = [
                "status"=>"COMPLETED",
                "remarks" => "Added Subscriber Successfully."
            ];
            $jobStatus->update($updates);
        }else{
            $updates = [
                "status"=>"FAILED",
                "remarks" => "Added Subscriber Failed."
            ];
        }
        return $user;
    }

}
