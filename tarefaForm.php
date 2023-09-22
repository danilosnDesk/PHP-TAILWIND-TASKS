<!doctype html>
<html>
<?php

require_once('Model/Tarefa.php');
session_start();
$Tarefa = new Tarefa();       

if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
}

if (isset($_POST['cadastrar'])){

    $data = [
    "titulo" => $_POST['titulo'],
    "descricao" => $_POST['descricao'],
    "datetime" => $_POST['datetime'],
    "status" => $_POST['status'],
    ];

           
       $cadastrar = $Tarefa->create($data);
       if ($cadastrar) {
        header('Location:  index.php'); 
        }else {
        $erros = "Nãom foi possível entrar.!!";
        }

}

if (isset($_POST['atualizar'])){

   $data = [
    "ident" =>  $_POST['id'],
    "titulo" => $_POST['titulo'],
    "descricao" => $_POST['descricao'],
    "datetime" => $_POST['datetime'],
    "status" => $_POST['status'],
    ];

     $cadastrar = $Tarefa->edit($data);
       if ($cadastrar) {
        header('Location:  index.php'); 
        }else {
        $erros = "Nãom foi possível entrar.!!";
        }
}

if (isset($_GET['id'])) {
    $TarefaSingle = $Tarefa->show($_GET['id']);
    if ($TarefaSingle) {
        $TarefaSingle = mysqli_fetch_assoc($TarefaSingle);
    }else {header('Location: index.php');}
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Tarefa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body class="bg-blue-500">
    <div class="container mx-auto flex items-center justify-center flex-col">
        <h1 class="text-xl sm:text-3xl py-4 font-semibold text-white">
            Sistema Gestão de tarefas
        </h1>

        <div class="py-10 w-full flex justify-center items-center">
            <div class="w-full sm:w-1/2 px-2 ">
                <div class="flex justify-between items-center w-full">
                    <?php 
                    if (isset($_GET['id'])) {
                        ?>
                    <h4 class="text-1xl py-4 font-semibold text-white align-left">
                        Atulizar tarefa
                    </h4>
                    <?php
                }else{
                    ?>
                    <h4 class="text-1xl py-4 font-semibold text-white align-left">
                        Nova tarefa
                    </h4>
                    <?php
                }
                ?>
                    
                    <a href="index.php" class="bg-white px-10 py-2 shadow-lg text-blue-500">Voltar</a>
                </div>
                <div class="flex  flex col gap-2 py-4">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>"  class="w-full" method="POST">
                        <div class="flex justify-between py-2">
                            <input required type="text" placeholder="Titulo" name="titulo" class="p-2 outline-none w-full" <?php if (isset($_GET['id'])) {?> value="<?php echo $TarefaSingle['titulo']?>" <?php }?>>
                        </div>
                        
                        <div class="flex justify-between py-2">
                            <input required type="hidden" name="id"  <?php if (isset($_GET['id'])) {?> value="<?php echo $TarefaSingle['id']?>" <?php }?>>
                        </div>

                        <div class="flex justify-between py-2">
                            <input required type="text" placeholder="Descricão" name="descricao" class="p-2 outline-none w-full" <?php if (isset($_GET['id'])) {?> value="<?php echo $TarefaSingle['descricao']?>" <?php }?>>
                        </div>
                        <div class="flex justify-between py-2">
                            <input required type="datetime-local" name="datetime" class="p-2 outline-none w-full" <?php if (isset($_GET['id'])) {?> value="<?php echo $TarefaSingle['dataTime']?>" <?php }?>>
                        </div>
                        <select name="status" class="p-2 outline-none w-full" required>
                            <?php
                            if (isset($_GET['id'])) {
                            switch ($TarefaSingle['status']) {
                                case 'c':
                                   ?>
                                   <option value="c">Concluída</option>
                                   <option value="p">pendente</option>
                                   <?php
                                    break;
                                case 'p':
                                   ?>
                                   <option value="p">pendente</option>
                                   <option value="c">Concluída</option>
                                   <?php
                                    break;
                                    default:
                                    ?>
                                   <option value="p">Selecione o Estado</option>
                                   <option value="p">pendente</option>
                                   <option value="c">Concluída</option>
                                   <?php
                                    break;
                            }
                            }else{
                            ?>
                            <option value="p">Selecione o Estado</option>
                            <option value="p">pendente</option>
                            <option value="c">Concluída</option>
                            <?php
                            }
                            ?>
                           
                        </select>

                        <div class="py-4">
                            <?php 
                    if (isset($_GET['id'])) {
                        ?>
                    <button type="submit" name="atualizar"
                                class="bg-orange-500 px-10 py-2 shadow-lg text-white">atualizar</button>
                       
                    <?php
                }else{
                    ?>
                   <button type="submit" name="cadastrar"
                                class="bg-orange-500 px-10 py-2 shadow-lg text-white">Cadastrar</button>
                       
                    <?php
                }
                ?>
                             </div>
                    </form>
                </div>
            </div>

        </div>

</body>

</html>