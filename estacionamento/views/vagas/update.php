<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i> Atualizar vaga #<?php echo $vaga->numero; ?>
</h1>
<form action="index.php?controller=vagas&action=update&shopping_id=<?php echo $_GET["shopping_id"]; ?>" method="post" class="p-4">
    <input type="hidden" name="vaga_id" value="<?php echo $vaga->id; ?>">
    <div class="form-group row">
        <label for="numero" class="col-sm-2 col-form-label font-weight-bold">Número:</label>
        <div class="col-sm-10">
            <input type="text" name="numero" id="numero" value="<?php echo $vaga->numero; ?>" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="disponibilidade" class="col-sm-2 col-form-label font-weight-bold">Disponibilidade:</label>
        <div class="col-sm-10">
            <select name="disponibilidade" id="disponibilidade" class="form-control">
<?php
if (empty($clientes)) {
?>
                <option value="desocupada" selected>Desocupada</option>
                <option value="ocupada" disabled>Ocupada</option>
<?php
} else {
    $vals = array('desocupada', 'ocupada');
    foreach ($vals as $val) {
        $txt = ucfirst($val);
        if ($val == $vaga->disponibilidade) {
?>
                <option value="<?php echo $val; ?>" selected><?php echo $txt; ?></option>
<?php
        } else {
?>
                <option value="<?php echo $val; ?>"><?php echo $txt; ?></option>
<?php
        }
    }
}
?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="modalidade" class="col-sm-2 col-form-label font-weight-bold">Modalidade:</label>
        <div class="col-sm-10">
            <select name="modalidade" id="modalidade" class="form-control">
<?php
$vals = array('livre', 'idoso', 'gestante', 'pcd');
foreach ($vals as $val) {
    $txt = ($val == 'pcd') ? 'PCD - Pessoa com Deficiência' : ucfirst($val);
    if ($val == $vaga->modalidade) {
?>
                <option value="<?php echo $val; ?>" selected><?php echo $txt; ?></option>
<?php } else { ?>
                <option value="<?php echo $val; ?>"><?php echo $txt; ?></option>
<?php
    }
}
?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="cliente" class="col-sm-2 col-form-label font-weight-bold">Cliente:</label>
        <div class="col-sm-10">
<?php if (empty($clientes)) { ?>
            <select name="cliente_id" id="cliente" class="form-control">
<?php if (intval($vaga->cliente_id) != 0) { ?>
                <option value="0">Selecione um cliente</option>
                <option value="<?php echo $vaga->cliente_id; ?>" selected><?php echo $cliente_nome; ?></option>
                <option value="0">Nenhum</option>
<?php } else { ?>
                <option value="0" selected>Nenhum cliente disponível</option>
<?php } ?>
            </select>
        </div>
<?php } else { ?>
            <select name="cliente_id" id="cliente" class="form-control">
                <option value="0">Selecione um cliente</option>
<?php if (intval($vaga->cliente_id) != 0) { ?>
                <option value="<?php echo $vaga->cliente_id; ?>" selected><?php echo $cliente_nome; ?></option>
<?php } ?>
<?php foreach ($clientes as $cliente_id => $cliente_nome): ?>
                <option value="<?php echo $cliente_id; ?>"><?php echo $cliente_nome; ?></option>
<?php endforeach; ?>
                <option value="0">Nenhum</option>
            </select>
        </div>
<?php } ?>
    </div>

    <input type="submit" name="submitted" class="btn btn-primary" value="Atualizar">
</form>