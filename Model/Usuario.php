<?php


class Usuario 
{
    private $conexao; 

    public function __construct()
    {
        $this->conexao = require_once('DB/Conexao.php');
    }

    public function login($email, $senha)
{
    $senha = mysqli_real_escape_string($this->conexao, $senha);
    $email = mysqli_real_escape_string($this->conexao, $email);
    $senha = sha1($senha);

    $sql = "SELECT nome, email FROM `usuarios` WHERE email = '$email' AND senha = '$senha'";
    $res = mysqli_query($this->conexao, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
        $_SESSION['logado'] = true;
        $_SESSION['user'] = $user;
        return true;
    } else {
        return false;
    }
}

    
    public function signup($data)
    {
         $nome = mysqli_real_escape_string($this->conexao, $data['nome']);
         $email = mysqli_real_escape_string($this->conexao, $data['email']);
         $senha = mysqli_real_escape_string($this->conexao, $data['senha']);
         $senha = sha1($senha);

         $sql = "SELECT * FROM `usuarios` WHERE email = '$email'";
         $res = mysqli_query($this->conexao, $sql);
         if (mysqli_num_rows($res) > 0) {
           return 422;
         }else {
         $sql = "INSERT INTO `usuarios`  (`nome`, `senha`, `email`) VALUES ('$nome', '$senha', '$email');";
         $res = mysqli_query($this->conexao, $sql);

          if ($res) {
            $_SESSION['logado'] = true;
            $_SESSION['user'] = [
                "nome" => $nome,
                "email" => $email
            ];
            header('Location: index.php');
            return true;
        }
        else{return false;}
         }
    

       
    }

    public function re_password($activePass, $newPass)
    {
        // Implemente a lógica de redefinição de senha aqui usando $this->conexao.
    }

    public function logout()
    {
     session_start();
     session_unset();
     session_destroy();
     header('Location:  index.php');
    }
}

?>
