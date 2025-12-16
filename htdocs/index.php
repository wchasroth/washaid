<?php

require '../vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('Google Sheets PHP Reader');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS_READONLY]);
$client->setAuthConfig('../credentials.json'); // Path to your downloaded JSON file

$service = new Google_Service_Sheets($client);
$spreadsheetId = 'YOUR_SPREADSHEET_ID'; // The ID in the middle of your sheet's URL
$spreadsheetId = '1PLiWyV-UdVZujN4K4wTcyrf3pql6dX5i6dSwd8AZpa8';

$range = 'Sheet1!A1:E8'; // Example: range of cells to retrieve

echo "<html><body>\n";
echo "<pre>\n";
try {
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    if (empty($values)) {
        echo "No data found.\n";
    } else {
        echo "Data from your Google Sheet:\n";
        foreach ($values as $row) {
            // Print each row as a comma-separated string for display
            echo implode(', ', $row) . "\n";
        }
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

echo "</pre>\n";
echo "</body>\n";
echo "</html>\n";

