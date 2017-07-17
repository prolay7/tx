<?php

function getNameFromNumber($num, $index=0) {
        $index = abs($index*1); //make sure index is a positive integer
        $numeric = ($num - $index) % 26; 
        $letter = chr(65 + $numeric);
        $num2 = intval(($num -$index) / 26);
        if ($num2 > 0) {
            return getNameFromNumber($num2 - 1 + $index) . $letter;
        } else {
            return $letter;
        }
}

function moveElement(&$array, $a, $b) {
    $out = array_splice($array, $a, 1);
    array_splice($array, $b, 0, $out);
}

if (!function_exists('array_to_comma_seperated'))
 {
 function array_to_comma_seperated($array)
  {
  return implode(",", $array);
  }
 }

 if (!function_exists('comma_separated_to_array'))
 {
 function comma_separated_to_array($string, $separator = ',')
  {

  $vals = explode($separator, $string);

    foreach($vals as $key => $val)
   {
      $vals[$key] = trim($val);
   }

  return array_diff($vals, array(
   ""
  ));
  }
 }

//function add_key_value_to_arr($arr=array(),)