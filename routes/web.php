<?php

use App\Jobs\AddSubscriberJob;
use App\Jobs\ModifySubscriberJob;
use App\Jobs\SuspendSubscriberJob;
use App\Jobs\TerminateSubscriberJob;
use App\Jobs\UnsuspendSubscriberJob;
use App\Models\JobStatus;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use function MongoDB\Driver\Monitoring\addSubscriber;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'queue'],function(){
    Route::get('PollQueue',function(Request $request){
        $jobStatus = JobStatus::where('queue_id',$request->queueId)->first();
        return response()->json(['status'=>true,'data'=>$jobStatus],200);
    });
    Route::get('StartQueue',function(Request $request){
        if(empty($request->methodName)) return response()->json(['status'=>false,'message'=>'method parameter is required'],422);
        $method = $request->methodName;
        $params = $request->except('methodName');
        $faker = Faker::create();
        $queueId = $faker->regexify('[A-Za-z0-9_\-]{10}');
        $jobStatus = JobStatus::create([
            "queue_id"=>$queueId,
            "action"=>$method,
            "status"=>"ADDED",
            "remarks"=>"[".$method."] - Added to Queue."]);
        switch ($method) {
            case 'AddSubscriber':

                $jobId =Bus::dispatch(new AddSubscriberJob($params,$queueId));
                $jobStatus = JobStatus::find($jobStatus->id)->update(['job_id'=>$jobId]);
                break;
            case 'ModifySubscriber':
                ModifySubscriberJob::dispatch($params,$queueId);
                break;
            case 'SuspendSubscriber':
                SuspendSubscriberJob::dispatch($params,$queueId);
                break;
            case 'UnsuspendSubscriber':
                UnsuspendSubscriberJob::dispatch($params,$queueId);
                break;
            case 'TerminateSubscriber':
                TerminateSubscriberJob::dispatch($params,$queueId);
                break;
            default:
                break;
        }
        return $queueId;
    });
});

