<?php

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

$card = $cardRepository->getSpecifiedCard($_GET["Id"]);

echo "<pre>";
var_dump($card);
echo "</pre>";


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goodcard - track your collection of Pokémon cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" bg-neutral-800 text-white">


    <div class="border bg-slate-500 p-3 rounded mx-2 mb-7">
        <h1 class="text-xl mb-5">Update a card</h1>
        <form method="get" action="index.php">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $card[0]["id"] ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="mb-2 text-black px-2" value="<?= $card[0]["name"] ?>">

            <label for="color">Color:</label>
            <input type="text" name="color" id="color" class="mb-2 text-black px-2" value="<?= $card[0]["color"] ?>">
            <br>

            <label for="type">Type:</label>
            <input type="text" name="type" id="type" class="mb-2 text-black px-2" value="<?= $card[0]["type"] ?>">


            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="mb-2 text-black px-2" value="<?= $card[0]["price"] ?>">
            <br>

            <label for="foil">Foil:</label>
            <input type="checkbox" name="foil" id="foil" <?php echo $card[0]['foil'] === 1 ? 'checked' : ''; ?>>

            <br>

            <label for="extention">Extension:</label>
            <input type="text" name="extension" id="extension" class="mb-2 text-black px-2" value="<?= $card[0]["extension"] ?>">
            <br>

            <input type="submit" value="Submit" class="border border-white bg-red-500 rounded p-3">
        </form>
    </div>