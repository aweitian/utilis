<?php

use Aw\Arr;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 10:44
 */
class ArrTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $array = array(
            'name' => 'name_ff',
            'age' => 55,
            'sex' => 'male',
            'extra' => 'abandon'
        );

        $this->assertEquals(array(
            'name' => 'name_ff',
            'age' => 55,
            'sex' => 'male',
        ), Arr::get($array, 'name,age,sex'));

        $this->assertEquals(array(), Arr::get($array, 'name,age,sx'));
        $this->assertEquals(array(
            'name' => 'name_ff',
            'age' => 55
        ), Arr::get($array, 'name,age,sx', false));
    }

}
