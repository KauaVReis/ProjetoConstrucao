<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constru Casa - Dashboard</title>
    <link rel="stylesheet" href="_css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ===== Modal de senha (Fundo escuro) ===== */
        .modal-senha {
            display: flex;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        /* ===== Conteúdo do Modal (Card Branco) ===== */
        .modal-content {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            /* 🎯 Essencial para posicionar o botão 'X' */
            position: relative; 
        }

        .modal-content h2 {
            margin-bottom: 15px;
        }

        .modal-content input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-confirmar {
            background: #198754;
            color: white;
        }

        .btn-confirmar:hover {
            background: #157347;
        }

        /* ❌ NOVO ESTILO: Botão "X" no canto superior direito */
        .botao-fechar {
            position: absolute;
            top: -10px;    
            right: -10px;  
            
            background-color: #ff3b30; /* Vermelho */
            color: white;             
            font-size: 18px;          
            font-weight: bold;
            
            width: 28px;              
            height: 28px;
            border-radius: 50%;       
            
            display: flex;
            justify-content: center;
            align-items: center;
            line-height: 1; 
            cursor: pointer;          
            z-index: 10;              
        }

        .botao-fechar:hover {
            background-color: #cc0000; 
        }
        
        /* Oculta o dashboard até senha correta */
        #dashboard-screen {
            display: none;
        }

        /* 🗑️ Os estilos .btn-volta e .btn-volta a foram removidos, pois o botão "Voltar" não existe mais */
    </style>
</head>
<body>

    <div id="senhaModal" class="modal-senha">
        <div class="modal-content">
            <span class="botao-fechar">&times;</span> 

            <h2>Digite a senha de acesso</h2>
            <input type="password" id="senhaInput" placeholder="Senha">
            <button class="btn-confirmar" id="confirmarSenha">Entrar</button>
            
            </div>
    </div>

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
                <i class="bi bi-door-open-fill" id="logoutBtn" style="cursor:pointer;"></i> 
            </div>
        </header>

        <main class="main-content">
            <nav class="sidebar">
                <ul>
                    <li class="menu-item">
                        <a href="http://localhost/aula_PHP/ProjetoConstrucao/Tabelas/tabelaCadastro/"><i class="bi bi-tools"></i> Tabela de Cadastro</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://localhost/aula_PHP/ProjetoConstrucao/Tabelas/tabelaEntradaSaida/"><i class="bi bi-boxes"></i> Tabela de Entrada e Saida</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://localhost/aula_PHP/ProjetoConstrucao/Tabelas/gestaoTabela/gestaoEstoque.php"><i class="bi bi-cart-plus"></i> Gestão de estoque</a>
                    </li>
                </ul>
            </nav>

            <section class="content-area">
                <h1>Bem-vindo à gestão de Tabelas!</h1>
                <p>Use o menu lateral para navegar pelas funcionalidades do sistema.</p>
            </section>
        </main>
    </div>

    <script>
        const modal = document.getElementById('senhaModal');
        const dashboard = document.getElementById('dashboard-screen');
        const senhaInput = document.getElementById('senhaInput');
        const confirmarBtn = document.getElementById('confirmarSenha');
        const logoutBtn = document.getElementById('logoutBtn');
        const userGreetingElement = document.getElementById('userGreeting');
        
        // 🆕 NOVO: Seletor para o botão "X"
        const botaoFechar = document.querySelector('.botao-fechar'); 

        // === Senha de acesso ===
        const senhaCorreta = "1234"; // 🔒 

        // === Verifica nome de usuário ===
        function loadUserName() {
            const userName = localStorage.getItem('userName');
            if (userName) {
                userGreetingElement.textContent = `olá ${userName}`;
            } else {
                window.location.href = '../pagina_login/index.php';
            }
        }

        // === Quando clicar em "Entrar" ===
        confirmarBtn.addEventListener('click', function() {
            if (senhaInput.value === senhaCorreta) {
                modal.style.display = 'none';
                dashboard.style.display = 'flex';
                loadUserName();
            } else {
                alert("Senha incorreta!");
                senhaInput.value = "";
            }
        });

        // === Enter também confirma ===
        senhaInput.addEventListener('keypress', function(e) {
            if (e.key === "Enter") {
                confirmarBtn.click();
            }
        });
        
        // === 🆕 NOVO: Clique no Botão "X" volta pra página inicial ===
        botaoFechar.addEventListener('click', function() {
            window.location.href = '../paginainicial/index.php';
        });


        // === Botão de saída (logout) volta pra página inicial ===
        logoutBtn.addEventListener('click', function() {
            window.location.href = '../paginainicial/index.php';
        });
    </script>
</body>
</html>