<link rel="stylesheet" href="src/views/Dashboard/style.css">

<div class="pagina-dashboard">
    <div class="cabecalho-dashboard">
        <h2 class="titulo-dashboard">Painel de Monitoramento</h2>
        <p class="subtitulo-dashboard">Visão geral, indicadores-chave e previsão do tempo.</p>
    </div>

    <div class="card-clima-principal">
        <div class="info-clima-esquerda">
            <span class="temperatura-grande">27°C</span>
            <div class="condicao-clima">
                <span class="status-tempo">Nublado</span>
                <span class="detalhes-tempo">Umidade: <strong>58%</strong> &nbsp;&bull;&nbsp; Vento: <strong>24 km/h</strong></span>
                <span class="cidade-tempo">Diadema</span>
            </div>
        </div>
        <div class="icone-clima-nuvem">
            <svg viewBox="0 0 64 64" width="80" height="80">
                <path d="M46,36a10,10,0,0,0-9.9-8.72,12,12,0,0,0-22,2A10,10,0,0,0,6,38a10,10,0,0,0,10,10H46a10,10,0,0,0,0-20Z" fill="#90a4ae"/>
                <path d="M36,24a12,12,0,0,0-7-2.27A12,12,0,0,1,38,34a11.91,11.91,0,0,1-.53,3.52A10,10,0,0,1,46,36a10,10,0,0,1,7,2.73A12,12,0,0,0,36,24Z" fill="#78909c"/>
            </svg>
        </div>
    </div>

    <div class="grid-indicadores">
        <div class="card-indicador">
            <span class="titulo-indicador">MODO DE ALERTA DE FRIO</span>
            <span class="valor-indicador alerta-inativo">INATIVO</span>
        </div>
        
        <div class="card-indicador">
            <span class="titulo-indicador">PEÇAS ESSENCIAIS (ESTOQUE)</span>
            <span class="valor-indicador">0</span>
        </div>

        <div class="card-indicador">
            <span class="titulo-indicador">PESSOAS VULNERÁVEIS</span>
            <span class="valor-indicador">1</span>
        </div>
    </div>

    <div class="secao-previsao">
        <h3 class="titulo-secao">Previsão para os próximos dias</h3>
        <div class="grid-previsao-dias">
            <div class="dia-previsao">
                <span class="nome-dia">sáb.</span>
                <div class="icone-previsao-pequeno">☁️</div>
                <span class="temperaturas-dia">27° / 21°</span>
            </div>
            <div class="dia-previsao">
                <span class="nome-dia">dom.</span>
                <div class="icone-previsao-pequeno">🌧️</div>
                <span class="temperaturas-dia">20° / 13°</span>
            </div>
            <div class="dia-previsao">
                <span class="nome-dia">seg.</span>
                <div class="icone-previsao-pequeno">☁️</div>
                <span class="temperaturas-dia">17° / 13°</span>
            </div>
            <div class="dia-previsao">
                <span class="nome-dia">ter.</span>
                <div class="icone-previsao-pequeno">⛅</div>
                <span class="temperaturas-dia">21° / 12°</span>
            </div>
            <div class="dia-previsao">
                <span class="nome-dia">qua.</span>
                <div class="icone-previsao-pequeno">⛅</div>
                <span class="temperaturas-dia">25° / 15°</span>
            </div>
        </div>
    </div>
</div>
