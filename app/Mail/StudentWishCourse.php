<?php

namespace App\Mail;

use App\Models\Wishlist;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentWishCourse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Wishlist
     */
    public $wishlist;
    /**
     * Create a new message instance.
     *
     * @param Wishlist $wishlist
     * @return void
     */
    public function __construct(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('Nuevo curso en la lista de deseos - ' . config('app.name')))
            ->markdown('emails.teachers.student_wish_course');
    }
}
