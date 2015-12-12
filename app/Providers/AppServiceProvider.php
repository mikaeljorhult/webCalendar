<?php

namespace WebCalendar\Providers;

use Collective\Html\FormFacade as Form;
use WebCalendar\Course;
use WebCalendar\Module;
use WebCalendar\Importers\GoogleCalendar as Calendar;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('connectable', function ($attribute, $value) {
            // Create mock module to test URL with.
            $module = new Module([
                'name' => 'Connectable Calendar',
                'start_date' => date('Y-m-d', strtotime('-2 days')) . 'T00:00:00.000Z',
                'end_date' => date('Y-m-d', strtotime('+2 days')) . 'T00:00:00.000Z',
                'url' => $value
            ]);

            $calendar = new Calendar($module);

            return $calendar->test();
        });

        Form::macro('courseCheckbox', function ($name, $selected = array()) {
            $return = '';
            $courses = Course::orderBy('name')->get();

            foreach ($courses as $course) {
                $return .= '<li><label>' .
                    '<input type="checkbox" name="' . $name . '[]" value="' . $course->id . '"' . (in_array($course->id,
                        $selected) ? ' checked="checked"' : '') . ' /> ' .
                    $course->name .
                    '</label></li>';
            }

            return ($return ? '<ul>' . $return . '</ul>' : '');
        });

        view()->composer('courses.schedule', function ($view) {
            $weeks = $view->getData()['lessons']->groupBy(function ($item) {
                return $item->start_time->format('W');
            });

            $view->with('weeks', $weeks);
        });

        view()->composer('_partials.schedule.week', function ($view) {
            $days = $view->getData()['week']->groupBy(function ($item) {
                return $item->start_time->format('w');
            });

            $view->with('days', $days);
        });

        view()->composer('_partials.schedule.day', function ($view) {
            $times = $view->getData()['day']->groupBy(function ($item) {
                return $item->start_time->format('Hi');
            });

            $view->with('times', $times);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
