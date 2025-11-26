<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constru Casa - Cadastro</title>
    
    <link rel="stylesheet" href="css/style.css">

    <style>
        #mensagem-feedback {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            display: none; /* Começa invisível */
            padding: 10px;
            border-radius: 5px;
        }
        .sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    
    <div id="cadastro-screen">
        <div class="login-container"> 
            
            <span class="botao-fechar" onclick="history.back()">&times;</span> 
            
            <div class="login-logo">
                <img src="../imagens/logo_casa.png" alt="Logo" onerror="this.style.display='none'">
            </div>
            
            <div class="login-box">
                <form id="cadastroForm">
                    
                    <input type="text" id="reg-username" placeholder="Nome Completo:" required>
                    <input type="email" id="reg-email" placeholder="Email:" required>
                    
                    <input type="password" id="reg-password" placeholder="Crie uma Senha:" required>
                    <input type="password" id="reg-confirm-password" placeholder="Confirme a Senha:" required>
                    
                    <button type="submit" class="submit-btn">Finalizar Cadastro</button>
                    
                    <div id="mensagem-feedback"></div>
    
                </form>
            </div>
        </div>
    </div>

   <script>
        const formulario = document.getElementById('cadastroForm');
        const msgDiv = document.getElementById('mensagem-feedback');

        formulario.addEventListener('submit', function(event) {
            event.preventDefault(); // Não recarrega a página

            const senha = document.getElementById('reg-password').value;
            const confirmarSenha = document.getElementById('reg-confirm-password').value;

            // Limpa estilos anteriores
            msgDiv.className = ''; 

            // Validação de Senha
            if (senha !== confirmarSenha) {
                msgDiv.textContent = "As senhas não conferem!";
                msgDiv.classList.add('erro'); // Fica vermelho
                msgDiv.style.display = 'block';
                return;
            }

            // SUCESSO
            msgDiv.textContent = "Cadastro realizado com sucesso!";
            msgDiv.classList.add('sucesso'); // Fica verde
            msgDiv.style.display = 'block';

            // Limpa o formulário
            formulario.reset();

            // (Opcional) Faz a mensagem sumir depois de 3 segundos
            setTimeout(() => {
                msgDiv.style.display = 'none';
            }, 3000);
        });
   </script>
</body>
</html>