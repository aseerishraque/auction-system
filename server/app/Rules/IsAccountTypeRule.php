<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsAccountTypeRule implements Rule
{
    private $accountTypes=[];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $accountTypes)
    {
        $this->accountTypes = $accountTypes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, $this->accountTypes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The account type is invalid.';
    }
}
