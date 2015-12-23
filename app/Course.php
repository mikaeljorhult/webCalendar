<?php

namespace WebCalendar;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'code'];

    public function modules()
    {
        return $this
            ->belongsToMany('WebCalendar\Module')
            ->withPivot('sort_order')
            ->orderBy('sort_order', 'ASC');
    }

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