<?php
    session_start();
    require_once('../conexao/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constru Casa - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div id="login-screen">
        <div class="login-container"> 
            
            <div class="login-logo">
                <img src="../imagens/logo_casa.png" alt="Logo Constru Casa" onerror="this.style.display='none'">
            </div>
            
            <div class="login-box">
                <form id="loginForm" method="POST" action="">
                    
                    <input type="text" name="nome_dummy" placeholder="Nome:" required>

                    <input type="email" name="email" id="email" placeholder="Email:" required>
                    
                    <input type="password" name="senha" id="password" placeholder="Senha:" required>
                    
                    <button type="submit" class="submit-btn">Concluído</button>
                    
                    <button type="button" class="register-btn" onclick="window.location.href='../pagina_cadastro/index.php'">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
// Certifique-se de que o session_start() está no topo do arquivo (já está no seu HTML)
// e que a conexão $pdo está funcionando.

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // 1. Receber dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        // 2. Buscar o usuário pelo EMAIL
        $sql = "SELECT * FROM saep_db2.usuarios WHERE usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        // Pega o resultado
        $dados_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // 3. VERIFICAÇÃO DE SENHA (TEXTO PURO)
        // Alteramos aqui: removemos o password_verify e usamos comparação direta (==)
        if ($dados_usuario && $senha == $dados_usuario['senha']) {
            
            // Login Sucesso: Salvar dados na sessão
            $_SESSION['id_usuario'] = $dados_usuario['id']; 
            $_SESSION['nome_usuario'] = $dados_usuario['nome_usuario'];

            // Redirecionar via JS
            echo "<script>
                    alert('Bem-vindo, " . $dados_usuario['nome_usuario'] . "!');
                    window.location.href = '../paginaInicial/index.php';
                  </script>";
            exit;

        } else {
            // Login Falhou
            echo "<script>alert('❌ Email ou senha incorretos!');</script>";
        }

    } catch(PDOException $e) {
        echo "<script>alert('Erro no sistema: " . $e->getMessage() . "');</script>";
    }
}
?>