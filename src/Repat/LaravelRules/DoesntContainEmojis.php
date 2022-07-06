<?php

namespace Repat\LaravelRules;

use Illuminate\Contracts\Validation\Rule;
use SteppingHat\EmojiDetector\EmojiDetector;

class DoesntContainEmojis implements Rule
{
    private $detector;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->detector = new EmojiDetector();
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
        // early return, if we're not looking for specific emojis
        return empty($this->detector->detect($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'String contains emojis.';
    }
}
