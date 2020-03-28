<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i>
    Vagas em <?php echo $nomeShopping; ?> (<?php echo $totalVagas, ($totalVagas > 1 || $totalVagas == 0) ? ' vagas' : ' vaga'; ?>)
</h1>
<div class="p-4"><div class="table-responsive">
    <table class="table table-bordered table-hover mb-4">
        <thead class="thead-light">
            <tr>
                <th style="width:90px" class="text-center">Número</th>
                <th>Disponibilidade</th>
                <th>Modalidade</th>
                <th>Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
<?php
if (empty($vagas)) {
?>
            <td class="align-middle text-center" colspan="5">
                <a
                href="index.php?controller=vagas&action=insert&shopping_id=<?php echo $_GET['shopping_id']; ?>"
                class="btn btn-success">Adicionar nova vaga</a>
            </td>
<?php
} else {
    foreach ($vagas as $vaga) {
        if ($vaga->modalidade == "pcd") {
            $modalidade = "Pessoa com Deficiência (PCD)";
        } else {
            $modalidade = ucfirst($vaga->modalidade);
        }
?>
                <tr>
                    <td class="align-middle text-center"><?php echo $vaga->numero; ?></td>
                    <td class="align-middle"><?php echo ucfirst($vaga->disponibilidade); ?></td>
                    <td class="align-middle"><?php echo $modalidade; ?></td>
                    <td class="align-middle"><?php echo ($vaga->cliente_nome) != "" ? $vaga->cliente_nome : "Nenhum"; ?></td>
                    <td class="align-middle text-center">
                        <a
                        href="#"
                        data-href="index.php?controller=vagas&action=delete&shopping_id=<?php echo $_GET['shopping_id']; ?>&vaga_id=<?php echo $vaga->id; ?>"
                        class="action_delete badge badge-pill badge-danger p-2"
                        data-toggle="modal"
                        data-target="#confirm-delete">Apagar</a>
                        <a
                        href="index.php?controller=vagas&action=update&shopping_id=<?php echo $_GET['shopping_id']; ?>&vaga_id=<?php echo $vaga->id; ?>"
                        class="badge badge-pill badge-secondary p-2">Atualizar</a>
                    </td>
                </tr>
<?php
    }
}
?>
        </tbody>
    </table></div>

    <?php foreach ($vagas as $vaga): ?>
        <div
        class="vaga <?php echo $vaga->disponibilidade . ' ' . $vaga->modalidade; ?>"
        title="Vaga #<?php echo $vaga->numero; ?>">
            <span><?php echo $vaga->numero; ?></span>
        </div>
    <?php endforeach; ?>
</div>
