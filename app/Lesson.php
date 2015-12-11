<?php

namespace WebCalendar;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public $timestamps = false;
    protected $fillable = ['module_id', 'title', 'description', 'start_time', 'end_time'];

    public function module()
    {
        return $this->belongsTo('WebCalendar\Module');
    }
}