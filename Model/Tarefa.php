<?php

class Tarefa {

    private $conexao; 

    public function __construct()
    {
        $this->conexao = require_once('DB/Conexao.php');
    }

    public function all() {
        $sql = "SELECT * FROM `tarefas` LIMIT 100;";
        $res = mysqli_query($this->conexao, $sql);

        if ($res) {return $res;}
        else{return false;}
    }

    public function create($data) {
        
        $titulo = mysqli_real_escape_string($this->conexao, $data['titulo']);
        $descricao = mysqli_real_escape_string($this->conexao, $data['descricao']);
        $dataTime = mysqli_real_escape_string($this->conexao, $data['datetime']);
        $status = mysqli_real_escape_string($this->conexao, $data['status']);

        $sql = "
        INSERT INTO `tarefas` 
        (`titulo`, `descricao`, `dataTime`, `status`) 
        VALUES
        ('$titulo', '$descricao', '$dataTime', '$status');"
        ;

        $res = mysqli_query($this->conexao, $sql);
    
        if ($res) {return true;}
        else{return false;}
    }
    public function edit($data) {
        
        $id = mysqli_real_escape_string($this->conexao, $data['ident']);
        $titulo = mysqli_real_escape_string($this->conexao, $data['titulo']);
        $descricao = mysqli_real_escape_string($this->conexao, $data['descricao']);
        $dataTime = mysqli_real_escape_string($this->conexao, $data['datetime']);
        $status = mysqli_real_escape_string($this->conexao, $data['status']);

        $sql = "
        UPDATE `tarefas` 
        SET 
        `titulo`='$titulo', 
        `descricao`='$descricao', 
        `dataTime`='$dataTime', 
        `status`='$status'
        WHERE  `id`=$id;
        ";
        $res = mysqli_query($this->conexao, $sql);
    
        if ($res) {return true;}
        else{return false;}
    }

    public function destroy($id) {
        $sql = "DELETE FROM `tarefas` WHERE `id` = $id";
        $res = mysqli_query($this->conexao, $sql);

        if ($res) {return true;}
        else{return false;}
    }

     public function show($id) {
        $sql = "SELECT * FROM `tarefas` WHERE `id` = $id";
        $res = mysqli_query($this->conexao, $sql);

        if ($res) {return $res;}
        else{return false;}
    }
}

?>