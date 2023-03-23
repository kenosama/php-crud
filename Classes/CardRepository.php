
<?php

// This class is focussed on dealing with queries for one type of data
// That allows for easier re-using and it's rather easy to find all your queries
// This technique is called the repository pattern
class CardRepository    // Declare class CardRepository
{
    private DatabaseManager $databaseManager;    // Declare private variable $databaseManager

    // This class needs a database connection to function
    public function __construct(DatabaseManager $databaseManager)    // Create a constructor for class CardRepository
    {
        $this->databaseManager = $databaseManager;    // Assign $databaseManager to databaseManager
    }

    public function create(): void    // Declare function create
    {
        $cardName = isset($_GET["name"]) ? $_GET["name"] : null;    // Assign name of the card to $cardName
        $cardColor = isset($_GET["color"]) ? $_GET["color"] : null;    // Assign color of the card to $cardColor
        $cardType = isset($_GET["type"]) ? $_GET["type"] : null;    // Assign type of the card to $cardType
        $cardPrice = isset($_GET["price"]) ? $_GET["price"] : null;    // Assign price of the card to $cardPrice
        $cardFoil = isset($_GET["foil"]) ? ($_GET["foil"] === "on" ? 1 : 0) : null;    // Assign foil of the card to $cardFoil
        $cardExtension = isset($_GET["extension"]) ? $_GET["extension"] : null;
        $query = "INSERT INTO cardsCollection (name, color, type, price, foil, extension) VALUES (:name, :color, :type, :price, :foil, :extension)";    // Assign query to $query
        $stmt = $this->databaseManager->connection->prepare($query);
        $stmt->bindParam(':name', $cardName);
        $stmt->bindParam(':color', $cardColor);
        $stmt->bindParam(':type', $cardType);
        $stmt->bindParam(':price', $cardPrice);
        $stmt->bindParam(':foil', $cardFoil);
        $stmt->bindParam(':extension', $cardExtension);
        $stmt->execute();
    }

    public function get(): array    // Declare function get
    {
        $query = "SELECT * FROM cardsCollection WHERE deleted_at IS NULL;";    // Assign query to $query
        // var_dump($this->databaseManager);
        $getResult = $this->databaseManager->connection->query($query);    // query and store result in $getResult
        $cards = $getResult->fetchAll(PDO::FETCH_ASSOC);    // fetch all results in associative array

        return $cards;    // return cards
        
    }
    

    public function getTypes(): array    // Declare function getSpecifiedCard
    {
        $query = "SELECT  type FROM cardsCollection WHERE deleted_at IS NULL GROUP BY type";   // Assign query to $query
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare statement
        $stmt->execute();    // Execute the statement
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Fetch all results in associative array
        return $result;    // return result
    }

    public function getSpecifiedType($type): array    // Declare function getSpecifiedCard
    {
        $query = "SELECT * FROM `cardsCollection` WHERE `type` = :type AND deleted_at IS NULL";    // Assign query to $query
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare statement
        $stmt->bindParam(':type', $type);    // Bind parameter :id to $id
        $stmt->execute();    // Execute the statement
        $cardsWithType = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Fetch all results in associative array
        return $cardsWithType;    // return card
    }

    public function getSpecifiedCard($id): array    // Declare function getSpecifiedCard
    {
        $query = "SELECT * FROM `cardsCollection` WHERE `id` = :id";    // Assign query to $query
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare statement
        $stmt->bindParam(':id', $id);    // Bind parameter :id to $id
        $stmt->execute();    // Execute the statement
        $card = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Fetch all results in associative array
        return $card;    // return card
    }

    public function update(): void
    {
        $id=$_GET["id"];
        $cardName = isset($_GET["name"]) ? $_GET["name"] : null;    // Assign name of the card to $cardName
        $cardColor = isset($_GET["color"]) ? $_GET["color"] : null;    // Assign color of the card to $cardColor
        $cardType = isset($_GET["type"]) ? $_GET["type"] : null;    // Assign type of the card to $cardType
        $cardPrice = isset($_GET["price"]) ? $_GET["price"] : null;    // Assign price of the card to $cardPrice
        $cardFoil = isset($_GET["foil"]) ? ($_GET["foil"] === "on" ? 1 : 0) : null;    // Assign foil of the card to $cardFoil
        $cardExtension = isset($_GET["extension"]) ? $_GET["extension"] : null;
        $query = "UPDATE `cardsCollection` SET `name` = :name, `color` = :color, `type` = :type, `price` = :price, `foil` = :foil, `extension` = :extension, `updated_at` = :updated_at WHERE `id` = :id";
        $stmt = $this->databaseManager->connection->prepare($query);
        $stmt->bindParam(':name', $cardName);
        $stmt->bindParam(':color', $cardColor);
        $stmt->bindParam(':type', $cardType);
        $stmt->bindParam(':price', $cardPrice);
        $stmt->bindParam(':foil', $cardFoil);
        $stmt->bindParam(':extension', $cardExtension);
        $stmt->bindValue(':updated_at', date('Y-m-d H:i:s'));
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


    public function delete($cardID): void
    {
        $query = "UPDATE `cardsCollection` SET `deleted_at` = :deleted_at WHERE `id` = :id";
        $stmt = $this->databaseManager->connection->prepare($query);
        $stmt->bindValue(':deleted_at', date('Y-m-d H:i:s'));
        $stmt->bindParam(':id', $cardID);
        $stmt->execute();
    }
}

