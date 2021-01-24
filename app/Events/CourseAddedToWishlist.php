<?php

namespace App\Events;

use App\Models\Wishlist;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CourseAddedToWishlist
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Wishlist
     */
    public $wishlist; 
    /**
     * Create a new event instance.
     *
     * @param Wishlist $wishlist
     * @return void
     */
    public function __construct(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }


}
