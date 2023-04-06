<?php

namespace Application\Test;

use PHPUnit\Framework\TestCase;

class DefaultTester extends TestCase
{
    public function test_default()
    {
        $hello = 'oi';

        $this->assertSame('oi', $hello);
    }
}