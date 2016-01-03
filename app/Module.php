<?php

namespace WebCalendar;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['course_id', 'name', 'start_date', 'end_date', 'type', 'calendar'];

    /**
     * The attributes that are cast as date objects.
     *
     * @var array
     */
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
     * @return mixed
     */
    public function test()
    {
        // Get requested importer.
        $importer = $this->importer();

        return $importer->test();
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
                $importer = '\WebCalendar\Importers\ICal';
                break;

            case 'ical-file':
                $importer = '\WebCalendar\Importers\ICalFile';
                break;

            case 'webcal':
                $importer = '\WebCalendar\Importers\WebCal';
                break;

            default:
                $importer = '\WebCalendar\Importers\GoogleCalendar';
        }

        return app()->make($importer, [$this]);
    }

    /**
     * Store calendar file and attach to model.
     *
     * @param $file
     */
    public function addFile($file)
    {
        // Generate a unique filename.
        $uniqueFilename = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();

        // Move file to storage folder.
        $file->move(storage_path('app'), $uniqueFilename);

        // Store filename in model.
        $this->calendar = $uniqueFilename;
        $this->save();
    }
}