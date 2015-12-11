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
        $modules = Module::with('courses')
            ->active()
            ->get();

        $ids = [0];

        if (count($modules) > 0) {
            foreach ($modules as $module) {
                $ids = array_merge($ids, $module->courses->lists('id')->all());
            }
        }

        return $query->with('modules')->whereIn('id', array_unique($ids));
    }
}