<?php
// Start the session
session_start();

// Check if the session variable for the array is set
if (!isset($_SESSION['numbers'])) {
    // If not, initialize it as an empty array
    $_SESSION['numbers'] = array();
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the value from the form
    $newNumber = $_POST['newNumber'];

    // Check if it's a number
    if (is_numeric($newNumber)) {
        // If it is, add it to the array
        $_SESSION['numbers'][] = $newNumber;
    }
}

// Calculate the average of the array
if (count($_SESSION['numbers']) > 0){
    $sum = array_sum($_SESSION['numbers']);
    $average = $sum / count($_SESSION['numbers']);
    $count = count($_SESSION['numbers']);
} else {
    $average = "";
    $count = 0;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Opdracht 6</title>
</head>
<body>
    <H1>Opdracht 8</H1>
    <form action="" method="post">
        <label for="newNumber">Cijfer:</label>
        <input type="text" id="newNumber" name="newNumber">
        <input type="submit" name="submit" value="Toevoegen">
    </form>
    <p>Gemiddelde: <?php echo $average; ?></p>
    <p>Aantal ingevoerde cijfers: <?php echo $count; ?></p>
</body>
</html>