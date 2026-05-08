<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Corrente do Agasalho</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="src/components/Sidebar/style.css">
    <?php if (file_exists($css_view)) echo "<link rel='stylesheet' href='$css_view'>"; ?>
</head>
<body>
    <div class="container-aplicacao">
        <?php include 'src/components/Sidebar/index.php'; ?>
        <main class="conteudo-principal">
            <?php include $caminho_view; ?>
        </main>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>