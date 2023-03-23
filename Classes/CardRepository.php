<?php
class CardRepository    // Create class CardRepository
{
    private DatabaseManager $databaseManager;    // Create private DatabaseManager object

    public function __construct(DatabaseManager $databaseManager)    // Constructor function
    {
        $this->databaseManager = $databaseManager;    // Assign DatabaseManager object to $databaseManager
    }

    public function create(): void    // Declare function create
    {
        $cardName = isset($_GET["name"]) ? $_GET["name"] : null;    // Check if name is set or not
        $cardColor = isset($_GET["color"]) ? $_GET["color"] : null;    // Check if color is set or not
        $cardType = isset($_GET["type"]) ? $_GET["type"] : null;    // Check if type is set or not
        $cardPrice = isset($_GET["price"]) ? $_GET["price"] : null;    // Check if price is set or not
        $cardFoil = isset($_GET["foil"]) ? ($_GET["foil"] === "on" ? 1 : 0) : null;    // Check if foil is set or not
        $cardExtension = isset($_GET["extension"]) ? $_GET["extension"] : null;    // Check if extension is set or not
        $query = "INSERT INTO cardsCollection (name, color, type, price, foil, extension) VALUES (:name, :color, :type, :price, :foil, :extension)";    // Insert values in cardsCollection table
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare query
        $stmt->bindParam(':name', $cardName);    // Bind "name" to "cardName"
        $stmt->bindParam(':color', $cardColor);    // Bind "color" to "cardColor"
        $stmt->bindParam(':type', $cardType);    // Bind "type" to "cardType"
        $stmt->bindParam(':price', $cardPrice);    // Bind "price" to "cardPrice"
        $stmt->bindParam(':foil', $cardFoil);    // Bind "foil" to "cardFoil"
        $stmt->bindParam(':extension', $cardExtension);    // Bind "extension" to "cardExtension"
        $stmt->execute();    // Execute the query
    }

    public function get(): array    // Declare function get and return array
    {
        $query = "SELECT * FROM cardsCollection WHERE deleted_at IS NULL;";    // Select all the values from cardsCollection table
        $getResult = $this->databaseManager->connection->query($query);    // Execute the query
        $cards = $getResult->fetchAll(PDO::FETCH_ASSOC);    // Assign the result to "cards" variable
        return $cards;    // Return the result
    }
    

    public function getTypes(): array    // Declare function getTypes and return array
    {
        $query = "SELECT  type FROM cardsCollection WHERE deleted_at IS NULL GROUP BY type";    // Select type from cardsCollection table
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare the query
        $stmt->execute();    // Execute the query
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Assign the result to "result" variable
        return $result;    // Return the result
    }

    public function getSpecifiedType($type): array    // Declare function getSpecifiedType and return array
    {
        $query = "SELECT * FROM `cardsCollection` WHERE `type` = :type AND deleted_at IS NULL";    // Select all the values from cardsCollection where type is equal to :type
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare the query
        $stmt->bindParam(':type', $type);    // Bind "type" to "type"
        $stmt->execute();    // Execute the query
        $cardsWithType = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Assign the result to "cardsWithType" variable
        return $cardsWithType;    // Return the result
    }

    public function getSpecifiedCard($id): array    // Declare function getSpecifiedCard and return array
    {
        $query = "SELECT * FROM `cardsCollection` WHERE `id` = :id";    // Select all the values from cardsCollection where id is equal to :id
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare the query
        $stmt->bindParam(':id', $id);    // Bind "id" to "id"
        $stmt->execute();    // Execute the query
        $card = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Assign the result to "card" variable
        return $card;    // Return the result
    }

    public function update(): void    // Declare function update
    {
        $id=$_GET["id"];    // Get the value of id
        $cardName = isset($_GET["name"]) ? $_GET["name"] : null;    // Check if name is set or not
        $cardColor = isset($_GET["color"]) ? $_GET["color"] : null;    // Check if color is set or not
        $cardType = isset($_GET["type"]) ? $_GET["type"] : null;    // Check if type is set or not
        $cardPrice = isset($_GET["price"]) ? $_GET["price"] : null;    // Check if price is set or not
        $cardFoil = isset($_GET["foil"]) ? ($_GET["foil"] === "on" ? 1 : 0) : null;    // Check if foil is set or not
        $cardExtension = isset($_GET["extension"]) ? $_GET["extension"] : null;    // Check if extension is set or not
        $query = "UPDATE `cardsCollection` SET `name` = :name, `color` = :color, `type` = :type, `price` = :price, `foil` = :foil, `extension` = :extension, `updated_at` = :updated_at WHERE `id` = :id";    // Update values in cardsCollection table
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare the query
        $stmt->bindParam(':name', $cardName);    // Bind "name" to "cardName"
        $stmt->bindParam(':color', $cardColor);    // Bind "color" to "cardColor"
        $stmt->bindParam(':type', $cardType);    // Bind "type" to "cardType"
        $stmt->bindParam(':price', $cardPrice);    // Bind "price" to "cardPrice"
        $stmt->bindParam(':foil', $cardFoil);    // Bind "foil" to "cardFoil"
        $stmt->bindParam(':extension', $cardExtension);    // Bind "extension" to "cardExtension"
        $stmt->bindValue(':updated_at', date('Y-m-d H:i:s'));    // Bind the current date to "updated_at"
        $stmt->bindParam(':id', $id);    // Bind "id" to "id"
        $stmt->execute();    // Execute the query
    }


    public function delete($cardID): void    // Declare function delete
    {
        $query = "UPDATE `cardsCollection` SET `deleted_at` = :deleted_at WHERE `id` = :id";    // Update "deleted_at" to current date where id is equal to :id
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare the query
        $stmt->bindValue(':deleted_at', date('Y-m-d H:i:s'));    // Bind the current date to "deleted_at"
        $stmt->bindParam(':id', $cardID);    // Bind "cardID" to "id"
        $stmt->execute();    // Execute the query
    }
}

