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

            <label for="extention">Extension:</label>
            <input type="text" name="extention" id="extention" class="mb-2 text-black px-2">
            <br>

            <input type="submit" value="Submit" class="border border-white bg-red-500 rounded p-3">
        </form>
    </div>
    <div class="border bg-slate-500 p-3 rounded mx-2 mb-7">
        <h1 class="text-xl mb-5">Delete a card</h1>
        <form action="index.php" method="get">
            <input type="hidden" name="action" value="create">
            <label for="card">Select a card:</label>
            <button type="submit">Submit</button>
        </form>
    </div>


    <?php foreach ($cards as $card) : ?>
        <div class="border border-white rounded-2xl bg-slate-800 mb-5 p-7 mx-5">
            <h2 class="text-xl underline underline-offset-4 mb-2">
                <?= $card["name"]; ?>
            </h2>
            <ul>
                <li>Color: <?= $card["color"]; ?></li>
                <li>Extention: <?= $card["extention"]; ?></li>
                <li>Type: <?= $card["type"]; ?></li>
                <li>Price: <?= $card["price"]; ?>€</li>
                <li>Foil ?: <?php if ($card["foil"] === 1) {
                                echo "yes";
                            } else {
                                echo "no";
                            } ?></li>

            </ul>
            <form method="get" action="index.php">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="Id" value="<?=$card["id"] ?>">
                <input type="submit" value="Delete this card" class="border border-white bg-red-500 rounded p-3 mt-4">
            </form>
        </div>
    <?php endforeach; ?>


</body>

</html>