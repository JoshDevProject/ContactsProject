<?php
//make sure a function was picked for processing data
if (isset($_POST['processor']))
{
    //calls the function associated with the processor
    switch($_POST['processor'])
    {
        case 'reverse_string':
            reverse_string();
            break;
        default:
            echo "No matching processor for: " . $_POST['processor'];
    }
}
else echo "No function assigned for processing.";

function reverse_string()
{
    if (isset($_POST['varToProcess']))
    {
        $name = $_POST['varToProcess'];
        echo strrev($name);
    }
}
?>
