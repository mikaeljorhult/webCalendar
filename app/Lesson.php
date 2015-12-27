<?php

namespace WebCalendar;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['module_id', 'title', 'description', 'start_time', 'end_time'];

    /**
     * The attributes that are cast as date objects.
     *
     * @var array
     */
    protected $dates = ['start_time', 'end_time'];

    /**
     * Return parent module.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo('WebCalendar\Module');
    }
}