<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goodcard - track your collection of Pokémon cards</title>
</head>

<body>

    <h1>Goodcard - track your collection of MTG cards</h1>


    <?php foreach ($cards as $card) : ?>
        <div class="card">
            <h2 class="card_name">
                <?= $card["name"]; ?>
            </h2>
            <ul>
                <li>Color: <?= $card["color"]; ?></li>
                <li>Extention: <?= $card["extention"]; ?></li>
                <li>Type: <?= $card["type"]; ?></li>
                <li>Price: <?= $card["price"]; ?>€</li>
                <li>Foil ?: <?php if ($card["foil"]===1){
                    echo "yes";
                }
                else{
                    echo"no";
                } ?></li>

            </ul>
        </div>
        <!-- <li><?php
                    echo "<pre>";
                    var_dump($card);
                    echo "</pre";
                    ?></li> -->
    <?php endforeach; ?>


</body>

</html>