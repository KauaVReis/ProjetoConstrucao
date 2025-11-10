<?php
// A base PHP para a lógica de back-end fica aqui.
// Por enquanto, apenas o cabeçalho de PHP está incluso.

// include_once '../conexao.php'; // Removido por enquanto
// if ($_SERVER["REQUEST_METHOD"] == "POST") { ... } // Removido por enquanto
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constru Casa - Entrada e Saída</title>
    
    <link rel="stylesheet" href="../paginainicial/css/style.css"> 
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
</head> 
 
<body>
    
    <div id="dashboard-screen" class="container" style="display: flex; flex-direction: column; flex: 1;">
        <header class="header">
            <div class="logo-area">
                <div class="dashboard-logo">
                    <img src="../imagens/logo_casa.png" alt="Logo Constru Casa">
                </div>
                <span class="company-name">Constru Casa</span>
            </div>
            <div class="user-area">
                <span class="user-greeting" id="userGreeting">olá usuário</span>
               <i class="bi bi-door-open-fill" id="logoutBtn"></i> 
            </div>
        </header>

        <main class="main-content">
            <nav class="sidebar">
                <ul>
                   <li class="menu-item">
                        <a href="../paginainicial/index.php"><i class=" bi bi-house-door"></i> Pagina Inicial</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://localhost/aula_PHP/ProjetoConstrucao/cadastroProduto/"><i class="bi bi-tools"></i> Cadastro de produtos</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://localhost/aula_PHP/ProjetoConstrucao/entradaSaida/"><i class="bi bi-boxes"></i> entrada e saída dos produtos</a>
                    </li>
                </ul>
            </nav>

            <section class="content-area">
                <h1 style="color: white; margin-bottom: 20px;">Gestão de Movimentação de Estoque</h1>
                
                <div class="forms-container">
                    
                    <div class="form-box">
                        <h3>Entrada de Produtos</h3>
                        <form method="post" action=""> 
                            <label for="codigo_entrada">Código/Referência do Produto:</label>
                            <input type="text" id="codigo_entrada" name="codigo_entrada" required>
                            
                            <label for="quantidade_entrada">Quantidade Recebida:</label>
                            <input type="number" id="quantidade_entrada" name="quantidade_entrada" min="1" required>
                            
                            <label for="nota_fiscal">Nota Fiscal (Opcional):</label>
                            <input type="text" id="nota_fiscal" name="nota_fiscal">
                            
                            <button type="submit" name="btn_entrada_submit" id="btn-entrada">Registrar Entrada</button>
                        </form>
                    </div>

                    <div class="form-box">
                        <h3>Saída de Produtos</h3>
                         <form method="post" action=""> 
                            <label for="codigo_saida">Código/Referência do Produto:</label>
                            <input type="text" id="codigo_saida" name="codigo_saida" required>
                            
                            <label for="quantidade_saida">Quantidade Vendida/Utilizada:</label>
                            <input type="number" id="quantidade_saida" name="quantidade_saida" min="1" required>
                            
                            <label for="destino_saida">Destino/Cliente (Opcional):</label>
                            <input type="text" id="destino_saida" name="destino_saida">
                            
                            <button type="submit" name="btn_saida_submit" id="btn-saida">Registrar Saída</button>
                        </form>
                    </div>
                </div>

            </section>
        </main>
    </div>

    <script>
        const logoutBtn = document.getElementById('logoutBtn');
        const userGreetingElement = document.getElementById('userGreeting');

        function loadUserName() {
            const userName = localStorage.getItem('userName');
            if (userName) {
                userGreetingElement.textContent = `olá ${userName}`;
            } else {
                // Redirecionamento de segurança para o login
                window.location.href = '../pagina_login/index.php';
            }
        }
        
        loadUserName(); 

        // Função de Logout
        logoutBtn.addEventListener('click', function() {
            localStorage.removeItem('userName');
            window.location.href = '../pagina_login/index.php';
        });
    </script>
</body>
</html>