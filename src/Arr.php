<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 10:28
 */

namespace Aw;

class Arr
{
    /**
     * @param $arr
     * @param $key
     * @param mixed $default
     * @return mixed
     */
    public static function get_item($arr, $key, $default = null)
    {
        if (array_key_exists($key, $arr)) {
            return $arr[$key];
        }
        return $default;
    }

    /**
     * array(外键,新KEY,JOIN_ARRAY)
     * merge($ori, array('fk','new_key',$array),...)
     * @return array
     */
    public static function leftJoin()
    {
        $args = func_get_args();

        if (empty($args)) {
            return array();
        }

        $arr = array_shift($args);

        if (empty($args))
            return $arr;
        foreach ($arr as & $item) {
            foreach ($args as $arg) {
                if (!is_array($arg) || count($arg) != 3)
                    continue;
                $key = $arg[0];
                $new = $arg[1];
                $val = $arg[2];
                if (array_key_exists($key, $item)) {
                    $item[$new] = self::get_item($val, $item[$key]);
                }
            }
        }
        return $arr;
    }


    /**
     * 严格模式下,FILTERS中的key必须全部存在,否则返回空
     * @param $array
     * @param $filters
     * @param bool $strict
     * @return array
     */
    public static function get($array, $filters, $strict = true)
    {
        return self::_get($array, $filters, $strict);
    }

    /**
     * filter不是数组和字符串,返回ARRAY
     * @param $array
     * @param $filters
     * @return array
     */
    public static function except($array, $filters)
    {
        return self::_get($array, $filters, false, false);
    }

    private static function _get($array, $filters, $strict = true, $keep = true)
    {
        if (is_string($filters)) {
            $filters = explode(",", $filters);
        }
        if (!is_array($filters)) {
            if ($strict)
                return array();
            return $array;
        }
        $ret = array();
        foreach ($filters as $filter) {
            if (!array_key_exists($filter, $array)) {
                if ($keep) {
                    if ($strict)
                        return array();
                } else {
                    $ret[$filter] = $array[$filter];
                }
            } else {
                $ret[$filter] = $array[$filter];
            }
        }
        return $ret;
    }
}