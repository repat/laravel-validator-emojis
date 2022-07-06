<?php

namespace Repat\LaravelRules;

use Repat\LaravelRules\DoesntContainEmojis;

class DoesntContainEmojisTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Default Configuration
     *
     * @group default
     */
    public function testDefaultDoesntContainEmojis()
    {
        $doesntContainEmojis = new DoesntContainEmojis();

        // Empty string
        $this->assertTrue($doesntContainEmojis->passes('', ""), "");

        // Only 1 Emoji
        $this->assertFalse($doesntContainEmojis->passes('', "❤️"), "❤️");

        // Only 1 text character
        $this->assertTrue($doesntContainEmojis->passes('', "x"), "x");

        // More than 1 Emoji (but no text)
        $this->assertFalse($doesntContainEmojis->passes('', "❤️❤️❤️"), "❤️❤️❤️");

        // No Emoji at all
        $this->assertTrue($doesntContainEmojis->passes('', "foobar"), "foobar");

        // Text and Emoji
        $this->assertFalse($doesntContainEmojis->passes('', "barfoo🍕"), "barfoo🍕");
    }
}
