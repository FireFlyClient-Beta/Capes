<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firefly Client - Usuários</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        h1 { color: #a64dff; } /* Cor Roxo Neon */
        .container {
            max_width: 600px;
            margin: 0 auto;
            background: #2b2b2b;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }
        .user-list {
            list-style: none;
            padding: 0;
            text-align: left;
        }
        .user-item {
            background: #333;
            margin: 5px 0;
            padding: 10px;
            border-left: 4px solid #a64dff;
            display: flex;
            justify-content: space-between;
        }
        .cape-name { color: #888; font-size: 0.9em; }
        .stats { margin-bottom: 20px; color: #ccc; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Firefly Client Database</h1>
        
        <?php
            $arquivo = 'capes.txt';
            if (file_exists($arquivo)) {
                $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $total = count($linhas);
                echo "<div class='stats'>Total de Usuários com Capa: <strong>$total</strong></div>";
                
                echo "<ul class='user-list'>";
                // Inverte para mostrar os mais novos primeiro
                $linhas = array_reverse($linhas);
                
                foreach ($linhas as $linha) {
                    $partes = explode(":", $linha);
                    if (count($partes) >= 2) {
                        $nick = htmlspecialchars($partes[0]);
                        $capa = htmlspecialchars($partes[1]);
                        
                        // Mostra a linha do jogador
                        echo "<li class='user-item'>";
                        echo "<span><img src='https://minotar.net/avatar/$nick/20' style='vertical-align:middle; margin-right:8px;'> <strong>$nick</strong></span>";
                        echo "<span class='cape-name'>$capa</span>";
                        echo "</li>";
                    }
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhum usuário registrado ainda.</p>";
            }
        ?>
    </div>

</body>
</html>
