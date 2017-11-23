<?php
namespace Models;

class ParamsModifier
{

    public static function arrayToString(array $post_data, array $params, string $glue = ',')
    {
        foreach ($params as $param) {
            $post_data['args'][$param] = implode($glue, $post_data['args'][$param]);
        }
        return $post_data;
    }


    public static function coordinatesToLonLat(array $post_data, array $params)
    {
        $post_data['args'][$params[0]] = explode(',', $post_data['args']['coordinates'])[0];
        $post_data['args'][$params[1]] = explode(',', $post_data['args']['coordinates'])[1];
        unset($post_data['args']['coordinates']);
        return $post_data;
    }

    public static function arrayToMultiArray(array $post_data, string $arrayKey, array $params)
    {
        foreach ($params as $key => $value) {
            if (!empty($post_data['args'][$value])) {
                $post_data['args'][$arrayKey][$key] = $post_data['args'][$value];
                unset($post_data['args'][$value]);
            }
        }
        return $post_data;
    }
    public static function timeToUnixtime ($date){
        if (!empty($date)) {
            $dateTime = new \DateTime($date);
            return $dateTime->getTimestamp();
        } else {
            return $date;
        }
    }
    public static function booleanToNumber($param)
    {

        $result = $param == 'true' ? "1" : "0";
        return $result;
    }

}
