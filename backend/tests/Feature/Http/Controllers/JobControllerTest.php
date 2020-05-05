<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewJob;
use App\Job;
use App\Jobs\SyncMedia;
use App\Mail\ReviewNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GoalController
 */
class JobControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $jobs = factory(Job::class, 3)->create();

        $response = $this->get(route('job.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GoalController::class,
            'store',
            \App\Http\Requests\JobStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;

        Mail::fake();
        Queue::fake();
        Event::fake();

        $response = $this->post(route('job.store'), [
            'title' => $title,
            'description' => $description,
        ]);

        $jobs = Job::query()
            ->where('title', $title)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $jobs);
        $job = $jobs->first();

        Mail::assertSent(ReviewNotification::class, function ($mail) use ($job) {
            return $mail->hasTo($job->user) && $mail->job->is($job);
        });
        Queue::assertPushed(SyncMedia::class, function ($job) use ($job) {
            return $job->job->is($job);
        });
        Event::assertDispatched(NewJob::class, function ($event) use ($job) {
            return $event->job->is($job);
        });
    }
}
