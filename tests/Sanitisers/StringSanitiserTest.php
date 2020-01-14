<?php

namespace Tests\Sanitisers;

use App\Sanitisers\StringSanitiser;
use PHPUnit\Framework\TestCase;

class StringSanitiserTest extends TestCase
{
    public function testStringAlreadyOK()
    {
        $testString = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!"£$%^&*()[]{}:@~;#,./<>?|';
        $testString2 = "'\\";

        $this->assertEquals(
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!"£$%^&*()[]{}:@~;#,./?|',
            StringSanitiser::sanitise($testString)
        );
        $this->assertEquals($testString2, StringSanitiser::sanitise($testString2));
    }

    public function testHtmlTagsRemoved()
    {
        $testString = '<div></div><p></p><span></span><link/><script></script>';
        $this->assertEquals('', StringSanitiser::sanitise($testString));
    }

    public function testInvalidCharsSubstituted()
    {
        $testString = '';
        $this->assertEquals('�', StringSanitiser::sanitise($testString));
    }
}
