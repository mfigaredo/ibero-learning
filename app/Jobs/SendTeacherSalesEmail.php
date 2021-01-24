<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Course;
use App\Mail\TeacherNewSale;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendTeacherSalesEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * @var User
     */
    public $teacher;

    /**
     * @var User
     */
    public $student;

    /**
     * @var Course
     */
    public $course;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $teacher, User $student, Course $course)
    {
        $this->teacher = $teacher;
        $this->student = $student;
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->teacher->email)->send(
                new TeacherNewSale(
                    $this->teacher,
                    $this->student,
                    $this->course
                )
            );
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }
    }
}
