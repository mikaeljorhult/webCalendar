<?php

namespace WebCalendar;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

    /**
     * Return related modules according to sort order.
     *
     * @return mixed
     */
    public function modules()
    {
        return $this
            ->belongsToMany('WebCalendar\Module')
            ->withPivot('sort_order')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Courses are only active if it has related active modules.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        // Get all active modules.
        $modules = Module::with('courses')
            ->active()
            ->get();

        // Pluck IDs of all related courses and return array.
        $courses = $modules->map(function ($module) {
            return $module->courses->pluck('id')->all();
        })->flatten();

        // Attach to query and request unique results.
        return $query->with('modules')->whereIn('id', $courses)->distinct();
    }
}