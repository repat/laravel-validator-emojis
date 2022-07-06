<?php

namespace Repat\LaravelRules;

use Illuminate\Contracts\Validation\Rule;
use Repat\LaravelRules\Traits\Setters;
use SteppingHat\EmojiDetector\EmojiDetector;

class ContainsEmojis implements Rule
{
    use Setters;

    private $detector;
    private $emojis;
    private $all;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $emojis = [], bool $all = false)
    {
        $this->detector = new EmojiDetector();
        $this->emojis = $emojis;
        $this->all = $all;
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
        $detectedEmojis = $this->detector->detect($value);

        if (empty($this->emojis)) {
            // early return, if we're not looking for specific emojis
            return ! empty($detectedEmojis);
        }

        // Get the emoji string `emoji` from `EmojiInfo` object
        $pluckedDetectedEmojis = array_map(fn ($emoji) => $emoji->getEmoji(), $detectedEmojis);

        foreach ($this->emojis as $emoji) {
            // ANY emoji will do the trick
            if (! $this->all && in_array($emoji, $pluckedDetectedEmojis)) {
                // early return
                return true;
            }

            // If ALL emojis have to be in string, we need to keep track and filter out if we found one ...
            if (in_array($emoji, $pluckedDetectedEmojis)) {
                $pluckedDetectedEmojis = array_filter($pluckedDetectedEmojis, fn ($pluckedEmoji) => $pluckedEmoji !== $emoji);
            }
        }

        // ... then see if we got them all or if at least all of the given emojis were detected
        return empty($pluckedDetectedEmojis) || abs(count($this->emojis) - count($detectedEmojis)) === count($pluckedDetectedEmojis);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Contains incorrect emojis.';
    }
}
