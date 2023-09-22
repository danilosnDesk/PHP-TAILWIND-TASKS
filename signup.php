<!doctype html>
<html>
<?php
require_once('Model/Usuario.php');
session_start();

if (isset($_SESSION['logado'])) {
    header('Location: index.php');
}
if (isset($_POST['cadastrar'])){
 
    $data = [
    "nome" => $_POST['nome'],
    "email" => $_POST['email'],
    "senha" => $_POST['senha'],
    "confirm_senha" => $_POST['confirm_senha'],
    ];

    if ($data['senha'] !== $data['confirm_senha']) {
       $erros = "As Palavras passes não coincidiram";
    }else {
       $Usuario = new Usuario();
       $cadastrar = $Usuario->signup($data);
       if (!$cadastrar) {
       $erros = "Não foi possível criar conta- Tente novamente..!";
    }elseif ($cadastrar === 422) {
       $erros = "Email inválido!";
    }
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body class="bg-blue-500 flex justify-center items-center h-screen">

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="w-full sm:w-[400px] bg-white p-4">
        <h2 class="text-2xl py-4 font-semibold text-slate-700 align-left">
            Conta Nova
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
            <input type="text" required placeholder="Nome" name="nome" 
                class="p-2 outline-none w-full border border-1 border-slate-400">
        </div>


        <div class="flex justify-between py-2">
            <input type="email" required placeholder="Email" name="email" 
                class="p-2 outline-none w-full border border-1 border-slate-400">
        </div>

        <div class="flex justify-between py-2">
            <input type="password" required placeholder="Senha" name="senha" 
                class="p-2 outline-none w-full border border-1 border-slate-400">
        </div>
        <div class="flex justify-between py-2">
            <input type="password" required placeholder="Confirmar senha" name="confirm_senha"
                 class="p-2 outline-none w-full border border-1 border-slate-400">
        </div>


        <div class="py-4">
            <button type="submit" name="cadastrar" class="bg-orange-500 px-10 py-2 shadow-lg text-white">Criar conta</button>
        </div>

        <a href="login.php" class="text-1xl py-4 font-semibold text-slate-500 align-left">
            Entrar
        </a>

    </form>

</body>

</html>