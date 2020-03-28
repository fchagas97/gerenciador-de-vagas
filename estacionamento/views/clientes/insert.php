<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i> Adicionar novo cliente
</h1>
<form action="index.php?controller=clientes&action=insert" method="post" class="p-4">
    <div class="form-group row">
        <label for="nome" class="col-sm-1 col-form-label font-weight-bold">Nome:</label>
        <div class="col-sm-11">
            <input type="text" name="nome" id="nome" value="" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="telefone" class="col-sm-1 col-form-label font-weight-bold">Telefone:</label>
        <div class="col-sm-11">
            <input type="text" name="telefone" id="telefone" value="" maxlength="11" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-1 col-form-label font-weight-bold">Email:</label>
        <div class="col-sm-11">
            <input type="text" name="email" id="email" value="" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="shopping" class="col-sm-1 col-form-label font-weight-bold">Shopping:</label>
        <div class="col-sm-11">
            <select name="shopping_id" id="shopping" class="form-control">
                <option value="0">Selecione um shopping</option>
<?php foreach ($shoppings as $shopping_id => $shopping_nome): ?>
                <option value="<?php echo $shopping_id; ?>"><?php echo $shopping_id . " - " . $shopping_nome; ?></option>
<?php endforeach; ?>
            </select>
        </div>
    </div>

    <input type="submit" name="submitted" value="Salvar" class="btn btn-primary">
</form>