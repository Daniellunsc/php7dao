<?php

class Usuario {

    private $id;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdUsuario(){
        return $this->id;
    }

    public function setIdUsuario($value){
        $this->id = $value;
    }
    public function getdeslogin(){
        return $this->deslogin;
    }

    public function setdeslogin($value){
        $this->deslogin = $value;
    }
    public function getdessenha(){
        return $this->dessenha;
    }

    public function setdessenha($value){
        $this->dessenha = $value;
    }
    public function getdtcadastro(){
        return $this->dtcadastro;
    }

    public function setdtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){

        $sql = new MSSQL();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE id = :ID", array(":ID"=>$id));

        if(isset($results[0])){

            $this->setData($results[0]);  
        }

        //var_dump($result);

    }

    public static function getList(){

        $sql = new MSSQL();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

    }

    public static function search($login){
        
        $sql = new MSSQL();

        
        
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$login."%")); 

    }

    public function login($login, $password){

        $sql = new MSSQL();
            
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(':LOGIN'=>$login, ':SENHA'=>$password));
        if (isset($results[0])) {

            $this->setData($results[0]);  

		} else {
			throw new Exception("Login e/ou senha inválidos.");
		}

    }

    public function setData($data){

        $this->setIdUsuario($data['id']);
        $this->setdeslogin($data['deslogin']);
        $this->setdessenha($data['dessenha']);
        $this->setdtcadastro($data['dtcadastro']);

    }

    public function insert(){
      
		$sql = new MSSQL();
		$results = $sql->select("EXEC sp_usuarios_insert :LOGIN, :PASSWORD;", array(
            ':LOGIN'=>$this->getdeslogin(),
            ':PASSWORD'=>$this->getdessenha()
          ));
		if (count($results) > 0) {
			$this->setData($results[0]);
		}
    }

    public function update($login, $password){

        $this->setdeslogin($login);
        $this->setdessenha($password);

        $sql = new MSSQL();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE id = :ID", 
        array(
            ':LOGIN'=>$this->getdeslogin(),
            ':PASSWORD'=>$this->getdessenha(),
            ':ID'=>$this->getIdUsuario()
        ));


    }

    public function delete(){

        $sql = new MSSQL();

        $sql->query("DELETE FROM tb_usuarios WHERE id = :ID", array(':ID'=>$this->getIdUsuario()));

        $this->setIdUsuario(0);
        $this->setdeslogin("");
        $this->setdessenha("");
        $this->setdtcadastro(new DateTime());

        

    }

    public function __construct($login = "", $senha=""){
        $this->setdeslogin($login);
        $this->setdessenha($senha);

    }

    public function __toString(){

        return json_encode(array(
            "id"=>$this->getIdUsuario(),
            "deslogin"=>$this->getdeslogin(),
            "dessenha"=>$this->getdessenha(),
            "dtcadastro"=>$this->getdtcadastro()
        ));
    }

}

?>