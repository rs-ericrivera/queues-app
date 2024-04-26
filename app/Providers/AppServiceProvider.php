<?php

namespace App\Providers;

use App\Models\JobStatus;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
//        Event::listen(JobProcessing::class, function ($event) {
//            dd($event->job->id);
//            JobStatus::updateOrCreate(['jobId' =>$jobId], ['status' => 'STARTED']);
//        });
//
//        Event::listen(JobProcessed::class, function ($event) {
//            $jobId = $event->job->getJobId();
//            JobStatus::updateOrCreate(['jobId' => $jobId], ['status' => 'COMPLETED']);
//        });
//        Queue::failing(function (JobFailed $event) {
//            dd($event->job->record->id);
////            $jobId = $event->job->getJobId();
////            JobStatus::updateOrCreate(['jobId' => $jobId], ['status' => 'FAILED']);
//        });
    }
}
