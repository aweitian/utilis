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
        ), Arr::get($array, 'name', 'age', 'sex'));

        $this->assertEquals(array(), Arr::get($array, 'name', 'age', 'sx'));
        $this->assertEquals(array(
            'name' => 'name_ff',
            'age' => 55
        ), Arr::get($array, 'name', 'age', 'sx', false));
    }


    public function testG()
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
        ), Arr::g($array, array('name', 'age', 'sex')));

        $this->assertEquals(array(), Arr::g($array, array('name', 'age', 'sx'), true));
        $this->assertEquals(array(
            'name' => 'name_ff',
            'age' => 55
        ), Arr::g($array, array('name', 'age', 'sx'), false));
    }

    public function testExcept()
    {
        //except 没有严格模式
        $array = array(
            'name' => 'name_ff',
            'age' => 55,
            'sex' => 'male',
            'extra' => 'abandon'
        );

        $this->assertEquals(array(
            'name' => 'name_ff',
            'sex' => 'male',
        ), Arr::except($array, 'extra', 'age'));

        $this->assertEquals(array(
            'sex' => 'male',
            'extra' => 'abandon'
        ), Arr::except($array, 'name', 'age', 'sx'));
    }

    public function testE()
    {
        $array = array(
            'name' => 'name_ff',
            'age' => 55,
            'sex' => 'male',
            'extra' => 'abandon'
        );

        $this->assertEquals(array(
            'name' => 'name_ff',
            'sex' => 'male',
        ), Arr::e($array, array('extra', 'age')));

        $this->assertEquals(array(
            'sex' => 'male',
            'extra' => 'abandon'
        ), Arr::e($array, array('name', 'age', 'sx')));

        $this->assertEquals($array, Arr::e($array, array()));
    }

    public function testGetItem()
    {
        $array = array(
            'name' => 'name_ff',
            'age' => 55,
            'sex' => 'male',
            'extra' => 'abandon'
        );

        $this->assertEquals('abandon', Arr::get_item($array, 'extra', 'age'));
        $this->assertEquals('not_exist_v', Arr::get_item($array, 'not_exist', 'not_exist_v'));
    }

    public function testLeftJoin()
    {
        $array = array(array(
            'id' => '1',
            'age' => 55,
            'sex' => 'male',
            'extra' => 'abandon'
        ), array(
            'id' => '2',
            'age' => 22,
            'sex' => 'female',
            'extra' => 'abandon'
        ), array(
            'id' => '5',
            'age' => 11,
            'sex' => 'female',
            'extra' => 'x'
        ));
        $extra = array(
            "1" => "zs",
            "2" => "ls"
        );
        $extra2 = array(
            "male" => "boy",
            "female" => "girl"
        );
        $new = Arr::leftJoin(
            $array,
            array('id', 'name', $extra),
            array('sex', 'sex_value', $extra2)
        );
        $ret = array(
            array(
                'id' => '1',
                'age' => 55,
                'sex' => 'male',
                'extra' => 'abandon',
                'name' => 'zs',
                'sex_value' => 'boy',
            ),
            array(
                'id' => '2',
                'age' => 22,
                'sex' => 'female',
                'extra' => 'abandon',
                'name' => 'ls',
                'sex_value' => 'girl',
            ),
            array(
                'id' => '5',
                'age' => 11,
                'sex' => 'female',
                'extra' => 'x',
                'name' => NULL,
                'sex_value' => 'girl',
            ),
        );
        $this->assertEquals($ret, $new);
    }
}
