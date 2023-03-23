<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goodcard - track your collection of Pokémon cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" dark:bg-neutral-800 bg-slate-200 dark:text-white text-black">

    <h1 class="text-2xl underline mb-4 ">Goodcard - track your collection of MTG cards</h1>

    <div class="border bg-slate-500 p-3 rounded mx-2 mb-7">
        <h1 class="text-xl mb-5">Create a card</h1>
        <form method="get" action="">
            <input type="hidden" name="action" value="create">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="mb-2 text-black px-2">

            <label for="color">Color:</label>
            <input type="text" name="color" id="color" class="mb-2 text-black px-2">
            <br>

            <label for="type">Type:</label>
            <input type="text" name="type" id="type" class="mb-2 text-black px-2">


            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="mb-2 text-black px-2">
            <br>

            <label for="foil">Foil:</label>
            <input type="checkbox" name="foil" id="foil">
            <br>

            <label for="extension">Extension:</label>
            <input type="text" name="extension" id="extension" class="mb-2 text-black px-2">
            <br>

            <input type="submit" value="Submit" class="border border-white bg-red-500 rounded p-3">
        </form>
    </div>

    <div class="border bg-slate-500 p-3 rounded mx-2 mb-7">
        <h1 class="text-xl mb-5">Filter by types</h1>
        <?php
        foreach ($types as $type) : ?>
            <a href="index.php?action=filter&type=<?= $type["type"] ?>">
                <button class="bg-<?= $colors[$colorIndex] ?>-500 border hover:bg-<?= $colors[$colorIndex] ?>-700 text-white font-bold py-1 px-2 rounded-full mt-2">
                    <?= $type['type'] ?>
                </button>
            </a>
            <?php
            $colorIndex++;
            if ($colorIndex >= count($colors)) {
                $colorIndex = 0;
            }
            ?>
        <?php endforeach; ?>
        <a href="./">
            <button class="bg-red-500 border hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full mt-2">
                Back to basic page
            </button>
        </a>
    </div>

<?php if (isset($_GET['action']) && $_GET['action'] === 'filter') {
    $filter=$_GET['type'];
    echo "
        <div class='border bg-red-500 text-white font-bold p-3 rounded mx-2 mb-7'>
            Active Filter: {$filter}
        </div>";
} ?>

    <?php foreach ($cards as $card) : ?>
        <article class="border border-white rounded-2xl bg-slate-800 mb-5 p-7 mx-5">
            <h2 class="text-xl underline underline-offset-4 mb-2">
                <?= $card["name"]; ?>
            </h2>
            <ul>
                <li>Color: <?= $card["color"]; ?></li>
                <li>Extention: <?= $card["extension"]; ?></li>
                <li>Type: <?= $card["type"]; ?></li>
                <li>Price: <?= $card["price"]; ?>€</li>
                <li>Foil ?: <?php if ($card["foil"] === 1) {
                                echo "yes";
                            } else {
                                echo "no";
                            } ?></li>

            </ul>
            <a href="?action=delete&Id=<?= $card["id"] ?>">
                <button class="bg-red-500 border hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full mt-2">
                    Delete <?= $card['name'] ?>
                </button>
            </a>
            <a href="?action=update&Id=<?= $card["id"] ?>">
                <button class="bg-green-500 border hover:bg-green-700 text-white font-bold py-1 px-2 rounded-full mt-2">
                    Edit <?= $card['name'] ?>
                </button>
            </a>
        </article>
    <?php endforeach; ?>


</body>

</html>