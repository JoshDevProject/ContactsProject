<?php

$myArray = array("Hi"=>
    array("blah"=>"blah2","blah1"=>"meh"),
    array(1,2,3,array(122,3,4,3))
);

function convertArray($multiDimArray, &$singleDimArray, $path ='')
{
    //check that the multiDimArray is an array to loop through
    if (is_array($multiDimArray))
    {
        //loop through this dimension of the array
        foreach ($multiDimArray as $key => $value)
        {
            //if the key is not another array
            if (!is_array($value))
            {     
                $singleDimArray[] = $path . '/' . $key . '<br/>';
            }
            convertArray($value, $singleDimArray, $path . '/' . $key);
        }
    }
}

$newArray = array();
convertArray($myArray, $newArray);

print_r($newArray);

//print_rArray ( 
//[Hi] => Array ( 
//  [blah] => blah2 
//  [blah1] => meh ) 
//[0] => Array ( 
//  [0] => 1 
//  [1] => 2 
//  [2] => 3 
//  [3] => Array ( 
//      [0] => 122 
//      [1] => 3 
//      [2] => 4 
//      [3] => 3 ) ) )
//      
//
//Hi/blah/blah2
//Hi/blah1/meh
//0/0/1
//0/1/2
//0/2/4
//0/3/0/122
//0/3/1/3
//0/3/2/4
//0/3/3/3
//


?>
