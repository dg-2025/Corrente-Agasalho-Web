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
// FILTROS recebidos via GET
// ============================================================
$filtro_categoria = $_GET['categoria'] ?? '';
$filtro_tamanho   = $_GET['tamanho']   ?? '';
$filtro_condicao  = $_GET['condicao']  ?? '';
$filtro_busca     = trim($_GET['busca'] ?? '');

// ============================================================
// BUSCA DE CATEGORIAS para o filtro — tabela: param_categorias
// ============================================================
// $categorias = $pdo->query("
//     SELECT id_categoria, nome FROM param_categorias ORDER BY nome
// ")->fetchAll(PDO::FETCH_ASSOC);
// -------- DADOS FICTÍCIOS --------
$categorias = [
    ['id_categoria' => 1, 'nome' => 'Agasalho / Casaco'],
    ['id_categoria' => 2, 'nome' => 'Cobertor / Manta'],
    ['id_categoria' => 3, 'nome' => 'Calça'],
    ['id_categoria' => 4, 'nome' => 'Camiseta / Blusa'],
    ['id_categoria' => 5, 'nome' => 'Calçado'],
    ['id_categoria' => 6, 'nome' => 'Roupa Infantil'],
    ['id_categoria' => 7, 'nome' => 'Acessório (gorro/luva)'],
];

// ============================================================
// BUSCA DE TAMANHOS para o filtro — tabela: param_tamanhos
// ============================================================
// $tamanhos = $pdo->query("
//     SELECT id_tamanho, nome FROM param_tamanhos ORDER BY id_tamanho
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
// BUSCA DE CONDIÇÕES para o filtro — tabela: param_condicoes
// ============================================================
// $condicoes = $pdo->query("
//     SELECT id_condicao, nome FROM param_condicoes ORDER BY id_condicao
// ")->fetchAll(PDO::FETCH_ASSOC);
// -------- DADOS FICTÍCIOS --------
$condicoes = [
    ['id_condicao' => 1, 'nome' => 'Novo'],
    ['id_condicao' => 2, 'nome' => 'Ótimo'],
    ['id_condicao' => 3, 'nome' => 'Bom'],
    ['id_condicao' => 4, 'nome' => 'Aceitável'],
];

// ============================================================
// BUSCA DE ITENS DO ESTOQUE — tabelas: itens, param_categorias,
//   param_tamanhos, param_condicoes, param_status_triagem,
//   doacoes, pessoas
//
// Só exibe itens com status_triagem = 'Disponível' (triagem concluída)
// e quantidade_estoque > 0
// ============================================================
// $params = [];
// $where  = ["pst.nome = 'Disponível'", "i.quantidade_estoque > 0"];
//
// if ($filtro_categoria) { $where[] = "i.id_categoria = :categoria"; $params[':categoria'] = $filtro_categoria; }
// if ($filtro_tamanho)   { $where[] = "i.id_tamanho = :tamanho";     $params[':tamanho']   = $filtro_tamanho; }
// if ($filtro_condicao)  { $where[] = "i.id_condicao = :condicao";   $params[':condicao']  = $filtro_condicao; }
// if ($filtro_busca)     {
//     $where[] = "(pc.nome LIKE :busca OR p.nome LIKE :busca2)";
//     $params[':busca']  = "%$filtro_busca%";
//     $params[':busca2'] = "%$filtro_busca%";
// }
//
// $sql = "
//     SELECT
//         i.id_item,
//         pc2.nome        AS categoria,
//         pt.nome         AS tamanho,
//         pcond.nome      AS condicao,
//         p.nome          AS doador,
//         d.data_doacao   AS data_entrada,
//         i.quantidade_estoque
//     FROM itens i
//     JOIN param_categorias   pc2   ON i.id_categoria     = pc2.id_categoria
//     JOIN param_tamanhos     pt    ON i.id_tamanho        = pt.id_tamanho
//     JOIN param_condicoes    pcond ON i.id_condicao       = pcond.id_condicao
//     JOIN param_status_triagem pst ON i.id_status_triagem = pst.id_status
//     JOIN doacoes            d     ON i.id_doacao         = d.id_doacao
//     JOIN pessoas            p     ON d.id_pessoa         = p.id_pessoa
//     WHERE " . implode(' AND ', $where) . "
//     ORDER BY d.data_doacao DESC
// ";
// $stmt = $pdo->prepare($sql);
// $stmt->execute($params);
// $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
// // Contadores para os cards de resumo (com banco ativo):
// $total_disponiveis = $pdo->query("
//     SELECT COUNT(*) FROM itens i
//     JOIN param_status_triagem pst ON i.id_status_triagem = pst.id_status
//     WHERE pst.nome = 'Disponível' AND i.quantidade_estoque > 0
// ")->fetchColumn();
//
// $total_agasalhos = $pdo->query("
//     SELECT COUNT(*) FROM itens i
//     JOIN param_categorias pc ON i.id_categoria = pc.id_categoria
//     JOIN param_status_triagem pst ON i.id_status_triagem = pst.id_status
//     WHERE pst.nome = 'Disponível' AND pc.nome = 'Agasalho / Casaco' AND i.quantidade_estoque > 0
// ")->fetchColumn();
//
// $total_cobertores = $pdo->query("
//     SELECT COUNT(*) FROM itens i
//     JOIN param_categorias pc ON i.id_categoria = pc.id_categoria
//     JOIN param_status_triagem pst ON i.id_status_triagem = pst.id_status
//     WHERE pst.nome = 'Disponível' AND pc.nome = 'Cobertor / Manta' AND i.quantidade_estoque > 0
// ")->fetchColumn();
//
// $total_infantil = $pdo->query("
//     SELECT COUNT(*) FROM itens i
//     JOIN param_categorias pc ON i.id_categoria = pc.id_categoria
//     JOIN param_status_triagem pst ON i.id_status_triagem = pst.id_status
//     WHERE pst.nome = 'Disponível' AND pc.nome = 'Roupa Infantil' AND i.quantidade_estoque > 0
// ")->fetchColumn();
// ============================================================

// -------- DADOS FICTÍCIOS (remover quando banco estiver ativo) --------
$todos_itens = [
    ['id_item' => 1,  'categoria' => 'Agasalho / Casaco',     'tamanho' => 'M',       'condicao' => 'Ótimo',     'doador' => 'Ana Paula Silva',  'data_entrada' => '2026-05-10', 'quantidade_estoque' => 1],
    ['id_item' => 2,  'categoria' => 'Cobertor / Manta',      'tamanho' => 'Único',   'condicao' => 'Novo',      'doador' => 'Carlos Mendes',    'data_entrada' => '2026-05-11', 'quantidade_estoque' => 1],
    ['id_item' => 3,  'categoria' => 'Calça',                 'tamanho' => 'G',       'condicao' => 'Bom',       'doador' => 'Fernanda Costa',   'data_entrada' => '2026-05-12', 'quantidade_estoque' => 1],
    ['id_item' => 4,  'categoria' => 'Agasalho / Casaco',     'tamanho' => 'P',       'condicao' => 'Novo',      'doador' => 'João Roberto',     'data_entrada' => '2026-05-12', 'quantidade_estoque' => 1],
    ['id_item' => 5,  'categoria' => 'Roupa Infantil',        'tamanho' => 'Infantil','condicao' => 'Ótimo',     'doador' => 'Ana Paula Silva',  'data_entrada' => '2026-05-13', 'quantidade_estoque' => 1],
    ['id_item' => 6,  'categoria' => 'Calçado',               'tamanho' => 'M',       'condicao' => 'Aceitável', 'doador' => 'Carlos Mendes',    'data_entrada' => '2026-05-13', 'quantidade_estoque' => 1],
    ['id_item' => 7,  'categoria' => 'Camiseta / Blusa',      'tamanho' => 'GG',      'condicao' => 'Bom',       'doador' => 'Fernanda Costa',   'data_entrada' => '2026-05-14', 'quantidade_estoque' => 1],
    ['id_item' => 8,  'categoria' => 'Acessório (gorro/luva)','tamanho' => 'Único',   'condicao' => 'Novo',      'doador' => 'João Roberto',     'data_entrada' => '2026-05-14', 'quantidade_estoque' => 1],
    ['id_item' => 9,  'categoria' => 'Cobertor / Manta',      'tamanho' => 'Único',   'condicao' => 'Bom',       'doador' => 'Ana Paula Silva',  'data_entrada' => '2026-05-15', 'quantidade_estoque' => 1],
    ['id_item' => 10, 'categoria' => 'Agasalho / Casaco',     'tamanho' => 'GG',      'condicao' => 'Ótimo',     'doador' => 'Carlos Mendes',    'data_entrada' => '2026-05-15', 'quantidade_estoque' => 1],
];

// Aplica filtros nos dados fictícios
$itens = array_filter($todos_itens, function($item) use ($filtro_categoria, $filtro_tamanho, $filtro_condicao, $filtro_busca, $categorias, $tamanhos, $condicoes) {
    if ($filtro_categoria) {
        $nome_cat = '';
        foreach ($categorias as $c) { if ($c['id_categoria'] == $filtro_categoria) { $nome_cat = $c['nome']; break; } }
        if ($item['categoria'] !== $nome_cat) return false;
    }
    if ($filtro_tamanho) {
        $nome_tam = '';
        foreach ($tamanhos as $t) { if ($t['id_tamanho'] == $filtro_tamanho) { $nome_tam = $t['nome']; break; } }
        if ($item['tamanho'] !== $nome_tam) return false;
    }
    if ($filtro_condicao) {
        $nome_cond = '';
        foreach ($condicoes as $c) { if ($c['id_condicao'] == $filtro_condicao) { $nome_cond = $c['nome']; break; } }
        if ($item['condicao'] !== $nome_cond) return false;
    }
    if ($filtro_busca && stripos($item['categoria'] . $item['doador'], $filtro_busca) === false) return false;
    return true;
});

$total_disponiveis = count($todos_itens);
$total_agasalhos   = count(array_filter($todos_itens, fn($i) => $i['categoria'] === 'Agasalho / Casaco'));
$total_cobertores  = count(array_filter($todos_itens, fn($i) => $i['categoria'] === 'Cobertor / Manta'));
$total_infantil    = count(array_filter($todos_itens, fn($i) => $i['categoria'] === 'Roupa Infantil'));

// Mapa de cores por condição
$cores_condicao = [
    'Novo'      => 'badge-novo',
    'Ótimo'     => 'badge-otimo',
    'Bom'       => 'badge-bom',
    'Aceitável' => 'badge-aceitavel',
];
?>

<link rel="stylesheet" href="src/views/Inventario/style.css">

<div class="pagina-inventario">

    <div class="cabecalho-pagina">
        <div>
            <h2 class="titulo-pagina">
                <i data-lucide="search"></i>
                Consultar Inventário
            </h2>
            <p class="subtitulo-pagina">Itens disponíveis para retirada (triagem concluída)</p>
        </div>
        <div class="badge-total">
            <i data-lucide="package"></i>
            <strong><?php echo $total_disponiveis; ?></strong> itens disponíveis
        </div>
    </div>

    <!-- Cards de resumo -->
    <div class="cards-resumo">
        <div class="card-resumo">
            <i data-lucide="wind"></i>
            <div>
                <span class="card-resumo-numero"><?php echo $total_agasalhos; ?></span>
                <span class="card-resumo-label">Agasalhos</span>
            </div>
        </div>
        <div class="card-resumo">
            <i data-lucide="cloud-snow"></i>
            <div>
                <span class="card-resumo-numero"><?php echo $total_cobertores; ?></span>
                <span class="card-resumo-label">Cobertores</span>
            </div>
        </div>
        <div class="card-resumo">
            <i data-lucide="baby"></i>
            <div>
                <span class="card-resumo-numero"><?php echo $total_infantil; ?></span>
                <span class="card-resumo-label">Infantil</span>
            </div>
        </div>
        <div class="card-resumo card-resumo-total">
            <i data-lucide="layers"></i>
            <div>
                <span class="card-resumo-numero"><?php echo $total_disponiveis; ?></span>
                <span class="card-resumo-label">Total Geral</span>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card-filtros">
        <form method="GET" action="" class="form-filtros">
            <input type="hidden" name="tela" value="Inventario">

            <div class="filtro-grupo">
                <label class="filtro-label"><i data-lucide="search"></i> Buscar</label>
                <input type="text" name="busca" class="filtro-input"
                       placeholder="Categoria ou doador..."
                       value="<?php echo htmlspecialchars($filtro_busca); ?>">
            </div>

            <div class="filtro-grupo">
                <label class="filtro-label"><i data-lucide="tag"></i> Categoria</label>
                <select name="categoria" class="filtro-input">
                    <option value="">Todas</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['id_categoria']; ?>"
                            <?php echo $filtro_categoria == $cat['id_categoria'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filtro-grupo">
                <label class="filtro-label"><i data-lucide="maximize-2"></i> Tamanho</label>
                <select name="tamanho" class="filtro-input">
                    <option value="">Todos</option>
                    <?php foreach ($tamanhos as $tam): ?>
                        <option value="<?php echo $tam['id_tamanho']; ?>"
                            <?php echo $filtro_tamanho == $tam['id_tamanho'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($tam['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filtro-grupo">
                <label class="filtro-label"><i data-lucide="star"></i> Condição</label>
                <select name="condicao" class="filtro-input">
                    <option value="">Todas</option>
                    <?php foreach ($condicoes as $cond): ?>
                        <option value="<?php echo $cond['id_condicao']; ?>"
                            <?php echo $filtro_condicao == $cond['id_condicao'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cond['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filtro-botoes">
                <button type="submit" class="botao-filtrar">
                    <i data-lucide="filter"></i> Filtrar
                </button>
                <a href="index.php?tela=Inventario" class="botao-limpar-filtro">
                    <i data-lucide="x"></i> Limpar
                </a>
            </div>
        </form>
    </div>

    <!-- Resultado -->
    <div class="resultado-header">
        <span class="resultado-count">
            <?php echo count($itens); ?> item(ns) encontrado(s)
            <?php if ($filtro_categoria || $filtro_tamanho || $filtro_condicao || $filtro_busca): ?>
                <span class="filtro-ativo-label">· filtro ativo</span>
            <?php endif; ?>
        </span>
    </div>

    <!-- Tabela -->
    <?php if (empty($itens)): ?>
        <div class="estado-vazio">
            <i data-lucide="inbox"></i>
            <p>Nenhum item encontrado com os filtros selecionados.</p>
            <a href="index.php?tela=Inventario" class="botao-limpar-filtro">Limpar filtros</a>
        </div>
    <?php else: ?>
        <div class="tabela-wrapper">
            <table class="tabela-inventario">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Categoria</th>
                        <th>Tamanho</th>
                        <th>Condição</th>
                        <th>Qtd. Estoque</th>
                        <th>Doador</th>
                        <th>Data de Entrada</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itens as $item): ?>
                        <tr>
                            <td class="coluna-id">#<?php echo $item['id_item']; ?></td>
                            <td>
                                <div class="categoria-cell">
                                    <i data-lucide="package" class="icone-categoria"></i>
                                    <?php echo htmlspecialchars($item['categoria']); ?>
                                </div>
                            </td>
                            <td>
                                <span class="badge-tamanho"><?php echo htmlspecialchars($item['tamanho']); ?></span>
                            </td>
                            <td>
                                <span class="badge-condicao <?php echo $cores_condicao[$item['condicao']] ?? ''; ?>">
                                    <?php echo htmlspecialchars($item['condicao']); ?>
                                </span>
                            </td>
                            <td class="coluna-qtd">
                                <?php echo $item['quantidade_estoque']; ?>
                            </td>
                            <td class="coluna-doador">
                                <i data-lucide="user" class="icone-doador"></i>
                                <?php echo htmlspecialchars($item['doador']); ?>
                            </td>
                            <td class="coluna-data">
                                <?php echo date('d/m/Y', strtotime($item['data_entrada'])); ?>
                            </td>
                            <td>
                                <span class="badge-disponivel">
                                    <i data-lucide="check-circle"></i> Disponível
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>