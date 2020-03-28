<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i> Visualizar clientes
</h1>
<div class="p-4"><div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead class="thead-light">
			<tr>
				<th>Nome</th>
				<th>Telefone</th>
				<th>Email</th>
				<th>Shopping</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
<?php foreach ($clientes as $cliente): ?>
			<tr>
				<td class="align-middle"><?php echo $cliente->nome; ?></td>
				<td class="align-middle"><?php echo $cliente->telefone; ?></td>
				<td class="align-middle"><?php echo $cliente->email; ?></td>
				<td class="align-middle"><?php echo $cliente->shopping_id . " - " . $cliente->shopping_nome; ?></td>
				<td class="align-middle text-center">
                    <a
                    href="#"
                    data-href="index.php?controller=clientes&action=delete&cliente_id=<?php echo $cliente->id; ?>"
                    class="action_delete badge badge-pill badge-danger p-2"
                    data-toggle="modal"
                    data-target="#confirm-delete">Apagar</a>
                    <a
                    href="index.php?controller=clientes&action=update&cliente_id=<?php echo $cliente->id; ?>"
                    class="badge badge-pill badge-secondary p-2">Atualizar</a>
				</td>
			</tr>
<?php endforeach; ?>
		</tbody>
    </table>
</div></div>