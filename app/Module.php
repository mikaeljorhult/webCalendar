<?php

namespace WebCalendar;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use WebCalendar\Importers\GoogleCalendar;
use WebCalendar\Importers\ICal;
use WebCalendar\Importers\WebCal;

class Module extends Model
{
    protected $fillable = ['course_id', 'name', 'start_date', 'end_date', 'type', 'calendar'];
    protected $dates = ['start_date', 'end_date'];

    /**
     * Return the parent course.
     *
     * @return Course
     */
    public function courses()
    {
        return $this->belongsToMany('WebCalendar\Course');
    }

    /**
     * Return lessons attached to module.
     *
     * @return array
     */
    public function lessons()
    {
        return $this->hasMany('WebCalendar\Lesson');
    }

    /**
     * Return active modules.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        $today = Carbon::now();

        return $query->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today);
    }

    /**
     * Only store allowed calendar types.
     *
     * @param  string  $value
     * @return string
     */
    public function setTypeAttribute($value)
    {
        $allowedTypes = ['google', 'ical', 'webcal'];

        $this->attributes['type'] = in_array($value, $allowedTypes) ? $value : 'google';
    }

    /**
     * Retrieve and parse calendar feed.
     *
     * @return void
     */
    public function retrieve()
    {
        // Get requested calendar.
        $calendar = $this->importer();
        $items = $calendar->get();

        // Only proceed if fetch was successful.
        if ($items !== false) {
            // Delete previously stored lessons.
            $this->lessons()->delete();

            // Insert newly retrieved lessons.
            if (count($items) > 0) {
                DB::table('lessons')->insert(
                    $items
                );
            }

            // Set updated timestamp on module.
            $this->touch();
        }
    }

    /**
     * Get importer for the calendar type.
     *
     * @return WebCalendar\Importers\Importer
     */
    public function importer()
    {
        switch ($this->type) {
            case 'ical':
                $importer = new ICal($this);
                break;

            case 'webcal':
                $importer = new WebCal($this);
                break;

            default:
                $importer = new GoogleCalendar($this);
        }

        return $importer;
    }
}