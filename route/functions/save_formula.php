<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $basicPayFormula = $_POST['basicPayFormula'];

    // Save the formula to a file or database
    // For simplicity, we save it to a file
    file_put_contents('formula.txt', $basicPayFormula);

    echo 'Success';
}
