<?php
declare(strict_types=1);    // Use strict type checking

ini_set('display_errors', '1');    // Display errors
ini_set('display_startup_errors', '1');    // Display startup errors
error_reporting(E_ALL);    // error reporting

require_once 'config.php';    // Include config file
require_once 'classes/DatabaseManager.php';    // Include DatabaseManager file
require_once 'classes/CardRepository.php';    // Include CardRepository file

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);    // Create databaseManager object

$databaseManager->connect();    // Connect to database
$cardRepository = new CardRepository($databaseManager);    // Create CardRepository object

$action = $_GET['action'] ?? null;    // Get action from the request

switch ($action) {    // Switch statement
    case 'create':    // case create
        create();    // call create function
        break;    // break statement
    case 'delete':    // case delete
        delete();    // call delete function
        break;    // break statement
    case 'update':    // case update
        update();    // call update function
        break;    // break statement
    case 'updated':    // case updated
        update();    // call update function
        break;    // break statement
    case 'filter':    // case filter
        filter();    // call filter function
        break;    // break statement
    default:    // default body
        overview();    // call overview function
        break;    // break statement
}

function overview()    // overview function
{
    global $cardRepository;    // use cardRepository variable globally
    $cards = $cardRepository->get();    // Get all cards from database
    $types = $cardRepository->getTypes();    // Get all types from database
    $colors = ['emerald', 'blue', 'green', 'yellow', 'indigo', 'purple', 'pink', 'orange'];    // initialize colors array
    $colorIndex = 0;    // initialize colorIndex variable
    require 'overview.php';    // include overview.php file
}

function create()    // create function
{
    global $cardRepository;    // use cardRepository variable globally
    $cardRepository->create();    // call create function of cardRepository
    header("Location: ./");    // Redirect to home page
    exit();    // exit statement
}

function update(){    // update function
    global $cardRepository;    // use cardRepository variable globally
    if($_GET["action"] === "update"){    // check if action is update
        $card = $cardRepository->getSpecifiedCard($_GET["Id"]);    // Get card from database
        require'edit.php';    // include edit.php file
    }elseif ($_GET["action"] === "updated") {    // check if action is updated
        global $cardRepository;    // use cardRepository variable globally
        $cardRepository->update();    // call update function of cardRepository
        header("Location: ./");    // Redirect to home page
        exit();    // exit statement
    }
}

function delete(){    // delete function
    global $cardRepository;    // use cardRepository variable globally
    $cardId= isset($_GET["Id"]) ? $_GET["Id"] : null;    // Get card id from request
    $cardRepository->delete($cardId);    // call delete function of cardRepository
    header("Location: ./");    // Redirect to home page
    exit();    // exit statement
}

function filter(){    // filter function
    global $cardRepository;    // use cardRepository variable globally
    $types = $cardRepository->getTypes();    // Get all types from database
    $type = isset($_GET["type"]) ? $_GET["type"] : null;    // Get type from request
    $cards=$cardRepository->getSpecifiedType($type);    // Get all cards of specified type from database
    $colors = ['emerald', 'blue', 'green', 'yellow', 'indigo', 'purple', 'pink', 'orange'];    // initialize colors array
    $colorIndex = 0;    // initialize colorIndex variable
    require 'overview.php';    // include overview.php file
}
