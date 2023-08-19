<?php 

function isWithin5Minutes($dateString) {
    // Convert the input date string to a DateTime object
    $inputDate = new DateTime($dateString);
    
    // Get the current date and time
    $currentDate = new DateTime();
    
    // Calculate the difference in seconds between the input date and current date
    $difference = $inputDate->getTimestamp() - $currentDate->getTimestamp();
    
    // Check if the difference is within 5 minutes (300 seconds)
    if (abs($difference) <= 300) {
        return true;
    } else {
        return false;
    }
}


?>