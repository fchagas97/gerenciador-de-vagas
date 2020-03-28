<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i> Adicionar nova vaga
</h1>
<form action="index.php?controller=vagas&action=insert&shopping_id=<?php echo $_GET["shopping_id"]; ?>" method="post" class="p-4">
    <div class="form-group row">
        <label for="numero" class="col-sm-2 col-form-label font-weight-bold">Número:</label>
        <div class="col-sm-10">
            <input type="text" name="numero" id="numero" value="" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="disponibilidade" class="col-sm-2 col-form-label font-weight-bold">Disponibilidade:</label>
        <div class="col-sm-10">
            <select name="disponibilidade" id="disponibilidade" class="form-control">
                <option value="desocupada" selected>Desocupada</option>
                <option value="ocupada" disabled>Ocupada</option>
            </select>
        </div>
    </div>

    <div class="form-group row"> 
        <label for="modalidade" class="col-sm-2 col-form-label font-weight-bold">Modalidade:</label>
        <div class="col-sm-10">
            <select name="modalidade" id="modalidade" class="form-control">
                <option value="livre" selected>Livre</option>
                <option value="idoso">Idoso</option>
                <option value="gestante">Gestante</option>
                <option value="pcd">PCD - Pessoa com Deficiência</option>
            </select>
        </div>
    </div>
		
	<input type="submit" name="submitted" value="Salvar" class="btn btn-primary">
</form>
