<?php

class DatabaseModel
{
    
    private $hostname = "localhost";
    
    private $username = "username";
    
    private $password = "password";
    
    private $database = "myDB";
    
    protected $conn;
    
    /*
     *
     * Construct function
     */
    public function __construct()
    {
        $this->connection();
    }
    
    /*
     * Database Connection
     *
     */
    public function connection()
    {
        
        // Create MySQL Connection
        $conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        $this->conn = $conn;
        if (! $conn) {
            die('Could not connect: ' . mysqli_error());
        }
    }
    
    /*
     * Insert Data in to the table
     * @return int
     */
    function insert($table, $data)
    {
        $keys = array_keys($data);
        $keys = str_replace("'", "`", $keys);
        $values = array_values($data);
        $columnValues = "'" . implode('\',\'', $values) . "'";
             
        $query = "INSERT INTO " . $table . " (" . implode(', ', $keys) . ") VALUES (" . $columnValues . ")";
        
        $this->execution($query);
        return $this->insert_id();
    }
    
    /*
     *
     * Query Execution
     * @return int
     */
    public function execution($sql)
    {
        return mysqli_query($this->conn, $sql);
    }
    
    /*
     *
     * Last Inserted record Id
     * @return int
     */
    function insert_id()
    {
        return mysqli_insert_id($this->conn);
    }
    
    /*
     * Close Connection
     */
    public function __destruct()
    {
        @mysqli_close($this->conn);
    }
}
