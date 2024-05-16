<?php
ini_set('log_errors', 1);  
error_reporting(E_ALL);  
session_start();

// Set error logging to page
ini_set('display_errors', 1); // displays errors on page

/* INPUTS
Will be processed into $json and $overrideStyleBlock for templates
______________________________________________________________________ */
$inputs = [
    /* Connections */
    // No edit query at the end, Eg:
    // "spreadsheetUrl"=>"https://docs.google.com/spreadsheets/d/1Xe6cGeHCf8kuTX-jLXr6wxDYe9xuJ76zQCEiKjnpVm8/",
    "spreadsheetUrl"=>"https://docs.google.com/spreadsheets/d/1Xe6cGeHCf8kuTX-jLXr6wxDYe9xuJ76zQCEiKjnpVm8/",
    "tabName"=>"Test",
    "creds"=>dirname(__FILE__) . "/../keys/fintest-wengf-service-account.json",

    /* Display */
    "pageTitle"=>"Dashboard",
    "pageDescription"=>"Monitor Stock: Apple, Google, Tesla<br/>In the future will have more options...",

    /* Optionals OR set as defaults 0 and "" respectively */
    "timeLeft"=>0,
    "cssOverride"=>".question {
        border: 1px solid black;
        background-color: white !important;
    }"
];

/* DEVELOPER READABILITY & MAINTAINABILITY
This is for readability & maintainability
______________________________________________________________________ */
$_SESSION["spreadsheet-link"] = $inputs["spreadsheetUrl"];

$re = '/.*\/(.+)\/$/m';
preg_match_all($re, $inputs["spreadsheetUrl"], $matches, PREG_SET_ORDER, 0);
$connectToSpreadSheetUrlId = $matches[0][1];
// $connectToTab = $inputs["tabName"];
$connectToTab = -1;

$pageTitle = $inputs["pageTitle"];
$pageDesc = $inputs["pageDescription"];

$timeLeft = $inputs["timeLeft"];
$overrideCSS = $inputs["cssOverride"];

/* ENGINE
   Do not touch
______________________________________________________________________ */

// Check is initialized and not visited directly. If visited directly with no session, then initialize
// Error? gsheets accept only flat directory listing. It would have all folders then inside folder would have the quiz php files and credential creds.json files.
// require_once "./controllers/check-initialized.php";

// Check credential file correct.
$credsGsheetJSONFile = $inputs["creds"];
file_exists($credsGsheetJSONFile) or die("Error: Failed to load credentials $credsGsheetJSONFile. Contact administrator");

// Load in Composer libraries
require_once './vendor/autoload.php';

// Connect API with credentials
require_once "./controllers/connect-gsheet.php";

// Render quiz page
require_once "./public/multipane.php";
?>