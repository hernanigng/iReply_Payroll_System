<?php

if(isset($_POST['totalEarnings'])) {
    $totalEarnings = str_replace(',', '', $_POST['totalEarnings']);

    $withholding_tax = 0;

    // Formula for calculating withholding tax
    if ($totalEarnings <= 20833) {
        $withholding_tax = 0;
    } elseif ($totalEarnings > 20833 && $totalEarnings <= 33332) {
        $excess_earning = $totalEarnings - 20833;
        $withholding_tax = $excess_earning * 0.15;
    } elseif ($totalEarnings > 33332 && $totalEarnings <= 66666) {
        $excess_earning = $totalEarnings - 33333;
        $withholding_tax = ($excess_earning * 0.20) + 1875;
    } elseif ($totalEarnings > 66666 && $totalEarnings <= 166666) {
        $excess_earning = $totalEarnings - 66667;
        $withholding_tax = ($excess_earning * 0.25) + 8541.80;
    } elseif ($totalEarnings > 166666 && $totalEarnings <= 666666) {
        $excess_earning = $totalEarnings - 166667;
        $withholding_tax = ($excess_earning * 0.30) + 33541.80;
    } else {
        $excess_earning = $totalEarnings - 666667;
        $withholding_tax = ($excess_earning * 0.35) + 183541.80;
    }

    // Return the calculated withholding tax
    echo $withholding_tax;
} else {
    // Return an error message if total earnings value is not provided
    echo 'Error: Total earnings value not provided';
}

?>
