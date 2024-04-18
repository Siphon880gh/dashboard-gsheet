<?php
    // Gotten
    // $spreadsheet for $service->spreadsheets->get($spreadsheetId);
    // spreadsheetId
    // $tabName


    $response = $service->spreadsheets_values->get($spreadsheetId, $tabName);

    $values = $response->getValues();
    $json = "";
    makeParseable($values, $json);
    // require_once "./public/modal-1.php";


?>