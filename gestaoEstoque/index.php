<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constru Casa - Gestão de Estoque</title>
    
    <link rel="stylesheet" href="../paginainicial/css/style.css"> 
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Estilos específicos para a área de Gestão de Estoque */
        .search-area {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            align-items: center;
        }
        .search-area input {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #555;
            background-color: #4a4a4a;
            color: white;
            width: 300px;
        }
        .search-area button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            background-color: #d8c8c8;
            color: #333;
            font-weight: bold;
            cursor: pointer;
        }

        /* Tabela de Estoque */
        .stock-table th, .stock-table td {
            text-align: left;
            vertical-align: middle;
        }
        .stock-table th {
            background-color: #555;
            color: #d8c8c8;
        }
        .stock-table td {
            background-color: #3f3f3f; 
            color: white;
        }
        
        .low-stock {
            background-color: #da190b !important; /* Vermelho escuro para destaque de estoque */
            color: white !important; 
            font-weight: bold;
        }
        
        .stock-status-cell {
            font-weight: bold;
        }
    </style>
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
                        <a href="../cadastroProduto/index.php"><i class="bi bi-person-fill"></i> Cadastro de Produtos</a>
                    </li>
                    <li class="menu-item">
                        <a href="../entradaSaida/index.php"><i class="bi bi-boxes"></i> entrada e saída dos produtos</a>
                    </li>
                 
                </ul>
            </nav>

            <section class="content-area">
                <h1 style="color: white; margin-bottom: 20px;">Relatório de Estoque Atual</h1>
                
                <?php if (!empty($mensagem_erro)): ?>
                    <div class="alert alert-danger" role="alert"><?= $mensagem_erro ?></div>
                <?php endif; ?>

                <div class="search-area">
                    <input type="text" placeholder="Pesquisar por Código, Produto ou Cor...">
                    <button><i class="bi bi-search"></i> Pesquisar</button>
                </div>
                
                <table class="table table-hover stock-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Cor / Textura</th>
                            <th>Peso/Litro</th>
                            <th>Estoque Atual (Simulado)</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($produtos)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Nenhum produto cadastrado no momento.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($produtos as $produto): 
                                // Simulação de estoque e status para fins de layout
                                $estoque_simulado = rand(5, 150); // Valor aleatório
                                $is_low_stock = $estoque_simulado < 15;
                                $status_badge = $is_low_stock ? '<span class="badge bg-danger">Baixo Estoque</span>' : '<span class="badge bg-success">Em Estoque</span>';
                                $row_class = $is_low_stock ? 'low-stock-row' : '';
                            ?>
                                <tr class="<?= $row_class ?>">
                                    <td><?= htmlspecialchars($produto['id']) ?></td>
                                    <td><?= htmlspecialchars($produto['produto']) ?></td>
                                    <td><?= htmlspecialchars($produto['cor']) ?> / <?= htmlspecialchars($produto['textura']) ?></td>
                                    <td><?= htmlspecialchars($produto['peso_litro']) ?></td>
                                    <td class="stock-status-cell <?= $is_low_stock ? 'low-stock' : '' ?>"><?= $estoque_simulado ?></td>
                                    <td><?= $status_badge ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Ações
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="editar_produto.php?id=<?= $produto['id'] ?>">Editar</a></li>
                                                <li><a class="dropdown-item" href="../entradaSaida/index.php?codigo=<?= $produto['id'] ?>">Movimentar Estoque</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="deletar_produto.php?id=<?= $produto['id'] ?>">Excluir</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-YIeQ4o8qX1n7wA1z32X4gVjKkR4W3eE4p9z0P1r2v5u7L6gP8z9C3b2D9b4c5D6" crossorigin="anonymous"></script>

    <script>
        const logoutBtn = document.getElementById('logoutBtn');
        const userGreetingElement = document.getElementById('userGreeting');

        function loadUserName() {
            const userName = localStorage.getItem('userName');
            if (userName) {
                userGreetingElement.textContent = `olá ${userName}`;
            } else {
                window.location.href = '../pagina_login/index.php';
            }
        }
        
        loadUserName(); 

        logoutBtn.addEventListener('click', function() {
            localStorage.removeItem('userName');
            window.location.href = '../pagina_login/index.php';
        });
    </script>
</body>
</html>