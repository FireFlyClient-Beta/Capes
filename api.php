<?php
// Configurações
$arquivoCapas = 'capes.txt';
$capaPadrao = "Cat Couple"; // Nome EXATO que está no seu CapeManager.java

// Recebe o nick enviado pelo Client (ex: api.php?nick=DarkRz)
// O preg_replace remove caracteres estranhos para segurança
$nick = isset($_GET['nick']) ? preg_replace("/[^a-zA-Z0-9_]/", "", $_GET['nick']) : "";

header('Content-Type: text/plain');

// Validação: Nick deve ter entre 3 e 16 letras (Padrão Minecraft)
if (strlen($nick) >= 3 && strlen($nick) <= 16) {

    // Lê o arquivo atual
    if (file_exists($arquivoCapas)) {
        $conteudoAtual = file_get_contents($arquivoCapas);
    } else {
        $conteudoAtual = "";
    }

    // Verifica se o nick JÁ EXISTE na lista (ignorando maiúsculas/minúsculas)
    if (stripos($conteudoAtual, $nick . ":") === false) {
        
        // Cria a linha nova. Ex: DarkRz:Cat Couple
        $novaLinha = $nick . ":" . $capaPadrao . "\n";
        
        // Tenta salvar no arquivo
        // LOCK_EX evita erro se duas pessoas entrarem ao mesmo tempo
        if (file_put_contents($arquivoCapas, $novaLinha, FILE_APPEND | LOCK_EX)) {
            echo "SUCESSO: Jogador " . $nick . " registrado com a capa " . $capaPadrao;
        } else {
            echo "ERRO: Sem permissão para escrever no arquivo capes.txt";
        }
        
    } else {
        echo "INFO: O jogador " . $nick . " já possui capa.";
    }

} else {
    echo "ERRO: Nick inválido ou não fornecido.";
}
?>
