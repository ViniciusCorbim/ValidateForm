<?php
    $erroNome = "";
    $erroEmail = "";
    $erroSenha = "";
    $erroConfirmarSenha = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Validação do Nome
        if (empty($_POST['nome'])) {
            $erroNome = "Preencha o Campo com seu Nome";
        }else {
            $nome = limpaPost($_POST['nome']);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
                $erroNome = "Apenas Letras e Espaços em Branco";
            }
        }

    //Validação do E-mail
    if (empty($_POST['email'])) {
        $erroEmail = "Preencha o Campo com seu E-mail";
    }else {
        $email = limpaPost($_POST['email']);
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $erroEmail = "Email Inválido!";
        }
    }

    //Validação da Senha
    if (empty($_POST['senha'])) {
        $erroSenha = "Preencha o Campo com sua Senha";
    }else {
        $senha = limpaPost($_POST['senha']);
        if (strlen($senha) < 6) {
            $erroSenha = "A senha precisa ter no mínimo 6 dígitos";
        }
    }

    //Validação do Confirmar Senha
    if (empty($_POST['confirmarSenha'])) {
        $erroConfirmarSenha = "Preencha o Campo com sua Senha";
    }else {
        $confirmarSenha = limpaPost($_POST['confirmarSenha']);
        if ($confirmarSenha !== $senha){
            $erroConfirmarSenha = "Confirmar Senha diferente de Senha";
        }
    }

    if ($erroNome == '' && $erroEmail == '' && $erroSenha == '' && $erroConfirmarSenha == '') {
        header("location: thanks.php");
    }
    }

    function limpaPost($post){
        $post = trim($post);
        $post = stripslashes($post);
        $post = htmlspecialchars($post);
        return $post;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Teste</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1><mark>AULA PHP</mark></h1>
        <h2>Validação de Formulários</h2>
        <form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <!--------------Nome Completo-------------->
            <label for="nome">Nome Completo</label>
            <input required type="text" placeholder="Digite seu Nome" name="nome" id="nome" <?php if(!(empty($erroNome))){echo "class='invalido'";} ?> <?php if(isset($_POST['nome'])){echo "value='". $_POST['nome']."'";} ?> >
            <br><span class="erro"><?php echo $erroNome ?></span>

            <!--------------------E-mail-------------------->
            <label for="email">E-mail</label>
            <input required type="email" placeholder="email@provedor.com" name="email" id="email" <?php if(!(empty($erroEmail))){echo "class='invalido'";} ?> <?php if(isset($_POST['email'])){echo "value='". $_POST['email']."'";} ?>>
            <br><span class="erro"><?php echo $erroEmail ?></span>

            <!--------------------Senha-------------------->
            <label for="senha">Senha</label>
            <input required type="password" placeholder="Digite sua Senha" name="senha" id="senha" <?php if(!(empty($erroSenha))){echo "class='invalido'";} ?> <?php if(isset($_POST['senha'])){echo "value='". $_POST['senha']."'";} ?>>
            <br><span class="erro"><?php echo $erroSenha ?></span>

            <!--------------------Confirmar Senha-------------------->
            <label for="confirmarSenha">Confirmar Senha</label>
            <input required type="password" placeholder="Confirme sua Senha" name="confirmarSenha" id="confirmarSenha" <?php if(!(empty($erroConfirmarSenha))){echo "class='invalido'";} ?> <?php if(isset($_POST['confirmarSenha'])){echo "value='". $_POST['confirmarSenha']."'";} ?>>
            <br><span class="erro"><?php echo $erroConfirmarSenha ?></span>

            <input type="submit" value="Enviar Formulário" id="submit">
        </form>
    </main>
</body>
</html>