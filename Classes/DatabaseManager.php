<?php
class DatabaseManager    // Define database manager class
{    // class body
    private string $host;    // define host variable
    private string $user;    // define user variable
    private string $password;    // define password variable
    private string $dbname;    // define database name variable
      public PDO $connection;    // define PDO Database connection
    public function __construct(string $host, string $user, string $password, string $dbname)    // Define constructor
    {
        $this->user=$user;    // Assign value of user to $this->user
        $this->host = $host;    // Assign value of host to $this->host
        $this->password = $password;    // Assign value of password to $this->password
        $this->dbname = $dbname;    // Assign value of database name to $this->dbname
    }

    public function connect(): PDO    // Define connect function
    {
        try {    // Start try block
            $this->connection=new PDO ("mysql:host={$this->host};dbname={$this->dbname}",$this->user, $this->password);    // Create database connection
            return $this->connection;    // Return database connection
        } catch (PDOException $e) {    // handle PDO exception
            die($e->getMessage());    // Print exception message
        }
        
    }
}
