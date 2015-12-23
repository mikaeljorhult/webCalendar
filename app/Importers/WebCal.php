<?php

namespace WebCalendar\Importers;

class WebCal extends ICal
{
    protected function url()
    {
        return str_replace('webcal', 'http', $this->module->calendar);
    }
}