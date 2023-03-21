
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

    public function create($name, $color, $type, $price, $foil, $extension): void    // Declare function create
    {
        $query = "INSERT INTO cardsCollection (name, color, type, price, foil, extension) VALUES (:name, :color, :type, :price, :foil, :extension)";    // Assign query to $query
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
    public function find()    // Declare function find
    {
    }

    // Get all
    public function get(): array    // Declare function get
    {
        $query = "SELECT * FROM cardsCollection;";    // Assign query to $query
        // var_dump($this->databaseManager);
        $getResult = $this->databaseManager->connection->query($query);    // query and store result in $getResult
        $cards = $getResult->fetchAll(PDO::FETCH_ASSOC);    // fetch all results in associative array

        return $cards;    // return cards
        
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

    public function getTypes(): array    // Declare function getSpecifiedCard
    {
        $query = "SELECT DISTINCT `type` FROM `cardsCollection`;";    // Assign query to $query
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare statement
        $stmt->execute();    // Execute the statement
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);    // Fetch all results in associative array
        return $result;    // return result
    }

    public function update($name, $color, $type, $price, $foil, $extension, $id): void    // Declare function update
    {
        $query = "UPDATE `cardsCollection` SET `name` = :name, `color` = :color, `type` = :type, `price` = :price, `foil` = :foil, `extension` = :extension WHERE `id` = :id";    // Assign query to $query
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':foil', $foil);
        $stmt->bindParam(':extension', $extension);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function delete($cardID): void    // Declare function delete
    {
        $query = "DELETE FROM `cardsCollection` WHERE `id` = :id";    // Assign query to $query
        $stmt = $this->databaseManager->connection->prepare($query);    // Prepare statement
        // Bind the parameter value to the prepared statement
        $stmt->bindParam(':id', $cardID);    // Bind parameter :id to $cardID

        // Execute the prepared statement
        $stmt->execute();    // Execute the statement

    }
}

