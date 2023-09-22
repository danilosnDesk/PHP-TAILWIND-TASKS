<!doctype html>
<html>

<?php
 require_once('Model/Usuario.php');
 session_start();

if (isset($_SESSION['logado'])) {
    header('Location: index.php');
}

if (isset($_POST['btn_entrar'])){

    if ($_POST['email'] && $_POST['senha'] != null){

       $Usuario = new Usuario();
       
       $entrar = $Usuario->login($_POST['email'],$_POST['senha']);
       
       if (!$entrar) {
       
        $erros = "Não foi possível entrar.!!";
       
    }
    
}

}





?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body class="bg-blue-500 flex justify-center items-center h-screen">

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="w-full sm:w-[400px] bg-white p-4">
        <h2 class="text-2xl py-4 font-semibold text-slate-700 align-left">
            Entrar
        </h2>

        <?php
            if (isset($erros)) {
            ?>
            <span class="text-base py-4 font-semibold text-red-700 align-left">
                <?php echo $erros?>
            </span>
            <?php
            }
        ?>
        
        <div class="flex justify-between py-2">
            <input type="email" required placeholder="Email" name="email" id=""
                class="p-2 outline-none w-full border border-1 border-slate-400">
        </div>
        <div class="flex justify-between py-2">
            <input type="password" required placeholder="Senha" name="senha" id=""
                class="p-2 outline-none w-full border border-1 border-slate-400">
        </div>


        <div class="py-4">
            <button type="submit" name="btn_entrar"
                class="bg-orange-500 px-10 py-2 shadow-lg text-white">Entrar</button>
        </div>
        <a href="signup.php" class="text-1xl py-4 font-semibold text-slate-500 align-left">
            Criar uma conta
        </a>

    </form>

</body>

</html>