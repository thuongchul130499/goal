<?php

namespace App\Http\Controllers;

use App\Events\NewJob;
use App\Http\Requests\JobStoreRequest;
use App\Job;
use App\Jobs\SyncMedia;
use App\Mail\ReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = Job::all();
    }

    /**
     * @param \App\Http\Requests\JobStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobStoreRequest $request)
    {
        $job = Job::create($request->all());

        Mail::to($job->user)->send(new ReviewNotification($job));

        SyncMedia::dispatch($job);

        event(new NewJob($job));
    }
}
