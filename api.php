<?php
// Get the "pheptinh" and "correct" query parameters from the URL
if (isset($_GET['pheptinh']) && isset($_GET['correct'])) {
    $pheptinh = $_GET['pheptinh'];
    $correct = $_GET['correct'];

    // Define a regular expression pattern to match the allowed format of "pheptinh"
    $pattern = '/^\d+[-+]\d+=\d+$/';

    // Validate the "pheptinh" format
    if (preg_match($pattern, $pheptinh)) {
        // Validate the "correct" value to allow only "RIGHT" or "WRONG"
        if ($correct === 'RIGHT' || $correct === 'WRONG') {
            // Format the data as "{pheptinh} ==> {correct}"
            $formattedData = "$pheptinh ==> $correct";

            // Save the formatted data to a log file (e.g., log.txt)
            $logFileName = 'log.txt';
            $logFile = fopen($logFileName, 'a');

            if ($logFile) {
                fwrite($logFile, $formattedData . PHP_EOL); // Append data with a newline
                fclose($logFile);
                echo "Data saved successfully: $formattedData";
            } else {
                echo "Failed to open $logFileName for writing.";
            }
        } else {
            echo "Invalid 'correct' value. It should be 'RIGHT' or 'WRONG'.";
        }
    } else {
        echo "Invalid 'pheptinh' format. It should be in the format of '{number}{+ or -}{number}={number}'.";
    }
} else {
    echo "Missing 'pheptinh' or 'correct' parameter in the GET request.";
}
?>