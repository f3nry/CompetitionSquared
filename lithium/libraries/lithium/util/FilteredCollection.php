<?php

namespace lithium\util;

/**
 * FilteredCollection
 *
 * Allows the filtering of array elements by name.
 *
 * @author Paul Henry <paulhenry@mphwebsystems.com>
 */
class FilteredCollection extends \lithium\util\Collection {

    /**
     * Returns an array of all elements in $data that have the text $key in them.
     *
     * TODO: Add multi-level array support. Only supports arrays that are one-level deep.
     *
     * @param string $key The key to search for.
     * @param array $data The actual array
     * @return array The filtered array.
     */
    public static function filterByKey($key, $data, $trim = false) {
        $newData = array();
        
        foreach($data as $itemKey => $item) {
            if(!(strpos($itemKey, $key) === false)) {
                if($trim) {
                    $itemKey = trim(str_replace($key, "", $itemKey), '_');
                }

                $newData[$itemKey] = $item;
            }
        }

        return $newData;
    }

    /**
     * Transforms an array like this (Sorry for the bluntness):
     *
     * ["field_0_a" => "value", "field_0_b" => "value", "field_1_a" => "value", "field_1_b" => "value"]
     *
     * To:
     * 
     * ["field_0"],
     *      -> ["a" => "value", "b" => "value"]
     * ["field_1"]
     *      -> ["a" => "value", "b" => "value"]
     *
     * @param string $key The beginning part of the keys to split.
     * @param array $data The data to work with.
     * @return array The filtered array.
     */
    public static function filterByKey2D($key, $data) {
        $newData = array();

        foreach($data as $itemKey => $item) {
            if(substr($itemKey, 0, strlen($key)) == $key) {
                $pos = strpos($itemKey, $key) + strlen($key) + 1;

                list($index, $actualIndex) = self::parseNumber($itemKey, $pos);

                $newData[$key . "_" . $index][substr($itemKey, $actualIndex + 1)] = $item;
            }
        }

        return $newData;
    }

    /**
     * Extract all numeric characters in a sequence from $start until a non-numeric character is encountered.
     *
     * @param string $string The string to work with.
     * @param integer $start The index to start working at.
     * @return integer The parsed number.
     */
    private static function parseNumber($string, $start) {
        $number = "";
        $i = 0;
        
        for($i = $start; $i < strlen($string) && is_numeric($string[$i]); $i++) {
            $number .= $string[$i];
        }
        
        return array($number, $i);
    }
}