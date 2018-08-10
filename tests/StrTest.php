<?php

use Aw\Str;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 10:44
 */
class StrTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $a = Str::random('4', 1);
        $this->assertTrue(!!preg_match("/^\d+$/", $a));
        $a = Str::random('4', 2);
        $this->assertTrue(!!preg_match("/^[a-z]+$/", $a));
        $a = Str::random('4', 4);
        $this->assertTrue(!!preg_match("/^[A-Z]+$/", $a));
    }

    public function testStartWith()
    {
        $this->assertTrue(Str::endsWith("balabala", "la"));
        $this->assertTrue(!Str::endsWith("balabala", "laa"));

        $this->assertTrue(Str::startsWith("balabala", "ba"));
        $this->assertTrue(!Str::startsWith("balabala", "xba"));

    }
}
