<aside class="barra-lateral">
    <div class="cabecalho-barra-lateral">
        <h1 class="texto-logo">Corrente do Agasalho</h1>
    </div>

    <nav class="navegacao-barra-lateral">
        <a href="index.php?tela=Dashboard" class="link-navegacao <?php echo ($tela == 'Dashboard') ? 'ativo' : ''; ?>">
            <i data-lucide="home"></i> Dashboard
        </a>
        <a href="index.php?tela=Pessoas" class="link-navegacao <?php echo ($tela == 'Pessoas') ? 'ativo' : ''; ?>">
            <i data-lucide="users"></i> Pessoas (Doador/Benef.)
        </a>
        <a href="index.php?tela=Voluntarios" class="link-navegacao <?php echo ($tela == 'Voluntarios') ? 'ativo' : ''; ?>">
            <i data-lucide="refresh-cw"></i> Voluntários
        </a>
        <a href="index.php?tela=DoacaoEntrada" class="link-navegacao <?php echo ($tela == 'DoacaoEntrada') ? 'ativo' : ''; ?>">
            <i data-lucide="archive"></i> Registrar Doação (Entrada)
        </a>
        <a href="index.php?tela=EntregaSaida" class="link-navegacao <?php echo ($tela == 'EntregaSaida') ? 'ativo' : ''; ?>">
            <i data-lucide="send"></i> Registrar Entrega (Saída)
        </a>
        <a href="index.php?tela=Inventario" class="link-navegacao <?php echo ($tela == 'Inventario') ? 'ativo' : ''; ?>">
            <i data-lucide="search"></i> Consultar Inventário
        </a>

        <div class="divisor-barra-lateral"></div>

        <span class="titulo-secao-navegacao">ADMINISTRAÇÃO</span>
        
        <a href="index.php?tela=PontosColeta" class="link-navegacao <?php echo ($tela == 'PontosColeta') ? 'ativo' : ''; ?>">
            <i data-lucide="map-pin"></i> Pontos de Coleta
        </a>
        <a href="index.php?tela=Usuarios" class="link-navegacao <?php echo ($tela == 'Usuarios') ? 'ativo' : ''; ?>">
            <i data-lucide="user"></i> Gerenciar Usuários
        </a>
        <a href="index.php?tela=Parametros" class="link-navegacao <?php echo ($tela == 'Parametros') ? 'ativo' : ''; ?>">
            <i data-lucide="settings"></i> Parâmetros do Sistema
        </a>
        <a href="index.php?tela=Auditoria" class="link-navegacao <?php echo ($tela == 'Auditoria') ? 'ativo' : ''; ?>">
            <i data-lucide="clock"></i> Auditoria e Estornos
        </a>
    </nav>

    <div class="rodape-barra-lateral">
        <a href="logout.php" class="botao-sair">Sair (Logout)</a>
    </div>
</aside>