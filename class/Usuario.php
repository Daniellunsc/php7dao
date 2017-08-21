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

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE id = :ID", array(":ID"=>$id));

       

        if(isset($result[0])){

            $row = $result[0];

            $this->setIdUsuario($row['id']);
            $this->setdeslogin($row['deslogin']);
            $this->setdessenha($row['dessenha']);
            $this->setdtcadastro($row['dtcadastro']);

        }

        //var_dump($result);

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