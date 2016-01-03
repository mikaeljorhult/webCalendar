<?php

namespace WebCalendar\Http\Requests;

use WebCalendar\Http\Requests\Request;

class ModuleUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'type' => ['in:google,ical,ical-file,webcal'],
            'calendar' => ['required_if:type,google,ical,webcal', 'connectable'],
            'file' => ['required_without:calendar', 'mimes:ics']
        ];
    }
}
