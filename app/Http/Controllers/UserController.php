<?php

namespace App\Http\Controllers;

use App\Models\JobStatus;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($userData,$queueId)
    {
        $jobStatus = JobStatus::where('queue_id',$queueId)->first();
        $updates = [
            "remarks"=>"Checking Subscriber Details"
        ];
        $jobStatus->update($updates);
        sleep(5);
        $updates = [
            "remarks"=>"Checking Subscriber Details"
        ];
        $jobStatus->update($updates);

        sleep(5);
        $updates = [
            "remarks"=>"Adding Subscriber Details"
        ];
        $jobStatus->update($updates);

        sleep(5);
        $updates = [
            "remarks"=>"Saving Subscriber Details"
        ];
        $jobStatus->update($updates);
        return User::create($userData);
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        //
        return User::find($userId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($updates,$userId)
    {
        //
        return User::find($userId)->update($updates);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
