<?php

namespace WebCalendar\Http\Requests;

use WebCalendar\Http\Requests\Request;

class ModuleCreateRequest extends Request
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
            'calendar' => ['required', 'connectable']
        ];
    }
}
