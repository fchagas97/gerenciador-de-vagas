<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i> Adicionar novo shopping
</h1>
<form action="index.php?controller=shoppings&action=insert" method="post" class="p-4">
    <div class="form-group row">
        <label for="nome" class="col-sm-1 col-form-label font-weight-bold">Nome:</label>
        <div class="col-sm-11">
            <input type="text" name="nome" id="nome" value="" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="endereco" class="col-sm-1 col-form-label font-weight-bold">Endereço:</label>
        <div class="col-sm-11">
            <textarea name="endereco" id="endereco" rows="3" class="form-control"></textarea>
        </div>
    </div>
    <input type="submit" name="submitted" value="Adicionar" class="btn btn-primary">
</form>