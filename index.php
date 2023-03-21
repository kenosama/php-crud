<?php

// Require the correct variable type to be used (no auto-converting)
declare(strict_types=1);


// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    echo "<pre>";
    var_dump($_GET);
    echo "</pre>";
    echo '<h2>$_POST</h2>';
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    // echo '<h2>$_COOKIE</h2>';
    //echo "<pre>";
    // var_dump($_COOKIE);
    //echo "</pre>";
    // echo '<h2>$_SESSION</h2>';
    //echo "<pre>";
    // var_dump($_SESSION);
    //echo "</pre>";
}
whatIsHappening();

// Load you classes
require_once 'config.php';
require_once 'classes/DatabaseManager.php';
require_once 'classes/CardRepository.php';

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);

$databaseManager->connect();

// This example is about a MTG card collection
// Update the naming if you'd like to work with another collection
$cardRepository = new CardRepository($databaseManager);
$cards = $cardRepository->get();

echo"this is cards <br> <br>";
echo "<pre>";
var_dump($cards);
echo"</pre>";
// Get the current action to execute
// If nothing is specified, it will remain empty (home should be loaded)
$action = $_GET['action'] ?? null;

// Load the relevant action
// This system will help you to only execute the code you want, instead of all of it (or complex if statements)
switch ($action) {
    case 'create':
        create();
        break;
    case 'delete':
        delete();
        break;
    default:
        overview();
        break;
}

function overview()
{
    // Load your view
    // Tip: you can load this dynamically and based on a variable, if you want to load another view
    global $cards;
    require 'overview.php';
}

function create()
{
    global $cardRepository;
    $cardName = isset($_GET["name"]) ? $_GET["name"] : null;
    $cardColor= isset($_GET["color"]) ? $_GET["color"]:null;
    $cardType = isset($_GET["type"]) ? $_GET["type"] : null;
    $cardPrice = isset($_GET["price"]) ? $_GET["price"] : null;
    $cardFoil = isset($_GET["foil"]) ? ($_GET["foil"] === "on" ? 1 : 0) : null;
    $cardExtention = isset($_GET["extention"]) ? $_GET["extention"] : null;

    $cardRepository->create($cardName, $cardColor, $cardType, $cardPrice, $cardFoil, $cardExtention);

    header("Location: index.php");
    exit();
}

function delete(){
    global $cards;
    global $cardRepository;


}
