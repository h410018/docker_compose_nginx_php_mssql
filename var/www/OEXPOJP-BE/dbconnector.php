<?php 
    class DBConnect {
        
        private $host ;
        private $database ;
        private $username ;
        private $password ;
        public $conn = null;

        private $dbConfigArray = array(
            "vbip_japan" => array (
                "host" => "localhost,1433",
            ),
            "Soliton" => array(
                "host" => "localhost,1433",
            ),
        );
        
        public function __construct($expo_organizer){
            
            $this->host = "mssql, 1433"; // mssql => service container name created by docker-compose
            
            /**  Warning If PHP is running in a SAPI such as Fast CGI, 
                this function will always return the value of an environment variable set by the SAPI,
                even if putenv() has been used to set a local environment variable of the same name. 
                Use the local_only parameter to return the value of locally-set environment variables.
            */
            $this->database = getenv("DB");
            $this->username = getenv("SQL_SA");
            $this->password = getenv("SQL_SA_PW");
        
            try{
                $this->conn = new PDO("sqlsrv:server = {$this->host}; Database = {$this->database}; TrustServerCertificate = true", "{$this->username}", "{$this->password}");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // return $this->conn;
            }
            catch (PDOException $e) {
                print("Error connecting to SQL Server.");
                echo $e->getMessage();
            }
        }
    }
    
    try{
        $conn = new DBConnect("vbip_japan");
        var_dump($conn);
    }catch (Exception $e){
        echo $e->getMessage();
    }
   
?>