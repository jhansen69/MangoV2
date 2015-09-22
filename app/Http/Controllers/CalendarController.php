<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SiteJob;
use App\Job;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class CalendarController extends Controller
{
    //
    public function index($type)
    {
        return view('pages.calendar',compact('type'));
    }

    public function move($id, Request $request)
    {
        $days=$request->days;
        $hours=$request->hours;
        $minutes=$request->minutes;

        $job=Job::findOrFail($id);
        $endTime=Carbon::createFromFormat("Y-m-d H:i:s",$job->end);
        $startTime=Carbon::createFromFormat("Y-m-d H:i:s",$job->start);
        $initialStart=$startTime->format("m/d/Y H:i");

        $startTime->addDays($days);
        $startTime->addHours($hours);
        $startTime->addMinutes($minutes);
        $endTime->addDays($days);
        $endTime->addHours($hours);
        $endTime->addMinutes($minutes);

        $job->start=$startTime->format("Y-m-d H:i:s");
        $job->end=$endTime->format("Y-m-d H:i:s");
        $job->update();

        $message=array('title'=>'Job end date changed',
            'content'=>'Record updated with start of '.$endTime->format("m/d/Y H:i:s")." Initial was ".$initialStart." Hours = ".$hours." and minutes=".$minutes,
            'color' => '#C79121',
            'timeout' => 3500,
            'icon' => 'fa fa-bullhorn'
        );

        $response=array('status'=>'success','showMessage'=>true,'message'=>$message);
        return json_encode($response);
    }

    public function resize($id, Request $request)
    {
        $hours=$request->hours;
        $minutes=$request->minutes;

        $job=Job::findOrFail($id);
        $endTime=Carbon::createFromFormat("Y-m-d H:i:s",$job->end);
        $initialEnd=$endTime->format("m/d/Y H:i");

        $endTime->addHours($hours);
        $endTime->addMinutes($minutes);

        $job->end=$endTime->format("Y-m-d H:i:s");
        $job->update();

        $message=array('title'=>'Job end date changed',
            'content'=>'Record updated with end of '.$endTime->format("m/d/Y H:i:s")." Initial was ".$initialEnd." Hours = ".$hours." and minutes=".$minutes,
            'color' => '#C79121',
            'timeout' => 3500,
            'icon' => 'fa fa-bullhorn'
            );

        $response=array('status'=>'success','showMessage'=>true,'message'=>$message);
        return json_encode($response);
    }
    public function press()
    {
        return view('pages.press.calendar');
    }

    public function pressData(Request $request)
    {
        $params=$request->only(['start','end']);
        $start=Carbon::createFromFormat('m/d/Y', '9/14/2015');
        $end=Carbon::createFromFormat('m/d/Y', '9/20/2015');
        if(!isset($params['start'])){$params['start']=$start;}
        if(!isset($params['end'])){$params['end']=$end;}

        $jobs=SiteJob::where('start','>=',$params['start'])->where('end','<=',$params['end'])->with('pub')->with('pressRun')->get();

        //now we loop through jobs and build up the array the way we need to, and pass it back as a json encoded object
        $pressJobs=array();
        foreach($jobs as $job)
        {
            $pressjob=array();
            $pressjob['id']=$job->id;
            $pressjob['title']=$job->pub->name." ".date("m/d/Y",strtotime($job->product_date));
            $pressjob['color']="#".$job->pub->color;
            $pressjob['start']=$job->start->format('m/d/Y H:i');
            $pressjob['end']=$job->end->format('m/d/Y H:i');
            $pressjob['pub_date']=$job->product_date->toRfc850String();
            $pressjob['description']="This is my description";
            $pressJobs[]=$pressjob;
        }


        return json_encode($pressJobs);
    }
}
