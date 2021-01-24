<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = ['id'];
    protected $perPage = 10;

    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
