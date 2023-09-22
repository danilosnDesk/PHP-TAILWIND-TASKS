<!doctype html>
<html>
<?php

require_once('Model/Usuario.php');
require_once('Model/Tarefa.php');
session_start();

$Tarefa = new Tarefa();       
$Tarefas = $Tarefa->all();


if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
}

if (isset($_POST['logout'])){
     $Usuario = new Usuario();
     $Usuario->logout();
}

if (isset($_POST['delete'])){
if (isset($_POST['tarefaID'])){
    $delete = $Tarefa->destroy($_POST['tarefaID']);
    if ($delete) {
        $success = true;
        header('Location: index.php');
    }
}
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
    <script src="https://cdn.tailwindcss.com" />
    </script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body class="bg-blue-500 relative h-screen">


    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="absolute top-12 right-5 sm:right-10">
        <button name="logout">
            <span class="material-symbols-outlined text-white bg-red-500 rounded-full p-2 text-[20px]">
                logout
            </span>
        </button>
    </form>
    <div class="container mx-auto flex items-center justify-center flex-col">
        <h1 class="text-xl sm:text-3xl py-4 font-semibold text-white">
             Minhas de tarefas
        </h1>
        
        <?php
            if (isset($success)) {
            ?>
            <span class="material-symbols-outlined text-[20px] rounded  p-4 font-semibold bg-white p-4 text-green-500">
        task_alt
        </span>
            <?php
            }
        ?>
       
        

        <div class="py-10 w-full flex justify-center items-center">
            <div class="w-full sm:w-1/2 px-2 ">

                <div class="flex flex-col  items-start w-full">
                    <h4 class="text-1xl py-1 font-semibold text-white align-left">
                        Gerindo: <?php echo $_SESSION["user"]["nome"]?>
                    </h4>
                    <span class="text[15px]  text-white align-left flex items-center">
                        <span class="material-symbols-outlined">
                        alternate_email
                        </span> <?php echo $_SESSION["user"]["email"]?>
                    </span>
                </div>
                
                <div class="flex justify-between items-center w-full">
                    <h4 class="text-1xl py-4 font-semibold text-white align-left">
                        Minhas terefas
                    </h4>
                    <a href="tarefaForm.php" class="bg-white px-10 py-2 shadow-lg text-blue-500">Nova</a>
                </div>

                <div class="flex flex-col gap-2">
                    <?php
                    
                    if ($Tarefas) {

                        if (mysqli_num_rows($Tarefas) < 1) {
                            ?>
                        <div class="flex py-8 justify-center text-white">
                            <span class="text-slate-700">Sem tarefas</span>
                        </div>
                            <?php
                        }else{

                       
                      
                        while ($CadaTarefa = mysqli_fetch_assoc($Tarefas)) {
                        ?>
                    <!-- tarefa 1 -->

                    <div class="w-full bg-white flex p-2 justify-between items-center rounded">
                        <div>
                            <h5 class="text-slate-900 text-[16px] sm:text-lg font-semibold "><?php echo $CadaTarefa['titulo']; ?></h5>
                            <span class="text-slate-500 text-[14px] sm:text-[16px] font-semibold "><?php echo $CadaTarefa['descricao']; ?></span>
                        
                            <div>
                                <?php
                                if ($CadaTarefa['status'] === 'c') {
                                    ?>
                                    <span class="text-slate-100 p-1 rounded-xl text-[12px] sm:text-[12px] bg-green-500 font-semibold ">realizada</span>
                                    <?php
                                }else {
                                    ?>
                                    <span class="text-slate-100 p-1 rounded-xl text-[12px] sm:text-[12px] bg-slate-400 font-semibold ">Não realizada</span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex gap-1">
                           <form action="<?php echo $_SERVER['PHP_SELF']?>"  method="POST">
                                <input type="hidden" name="tarefaID" value="<?php echo $CadaTarefa['id']; ?>">
                                <button type="submit" name="delete">
                                    <span
                                    class="material-symbols-outlined text-white bg-red-500 rounded-full p-2 text-[15px]">
                                                                        delete

                                </span>
                            </button>
                        </form>
                         <a href="tarefaForm.php?id=<?php echo $CadaTarefa['id'];?>">
                                <span
                                    class="material-symbols-outlined text-white bg-orange-500 rounded-full p-2 text-[15px]">
                                    edit_square
                                </span>
                            </a>
                        </div>
                    </div>
                    <!-- !tarefa 1 -->
                    <?php
                    }
 }
                    }

                    ?>


                </div>
            </div>

        </div>

</body>

</html>