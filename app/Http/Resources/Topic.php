<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Course as CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Topic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'replies_count' => $this->replies_count,
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y H:i'),
            'owner' => new UserResource($this->user),
            'course' => new CourseResource($this->course),
            // 'teacher' => new UserResource($this->course->teacher),
        ];
        
    }

    // public function collection() {
    //     return [
    //         'id' => $this->id,
    //         'title' => $this->title,
    //         'content' => $this->content,
    //         'replies_count' => $this->replies_count,
    //         'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y H:i'),
    //         'owner' => new UserResource($this->user),
    //         'course' => new CourseResource($this->course),
    //         // 'teacher' => new UserResource($this->course->teacher),
    //     ];
    // }

    // public function with($request) {
    //     return [
    //         'meta' => [
    //             // 'teacher' => new UserResource($this->course->teacher),
    //             'my_key' => 'my_value',
    //         ],
    //     ];
    // }
}
