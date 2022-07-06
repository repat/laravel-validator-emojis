<?php

namespace Repat\LaravelRules\Traits;

trait Setters
{
    public function setEmojis(array $emojis)
    {
        $this->emojis = $emojis;
    }

    public function setAll(bool $all)
    {
        $this->all = $all;
    }
}
