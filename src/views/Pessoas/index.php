<link rel="stylesheet" href="src/views/Pessoas/style.css">

<div class="pagina-pessoas">
    <div class="cabecalho-pagina">
        <h2 class="titulo-pagina">Gestão de Pessoas</h2>
        <p class="subtitulo-pagina">Cadastre, consulte e edite doadores e beneficiários.</p>
    </div>

    <div class="container-gestao">
        <div class="painel-lateral-lista">
            <h3 class="titulo-bloco-lista">Pessoas Cadastradas</h3>
            
            <div class="container-busca">
                <input type="text" class="input-busca" placeholder="Buscar por nome ou documento...">
                <span class="icone-busca">🔍</span>
            </div>

            <div class="lista-pessoas">
                <div class="item-pessoa ativo">
                    <span class="nome-pessoa-item">Jair Messias Bolsonaro</span>
                    <span class="doc-pessoa-item">171.717.171-71</span>
                </div>
                
                <div class="item-pessoa">
                    <span class="nome-pessoa-item">Oruan cpx revoltado</span>
                    <span class="doc-pessoa-item">222.222.222-22</span>
                </div>
            </div>
        </div>

        <div class="painel-formulario-detalhes">
            <div class="abas-navegacao">
                <button class="botao-aba ativa">Dados Cadastrais</button>
                <button class="botao-aba">Histórico de Atividades</button>
            </div>

            <form class="formulario-pessoa" method="POST" action="">
                <div class="campo-grupo-full">
                    <label class="rotulo-campo">Nome Completo</label>
                    <div class="wrapper-input-checkbox">
                        <input type="text" class="input-formulario" name="nome_completo" value="">
                        <label class="checkbox-container">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>

                <div class="linha-dupla-formulario">
                    <div class="campo-grupo">
                        <label class="rotulo-campo">CPF / Documento</label>
                        <input type="text" class="input-formulario" name="cpf_documento" placeholder="___.___.___-__">
                    </div>
                    <div class="campo-grupo">
                        <label class="rotulo-campo">Telefone</label>
                        <input type="text" class="input-formulario" name="telefone" placeholder="(__) _____-____">
                    </div>
                </div>

                <h4 class="subsecao-titulo">Endereço (Integração ViaCEP)</h4>

                <div class="linha-cep-busca">
                    <div class="campo-grupo">
                        <label class="rotulo-campo">CEP</label>
                        <input type="text" class="input-formulario" name="cep" placeholder="_____-___">
                    </div>
                    <button type="button" class="botao-buscar-cep">Buscar CEP</button>
                </div>

                <div class="campo-grupo-full">
                    <label class="rotulo-campo">Rua / Logradouro</label>
                    <input type="text" class="input-formulario campo-desabilitado" name="logradouro" readonly>
                </div>

                <div class="linha-dupla-formulario">
                    <div class="campo-grupo">
                        <label class="rotulo-campo">Número</label>
                        <input type="text" class="input-formulario" name="numero">
                    </div>
                    <div class="campo-grupo">
                        <label class="rotulo-campo">Complemento</label>
                        <input type="text" class="input-formulario" name="complemento">
                    </div>
                </div>

                <div class="barra-acoes-formulario">
                    <button type="button" class="botao-acao acao-limpar">Limpar (Novo)</button>
                    <div class="grupo-acoes-direita">
                        <button type="button" class="botao-acao acao-excluir">Excluir</button>
                        <button type="submit" class="botao-acao acao-salvar">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
