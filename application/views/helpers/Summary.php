<?php 
class Zend_View_Helper_Summary extends Zend_View_Helper_Abstract 
{
public function summary ($inputText, $number)
{
    // using a regular expression to split the inputText by anything that is considered whitespace
    $words = preg_split('~\s~', $inputText, -1, PREG_SPLIT_NO_EMPTY);
    // make sure the number of words we want will not be out of range
    $number = min(count($words), $number);  
    // slice the number of words we want from the array and glue them together with spaces
    return implode(' ', array_slice($words, 0, $number));
}

} 
?>