<?php

// This class is focussed on dealing with queries for one type of data
// That allows for easier re-using and it's rather easy to find all your queries
// This technique is called the repository pattern
class CardRepository
{
    private DatabaseManager $databaseManager;

    // This class needs a database connection to function
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function create($name, $color, $type, $price, $foil, $extension): void
    {
        $query = "INSERT INTO cardsCollection (name, color, type, price, foil, extension) VALUES (:name, :color, :type, :price, :foil, :extension)";
        $stmt = $this->databaseManager->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':foil', $foil);
        $stmt->bindParam(':extension', $extension);
        $stmt->execute();
    }

    // Get one
    public function find()
    {
    }

    // Get all
    public function get(): array
    {
        $query = "SELECT * FROM cardsCollection;";
        // var_dump($this->databaseManager);
        $getResult = $this->databaseManager->connection->query($query);
        $cards = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $cards;
        
    }
    public function getSpecifiedCard($id): array
    {
        $query = "SELECT * FROM `cardsCollection` WHERE `id` = :id";
        $stmt = $this->databaseManager->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $card = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $card;
    }

    public function update($name, $color, $type, $price, $foil, $extension, $id): void
    {
        $query = "UPDATE `cardsCollection` SET `name` = :name, `color` = :color, `type` = :type, `price` = :price, `foil` = :foil, `extension` = :extension WHERE `id` = :id";
        $stmt = $this->databaseManager->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':foil', $foil);
        $stmt->bindParam(':extension', $extension);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function delete($cardID): void
    {
        $query = "DELETE FROM `cardsCollection` WHERE `id` = :id";
        $stmt = $this->databaseManager->connection->prepare($query);
        // Bind the parameter value to the prepared statement
        $stmt->bindParam(':id', $cardID);

        // Execute the prepared statement
        $stmt->execute();

    }
}
