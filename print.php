<?php
print_r($_POST);

// Symptoms
// foreach ($_POST['symptoms'] as $value) {
//     echo "value : " . $value . '<br/>';
// }

// foreach ($_POST['symptoms'] as $k) {
//     if (!isset($_POST[$k])) {
//         $_POST[$k] = '1';
//     }
// }

// $checkbox = $_POST['symptoms'];
// for ($i = 0; $i < count($checkbox); $i++) {
//     if ($checkbox[$i] != 1) {
//         $checkbox[$i] = true;
//     } else {
//         $checkbox[$i] = false;
//     }
// }
// print_r($checkbox);

// if(!isset($_POST['checkbox1']))
// {
//      $checkboxValue = false;
// } else {
//      $checkboxValue = $_POST['checkbox1'];
// }

$symptoms = [];

function isChecked($var)
{
    if (isset($_POST[$var])) {
        array_push($symptoms, $var, true);
    } else {
        array_push($symptoms, $var, false);
    }
}

$checkBox = ['fever', 'tiredness', 'dry-cough', 'difficulty-breathing', 'sore-throat', 'pains', 'nasal-congestion', 'runny-nose', 'diarrhea', 'none-experiencing'];
foreach ($checkBox as $cb) {
    isChecked($cb);
}

print_r($symptoms);

?>