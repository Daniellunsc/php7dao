<?php 

class MSSQL extends PDO {

    private $conn;

    public function __construct(){
        $this->conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0", "sa", "root");
    }

    private function setParams($statment, $parameters = array()){

        foreach($parameters as $key => $value){
            
           
            $this->setParam($statment, $key, $value);
        }

        
        
    }

    private function setParam($statment, $key, $value){

        $statment->bindParam($key, $value);

    }

    public function query($RawQuery, $params = array()){

        $stmt = $this->conn->prepare($RawQuery);


        $this->setParams($stmt, $params);

        $stmt->execute();

        //var_dump($stmt);

        return $stmt;
    }

    public function select($RawQuery, $params = array()){

        $stmt = $this->query($RawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}


?>