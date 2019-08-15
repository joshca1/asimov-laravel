<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class isWeekend implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param   string $attribute
     * @param   mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $weekDay = date('N', strtotime($value));
        return $weekDay < 6;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You can not book a dance with the death on weekends, hes too Tired.';
    }
}
