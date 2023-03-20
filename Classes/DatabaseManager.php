<?php

// This class will manage the connection to the database
// It will be passed on the other classes who need it
class DatabaseManager
{
    // These are private: only this class needs them
    private string $host;
    private string $user;
    private string $password;
    private string $dbname;
    // This one is public, so we can use it outside of this class
    // We could also use a private variable and a getter (but let's not make things too complicated at this point)
    public PDO $connection;

    public function __construct(string $host, string $user, string $password, string $dbname)
    {
        // TODO: Set any user and password information
        $this->user=$user;
        $this->host = $host;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect(): PDO
    {
        // TODO: make the connection to the database
        try {
            $this->connection=new PDO ("mysql:host={$this->host};dbname={$this->dbname}",$this->user, $this->password);
            return $this->connection;
        } catch (PDOException $e) {
            
            die($e->getMessage());
        }
        
    }
}
