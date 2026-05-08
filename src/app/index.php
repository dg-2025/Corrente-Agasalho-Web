<?php
// Define a tela padrão
$tela = isset($_GET['tela']) ? $_GET['tela'] : 'Dashboard';

// Caminhos dos arquivos
$caminho_view = "src/views/$tela/index.php";
$css_view = "src/views/$tela/style.css";

// Se a pasta não existir, volta pro Dashboard
if (!file_exists("src/views/$tela")) {
    $tela = 'Dashboard';
    $caminho_view = "src/views/Dashboard/index.php";
    $css_view = "src/views/Dashboard/style.css";
}

require_once 'layout.php';