<?php
    require __DIR__ . '/vendor/autoload.php';

    $db = mysqli_connect("localhost", "root", "", "db_ac_app");

    $client = new \Google_Client();
    $client->setApplicationName("Google Sheets and PHP");
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAccessType('offline');
    $client->setAuthConfig(__DIR__ . '/credentials.json');
    $service = new Google_Service_Sheets($client);

    $spreadsheetId = config('google.spreadsheet_id');

    $range = "All commands";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    mysqli_query($db, "TRUNCATE `airconditioners`");
    $sQuery = "INSERT INTO `airconditioners` (`sku`, `url`, `brand`) VALUES ";
    $aQuery = [];
    foreach($values as $key => $row_data) {
        if ($key > 0) {
            $aQuery[] = "('".addslashes(trim($row_data[0]))."', '".addslashes(trim($row_data[1]))."', '".addslashes(trim($row_data[2]))."')";
        }
    }

    $sQuery .= join(",", $aQuery);
    
    $eQuery = mysqli_query($db, $sQuery);
    if ($eQuery == true) 
        echo  "Successfully saved";
    else 
        echo  "Failed to save";