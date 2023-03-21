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

    <h1 class="text-2xl underline mb-4 ">Goodcard - track your collection of MTG cards</h1>

    <div class="border bg-slate-500 p-3 rounded mx-2 mb-7">
        <h1 class="text-xl mb-5">Create a card</h1>
        <form method="get" action="index.php">
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


    <?php foreach ($cards as $card) : ?>
        <div class="border border-white rounded-2xl bg-slate-800 mb-5 p-7 mx-5">
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
            <a href="index.php?action=delete&Id=<?= $card["id"] ?>">
                <button class="bg-red-500 border hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full mt-2">
                    Delete <?= $card['name'] ?>
                </button>
            </a>
            <a href="edit.php?Id=<?= $card["id"] ?>">
                <button class="bg-green-500 border hover:bg-green-700 text-white font-bold py-1 px-2 rounded-full mt-2">
                    Edit <?= $card['name'] ?>
                </button>
            </a>
        </div>
    <?php endforeach; ?>


</body>

</html>