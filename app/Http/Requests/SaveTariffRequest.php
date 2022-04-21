<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SaveTariffRequest extends FormRequest
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
        $currentMonthEnd = Carbon::now()->endOfMonth()->endOfDay()->toDateTimeString();

        return [
            'price' => 'required|numeric|min:1|max:999999.99',
            'begin_date' => 'required|date|after:' . $currentMonthEnd,
        ];
    }
}
