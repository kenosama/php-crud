<?php

// Require the correct variable type to be used (no auto-converting)    // Strict type check for data types
declare(strict_types=1);    // Strict type check for data types


// Show errors so we get helpful information
ini_set('display_errors', '1');    // Enable error reporting by setting display_errors to 1
ini_set('display_startup_errors', '1');    // Enable error reporting by setting display_startup_errors to 1
error_reporting(E_ALL);    // Enable error reporting by setting error_reporting to E_ALL
  // Calls function whatIsHappening()

// Load you classes
require_once 'config.php';    // Require config.php file
require_once 'classes/DatabaseManager.php';    // Require DatabaseManager.php file
require_once 'classes/CardRepository.php';    // Require CardRepository.php file

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);    // Initialize an object of DatabaseManager class

$databaseManager->connect();    // Connect to database

// This example is about a MTG card collection
// Update the naming if you'd like to work with another collection
$cardRepository = new CardRepository($databaseManager);    // Initialize an object of CardRepository class

// Get the current action to execute
// If nothing is specified, it will remain empty (home should be loaded)
$action = $_GET['action'] ?? null;    // Assign action to action variable, if action is empty, it will be null

// Load the relevant action
// This system will help you to only execute the code you want, instead of all of it (or complex if statements)
switch ($action) {    // Switch case block
    case 'create':    // Case to create a card
        create();    // Call create() function
        break;    // Break the switch case block
    case 'delete':    // Case to delete a card
        delete();    // Call delete() function
        break;    // Break the switch case block
    case 'update':    // Case to update a card
        update();    // Call update() function
        break;
    case 'updated':    // Case to update a card
        update();    // Call update() function
        break;// Break the switch case block
    case 'filter':
        filter();
        break;
    default:    // This is default case
        overview();    // Call overview() function
        break;    // Break the switch case block
}

function overview()    // Function to display the overview of the cards
{
    // Load your view
    // Tip: you can load this dynamically and based on a variable, if you want to load another view
    // Global variable to get all cards
    global $cardRepository;
    $cards = $cardRepository->get();    // Gets cards from database
    $types = $cardRepository->getTypes();
    $colors = ['emerald', 'blue', 'green', 'yellow', 'indigo', 'purple', 'pink', 'orange'];
    $colorIndex = 0;
    require 'overview.php';    // Require overview.php file
}

function create()    // Function to create a card
{
    global $cardRepository;    // Global variable to access object of CardRepository class
    // Assign extension of the card to $cardExtension
    $cardRepository->create();    // Call create() method of CardRepository class
    header("Location: ./");    // Redirects to the same page
    exit();    // Exits the script
}

function update(){
    global $cardRepository;
    if($_GET["action"] === "update"){
        $card = $cardRepository->getSpecifiedCard($_GET["Id"]);
        require'edit.php';
    }elseif ($_GET["action"] === "updated") {
        // Function to update a card
        global $cardRepository;    // Global variable to access the object of CardRepository class
        $cardRepository->update();    // Call update() method of CardRepository class
        header("Location: ./");    // Redirects to the same page
        exit();// Exits the script
    }    
}

function delete(){    // Function to delete a card
    global $cardRepository;    // Global variable to access the object of CardRepository class
    $cardId= isset($_GET["Id"]) ? $_GET["Id"] : null;    // Assign id of the card to $cardId
    $cardRepository->delete($cardId);    // Call delete() method of CardRepository class
    header("Location: ./");    // Redirects to the same page
    exit();    // Exits the script
}

function filter(){
    global $cardRepository;
    $types = $cardRepository->getTypes(); 
    $type = isset($_GET["type"]) ? $_GET["type"] : null;
    $cards=$cardRepository->getSpecifiedType($type);
    $colors = ['emerald', 'blue', 'green', 'yellow', 'indigo', 'purple', 'pink', 'orange'];
    $colorIndex = 0;
    require 'overview.php';
}

