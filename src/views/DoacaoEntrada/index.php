<?php
// ============================================================
// CONEXÃO COM BANCO DE DADOS
// Quando o banco estiver pronto, descomente as linhas abaixo
// e remova os arrays de dados fictícios mais abaixo
// ============================================================
// $host   = 'localhost';
// $dbname = 'corrente_agasalho';
// $user   = 'root';
// $pass   = '';
// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Erro na conexão: " . $e->getMessage());
// }

// ============================================================
// BUSCA DE PESSOAS (Doadores) — tabela: pessoas
// ============================================================
// $pessoas = $pdo->query("
//     SELECT id_pessoa, nome
//     FROM pessoas
//     WHERE is_ativo = 1
//     ORDER BY nome
// ")->fetchAll(PDO::FETCH_ASSOC);
// -------- DADOS FICTÍCIOS (remover quando banco estiver ativo) --------
$pessoas = [
    ['id_pessoa' => 1, 'nome' => 'Ana Paula Silva'],
    ['id_pessoa' => 2, 'nome' => 'Carlos Mendes'],
    ['id_pessoa' => 3, 'nome' => 'Fernanda Costa'],
    ['id_pessoa' => 4, 'nome' => 'João Roberto'],
];

// ============================================================
// BUSCA DE PONTOS DE COLETA — tabela: pontos_coleta
// ============================================================
// $pontos_coleta = $pdo->query("
//     SELECT id_ponto_coleta, nome
//     FROM pontos_coleta
//     WHERE is_ativo = 1
//     ORDER BY nome
// ")->fetchAll(PDO::FETCH_ASSOC);
// -------- DADOS FICTÍCIOS --------
$pontos_coleta = [
    ['id_ponto_coleta' => 1, 'nome' => 'Igreja Central - Centro'],
    ['id_ponto_coleta' => 2, 'nome' => 'Escola Municipal - Bairro Norte'],
    ['id_ponto_coleta' => 3, 'nome' => 'Associação de Moradores - Vila Verde'],
];

// ============================================================
// BUSCA DE CATEGORIAS — tabela: param_categorias
// ============================================================
// $categorias = $pdo->query("
//     SELECT id_categoria, nome, pontos_doacao
//     FROM param_categorias
//     ORDER BY nome
// ")->fetchAll(PDO::FETCH_ASSOC);
// -------- DADOS FICTÍCIOS --------
$categorias = [
    ['id_categoria' => 1, 'nome' => 'Agasalho / Casaco',     'pontos_doacao' => 10],
    ['id_categoria' => 2, 'nome' => 'Cobertor / Manta',      'pontos_doacao' => 15],
    ['id_categoria' => 3, 'nome' => 'Calça',                 'pontos_doacao' => 8],
    ['id_categoria' => 4, 'nome' => 'Camiseta / Blusa',      'pontos_doacao' => 5],
    ['id_categoria' => 5, 'nome' => 'Calçado',               'pontos_doacao' => 7],
    ['id_categoria' => 6, 'nome' => 'Roupa Infantil',        'pontos_doacao' => 6],
    ['id_categoria' => 7, 'nome' => 'Acessório (gorro/luva)','pontos_doacao' => 3],
];

// ============================================================
// BUSCA DE TAMANHOS — tabela: param_tamanhos
// ============================================================
// $tamanhos = $pdo->query("
//     SELECT id_tamanho, nome
//     FROM param_tamanhos
//     ORDER BY id_tamanho
// ")->fetchAll(PDO::FETCH_ASSOC);
// -------- DADOS FICTÍCIOS --------
$tamanhos = [
    ['id_tamanho' => 1, 'nome' => 'PP'],
    ['id_tamanho' => 2, 'nome' => 'P'],
    ['id_tamanho' => 3, 'nome' => 'M'],
    ['id_tamanho' => 4, 'nome' => 'G'],
    ['id_tamanho' => 5, 'nome' => 'GG'],
    ['id_tamanho' => 6, 'nome' => 'XGG'],
    ['id_tamanho' => 7, 'nome' => 'Único'],
    ['id_tamanho' => 8, 'nome' => 'Infantil'],
];

// ============================================================
// BUSCA DE CONDIÇÕES — tabela: param_condicoes
// ============================================================
// $condicoes = $pdo->query("
//     SELECT id_condicao, nome
//     FROM param_condicoes
//     ORDER BY id_condicao
// ")->fetchAll(PDO::FETCH_ASSOC);
// -------- DADOS FICTÍCIOS --------
$condicoes = [
    ['id_condicao' => 1, 'nome' => 'Novo / Nunca usado'],
    ['id_condicao' => 2, 'nome' => 'Ótimo estado'],
    ['id_condicao' => 3, 'nome' => 'Bom estado'],
    ['id_condicao' => 4, 'nome' => 'Aceitável'],
];

// ============================================================
// PROCESSAMENTO DO FORMULÁRIO
// ============================================================
$mensagem      = null;
$tipo_mensagem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pessoa       = $_POST['id_pessoa']       ?? null;
    $id_ponto_coleta = $_POST['id_ponto_coleta'] ?? null;
    $id_categoria    = $_POST['id_categoria']    ?? null;
    $id_tamanho      = $_POST['id_tamanho']      ?? null;
    $id_condicao     = $_POST['id_condicao']     ?? null;
    $quantidade      = (int)($_POST['quantidade'] ?? 0);
    $observacao      = trim($_POST['observacao'] ?? '');

    if (!$id_pessoa || !$id_ponto_coleta || !$id_categoria || !$id_tamanho || !$id_condicao || $quantidade < 1) {
        $mensagem      = "Preencha todos os campos obrigatórios.";
        $tipo_mensagem = "erro";
    } else {
        // Calcula pontos gerados
        $pontos_gerados = 0;
        foreach ($categorias as $cat) {
            if ($cat['id_categoria'] == $id_categoria) {
                $pontos_gerados = $cat['pontos_doacao'] * $quantidade;
                break;
            }
        }

        // ============================================================
        // INSERÇÃO NA TABELA doacoes
        // ============================================================
        // $stmt = $pdo->prepare("
        //     INSERT INTO doacoes (id_pessoa, id_ponto_coleta, data_doacao, pontos_gerados, status_transacao)
        //     VALUES (:id_pessoa, :id_ponto_coleta, NOW(), :pontos_gerados, 'concluida')
        // ");
        // $stmt->execute([
        //     ':id_pessoa'       => $id_pessoa,
        //     ':id_ponto_coleta' => $id_ponto_coleta,
        //     ':pontos_gerados'  => $pontos_gerados,
        // ]);
        // $id_doacao = $pdo->lastInsertId();

        // ============================================================
        // INSERÇÃO NA TABELA itens
        // Busca o id do status "Aguardando Triagem" em param_status_triagem
        // ============================================================
        // $id_status_inicial = $pdo->query("
        //     SELECT id_status FROM param_status_triagem WHERE nome = 'Aguardando Triagem' LIMIT 1
        // ")->fetchColumn();
        //
        // $stmt = $pdo->prepare("
        //     INSERT INTO itens
        //         (id_doacao, id_categoria, id_tamanho, id_condicao, id_status_triagem, quantidade_doada, quantidade_estoque)
        //     VALUES
        //         (:id_doacao, :id_categoria, :id_tamanho, :id_condicao, :id_status, :quantidade, :quantidade)
        // ");
        // $stmt->execute([
        //     ':id_doacao'    => $id_doacao,
        //     ':id_categoria' => $id_categoria,
        //     ':id_tamanho'   => $id_tamanho,
        //     ':id_condicao'  => $id_condicao,
        //     ':id_status'    => $id_status_inicial,
        //     ':quantidade'   => $quantidade,
        // ]);

        // ============================================================
        // ATUALIZA SALDO DE PONTOS DO DOADOR — tabela: pessoas
        // ============================================================
        // $pdo->prepare("
        //     UPDATE pessoas SET saldo_pontos = saldo_pontos + :pontos WHERE id_pessoa = :id_pessoa
        // ")->execute([':pontos' => $pontos_gerados, ':id_pessoa' => $id_pessoa]);

        $nome_pessoa = '';
        foreach ($pessoas as $p) {
            if ($p['id_pessoa'] == $id_pessoa) { $nome_pessoa = $p['nome']; break; }
        }

        $mensagem      = "Doação registrada com sucesso! <strong>$nome_pessoa</strong> ganhou <strong>$pontos_gerados pontos</strong>. O item aguarda triagem.";
        $tipo_mensagem = "sucesso";
    }
}
?>

<link rel="stylesheet" href="src/views/DoacaoEntrada/style.css">

<div class="pagina-doacao">

    <div class="cabecalho-pagina">
        <div>
            <h2 class="titulo-pagina">
                <i data-lucide="archive"></i>
                Registrar Doação
            </h2>
            <p class="subtitulo-pagina">Registre a entrada de itens doados no sistema</p>
        </div>
        <div class="badge-status">
            <i data-lucide="clock"></i> Itens entram como: <strong>Aguardando Triagem</strong>
        </div>
    </div>

    <?php if ($mensagem): ?>
        <div class="mensagem mensagem-<?php echo $tipo_mensagem; ?>">
            <i data-lucide="<?php echo $tipo_mensagem === 'sucesso' ? 'check-circle' : 'alert-circle'; ?>"></i>
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <div class="card-formulario">
        <form method="POST" action="">

            <div class="linha-formulario">
                <div class="campo-grupo">
                    <label class="campo-label" for="id_pessoa">
                        <i data-lucide="user"></i> Doador *
                    </label>
                    <select name="id_pessoa" id="id_pessoa" class="campo-input" required>
                        <option value="">Selecione o doador...</option>
                        <?php foreach ($pessoas as $p): ?>
                            <option value="<?php echo $p['id_pessoa']; ?>"
                                <?php echo (isset($_POST['id_pessoa']) && $_POST['id_pessoa'] == $p['id_pessoa']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($p['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo-grupo">
                    <label class="campo-label" for="id_ponto_coleta">
                        <i data-lucide="map-pin"></i> Ponto de Coleta *
                    </label>
                    <select name="id_ponto_coleta" id="id_ponto_coleta" class="campo-input" required>
                        <option value="">Selecione o local...</option>
                        <?php foreach ($pontos_coleta as $pc): ?>
                            <option value="<?php echo $pc['id_ponto_coleta']; ?>"
                                <?php echo (isset($_POST['id_ponto_coleta']) && $_POST['id_ponto_coleta'] == $pc['id_ponto_coleta']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($pc['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="linha-formulario">
                <div class="campo-grupo">
                    <label class="campo-label" for="id_categoria">
                        <i data-lucide="tag"></i> Categoria do Item *
                    </label>
                    <select name="id_categoria" id="id_categoria" class="campo-input" required onchange="atualizarPontos()">
                        <option value="">Selecione a categoria...</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['id_categoria']; ?>"
                                    data-pontos="<?php echo $cat['pontos_doacao']; ?>"
                                <?php echo (isset($_POST['id_categoria']) && $_POST['id_categoria'] == $cat['id_categoria']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['nome']); ?> (<?php echo $cat['pontos_doacao']; ?> pts/item)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo-grupo">
                    <label class="campo-label" for="quantidade">
                        <i data-lucide="hash"></i> Quantidade *
                    </label>
                    <input type="number" name="quantidade" id="quantidade" class="campo-input"
                           min="1" max="50" value="<?php echo $_POST['quantidade'] ?? 1; ?>"
                           required oninput="atualizarPontos()">
                </div>
            </div>

            <div class="linha-formulario">
                <div class="campo-grupo">
                    <label class="campo-label" for="id_tamanho">
                        <i data-lucide="maximize-2"></i> Tamanho *
                    </label>
                    <select name="id_tamanho" id="id_tamanho" class="campo-input" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($tamanhos as $tam): ?>
                            <option value="<?php echo $tam['id_tamanho']; ?>"
                                <?php echo (isset($_POST['id_tamanho']) && $_POST['id_tamanho'] == $tam['id_tamanho']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($tam['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo-grupo">
                    <label class="campo-label" for="id_condicao">
                        <i data-lucide="star"></i> Condição do Item *
                    </label>
                    <select name="id_condicao" id="id_condicao" class="campo-input" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($condicoes as $cond): ?>
                            <option value="<?php echo $cond['id_condicao']; ?>"
                                <?php echo (isset($_POST['id_condicao']) && $_POST['id_condicao'] == $cond['id_condicao']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cond['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="preview-pontos" id="preview-pontos" style="display:none;">
                <i data-lucide="zap"></i>
                Esta doação vai gerar <span id="total-pontos" class="destaque-pontos">0</span> pontos para o doador
            </div>

            <div class="campo-grupo campo-grupo-full">
                <label class="campo-label" for="observacao">
                    <i data-lucide="file-text"></i> Observações (opcional)
                </label>
                <textarea name="observacao" id="observacao" class="campo-input campo-textarea"
                          placeholder="Ex: item com leve desgaste na manga, peça especial para inverno..."
                          rows="3"><?php echo htmlspecialchars($_POST['observacao'] ?? ''); ?></textarea>
            </div>

            <div class="linha-botoes">
                <button type="reset" class="botao-secundario" onclick="resetarPreview()">
                    <i data-lucide="x"></i> Limpar
                </button>
                <button type="submit" class="botao-primario">
                    <i data-lucide="check"></i> Registrar Doação
                </button>
            </div>

        </form>
    </div>

    <div class="info-fluxo">
        <h4><i data-lucide="info"></i> Como funciona o registro de doação?</h4>
        <div class="passos-fluxo">
            <div class="passo"><span class="passo-numero">1</span><span>Item é registrado aqui</span></div>
            <i data-lucide="arrow-right" class="seta-passo"></i>
            <div class="passo"><span class="passo-numero">2</span><span>Passa pela triagem</span></div>
            <i data-lucide="arrow-right" class="seta-passo"></i>
            <div class="passo"><span class="passo-numero">3</span><span>Entra no inventário</span></div>
            <i data-lucide="arrow-right" class="seta-passo"></i>
            <div class="passo"><span class="passo-numero">4</span><span>Disponível para retirada</span></div>
        </div>
    </div>

</div>

<script>
function atualizarPontos() {
    const select = document.getElementById('id_categoria');
    const qtd    = parseInt(document.getElementById('quantidade').value) || 0;
    const opcao  = select.options[select.selectedIndex];
    const pts    = parseInt(opcao?.dataset?.pontos || 0);
    const total  = pts * qtd;
    const preview = document.getElementById('preview-pontos');
    if (pts > 0 && qtd > 0) {
        document.getElementById('total-pontos').textContent = total;
        preview.style.display = 'flex';
    } else {
        preview.style.display = 'none';
    }
    if (typeof lucide !== 'undefined') lucide.createIcons();
}
function resetarPreview() {
    document.getElementById('preview-pontos').style.display = 'none';
}
document.addEventListener('DOMContentLoaded', atualizarPontos);
</script>