<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize inputs
    $foodSelectField = filter_input(INPUT_POST, 'foodSelectField', FILTER_SANITIZE_STRING);
    $quantityTextField = filter_input(INPUT_POST, 'quantityTextField', FILTER_SANITIZE_NUMBER_INT);
    $cashTextField = filter_input(INPUT_POST, 'cashTextField', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Validate quantity and cash inputs
    if ($quantityTextField <= 0 || $cashTextField <= 0) {
        echo "<h2>Invalid quantity or cash provided!</h2>";
        exit;
    }

    // Determine food price based on selected food item
    $foodPrice = 0;
    switch ($foodSelectField) {
        case 'Kare-Kare':
            $foodPrice = 150;
            break;
        case 'Sinigang':
            $foodPrice = 140;
            break;
        case 'Adobo':
            $foodPrice = 160;
            break;
        default:
            echo "<h2>Invalid food selection!</h2>";
            exit;
    }

    // Calculate total cost and change
    $totalCost = $foodPrice * $quantityTextField;
    $moneyChange = $cashTextField - $totalCost;

    // Display messages based on the amount of cash provided
    if ($moneyChange >= 0) {
        echo "<h2>The total cost is: " . number_format($totalCost, 2) . " PHP</h2>";
        echo "<h2>Your change is: " . number_format($moneyChange, 2) . " PHP</h2>";
        echo "<h3>THANK YOU FOR ORDERING!</h3>";
    } else {
        echo "<h2>Not enough cash!</h2>";
        $missingCash = abs($moneyChange);
        echo "<h2>You need " . number_format($missingCash, 2) . " PHP more!</h2>";
    }
}
?>
