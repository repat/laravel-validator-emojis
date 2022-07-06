<?php

namespace Repat\LaravelRules;

use Repat\LaravelRules\ContainsEmojis;

class ContainsEmojisTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Default Configuration
     *
     * @group default
     */
    public function testDefaultContainsEmojis()
    {
        $containsEmojis = new ContainsEmojis();

        // Empty string
        $this->assertFalse($containsEmojis->passes('', ""), "");

        // Only 1 Emoji
        $this->assertTrue($containsEmojis->passes('', "❤️"), "❤️");

        // Only 1 text character
        $this->assertFalse($containsEmojis->passes('', "x"), "x");

        // More than 1 Emoji (but no text)
        $this->assertTrue($containsEmojis->passes('', "❤️❤️❤️"), "❤️❤️❤️");

        // No Emoji at all
        $this->assertFalse($containsEmojis->passes('', "foobar"), "foobar");

        // Text and Emoji
        $this->assertTrue($containsEmojis->passes('', "barfoo🍕"), "barfoo🍕");
    }

    /**
     * Test ANY emoji present
     *
     * @group any
     */
    public function testContainsAnyEmojis()
    {
        $containsEmojis = new ContainsEmojis(["🍣", "🍔"]);

        $this->assertTrue($containsEmojis->passes('', "🍣"), "🍣");
        $this->assertFalse($containsEmojis->passes('', "🥢"), "🥢");
    }

    /**
     * Test ALL emoji present
     *
     * @group all
     */
    public function testContainsAllEmojis()
    {
        $containsEmojis = new ContainsEmojis(["🏍", "⛵"], true);

        // $this->assertTrue($containsEmojis->passes('', "⛵ 🏍"), "⛵🏍");
        $this->assertTrue($containsEmojis->passes('', "⛵ 🏍 🏎"), "⛵🏍🏎");
        // $this->assertFalse($containsEmojis->passes('', "🏍 🏎"), "🏍🏎");
        // $this->assertFalse($containsEmojis->passes('', "🏍"), "🏍");
    }
}
