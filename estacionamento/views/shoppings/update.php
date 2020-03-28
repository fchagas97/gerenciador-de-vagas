<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i> Atualizar shopping #<?php echo $shopping->id; ?>
</h1>
<form action="index.php?controller=shoppings&action=update" method="post" class="p-4">
    <input type="hidden" name="shopping_id" value="<?php echo $shopping->id; ?>">
    <div class="form-group row">
        <label for="nome" class="col-sm-1 col-form-label font-weight-bold">Nome:</label>
        <div class="col-sm-11">
            <input type="text" name="nome" id="nome" value="<?php echo $shopping->nome; ?>" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="endereco" class="col-sm-1 col-form-label font-weight-bold">Endereço:</label>
        <div class="col-sm-11">
            <textarea name="endereco" id="endereco" class="form-control" rows="3"><?php echo $shopping->endereco; ?></textarea>
        </div>
    </div>
    <input type="submit" name="submitted" class="btn btn-primary" value="Atualizar">
</form>