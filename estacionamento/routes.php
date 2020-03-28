<?php
function call($controller, $action) {
	require_once("controllers/" . $controller . "_controller.php");
	switch ($controller) {
		case 'shoppings':
			require_once("models/shopping.php");
			$controller = new ShoppingsController();
			break;
		case 'vagas':
			require_once("models/vaga.php");
			$controller = new VagasController();
			break;
		case 'clientes':
			require_once("models/cliente.php");
			$controller = new ClientesController();
			break;
	}
	$controller->{$action}();
}
call($controller, $action);
?>