<?php
/*******************************************************************************
 * set value for array when know index
 * @param [type] &$array [reference to $array input]
 * @param [type] $key    [index of element]
 * @param [type] $value  [value of element]
 ******************************************************************************/
if (!function_exists("setArray")) {
    function setArray(&$array, $key, $value) {
        // address of array input
        $tmp = & $array;
        $key = explode(".", trim($key, ". "));

        // create references to element which need set value
        foreach ($key as $index) {
            // address of $array[index]n because $tmp and array input point to same address
            $tmp = & $tmp[$index];
        }

        $tmp = $value;
    }
}

/*******************************************************************************
 * get value from array by index
 ******************************************************************************/
if (!function_exists("getArrayValue")) {
    function getArrayValue(&$array, $keys) {
        // address of array input
        $tmp = & $array;
        $keys = explode(".", trim($keys, ". "));

        // create references to element which need set value
        foreach ($keys as $key) {
            // address of $array[index]n because $tmp and array input point to same address
            $tmp = & $tmp[$key];
        }
        return $tmp;
    }
}

/*******************************************************************************
 * check if one key exist in array
 ******************************************************************************/
if (!function_exists("checkKeyExist")) {
    function checkKeyExist($array, $key) {
        if (!is_array($array)) {
            return false;
        }

        if (array_key_exists($key, $array)) {
            return true;
        }

        foreach ($array as $subArray) {
            if (checkKeyExist($subArray, $key)) {
                return true;
            }
        }

        return false;
    }
}

/*******************************************************************************
 * check if a list of consecutive keys exists || check if an element exist
 * input string $arr[a][b][c] -> ($arr, 'a.b.c')
 * output boolean true || false
 ******************************************************************************/
if (!function_exists("array_keys_exist")) {
    function array_keys_exist($array, $keys) {
        $keys = explode(".", trim($keys, ". "));
        // count the number of passed levels
        $count = 0;

        // number of key <=> number of level
        $numberKey = count($keys);

        while (true) {
            $match = 0;
            if (!is_array($array)) {
                return false;
            }

            foreach ($array as $key => $subArray) {
                if (reset($keys) == $key) {
                    array_shift($keys);
                    $array = $subArray;
                    $match++;
                    break;
                }
            }

            // if no key pairs match in each level return false
            if ($match === 0) {
                return false;
            }

            if (++$count === $numberKey) {
                break;
            }
        }
        return true;
    }
}

/**
 * them hoac dat gia tri cho mot phan tu trong mang
 */
if (!function_exists("array_set")) {
    function array_set(&$array, $key, $value = null) {
        if (is_null($key)) {
            $array = $value;
            return;
        }

        $keys = explode(".", trim($key, ". "));

        while (count($keys) > 1) {
            $k = array_shift($keys);

            if (!isset($array[$k]) || !is_array($array[$k])) {
                $array[$k] = array();
            }

            $array = & $array[$k];
        }

        $array[array_shift($keys) ] = $value;
    }
}


/**
 *  lay gia tri cua mot phan tu trong mang
 */
if (!function_exists("array_get")) {
    function array_get($array, $key = null) {
        if (is_null($key)) {
            return $array;
        }

        if (array_key_exists($key, $array)) {
           return $array[$key];
        }

        $keys = explode(".", trim($key, ". "));

        foreach ($keys as $key) {
           if (is_array($array) && array_key_exists($key, $array)) {
              $array = $array[$key];
           } else {
              return null;
           }
        }

        return $array;
    }
}


/**
 * kiem tra trong mang co phan tu voi index = $key
 */
if (!function_exists("array_has_key")) {
   function array_has_key($array, $key = null) {
        if (is_null($key)) {
           return false;
        }

        $keys = explode(".", trim($key, ". "));

        foreach ($keys as $key) {
            if (is_array($array) && array_key_exists($key, $array)) {
                $array = $array[$key];
            } else {
                return false;
            }
        }

        return true;
   }
}