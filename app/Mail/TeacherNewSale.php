<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeacherNewSale extends Mailable
{
    use Queueable, SerializesModels;

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
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('¡Curso vendido! - ' . config('app.name'))
            ->markdown('emails.teachers.new_sale');
    }
}
