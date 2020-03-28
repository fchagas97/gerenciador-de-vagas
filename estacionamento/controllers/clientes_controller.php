<?php
class ClientesController {
    public function show() {
        $clientes = Cliente::all();
        require_once("views/clientes/show.php");
    }
    public function insert() {
        if (isset($_POST["submitted"])) {
            $nome     = sanitize($_POST["nome"]);
            $telefone = sanitize($_POST["telefone"]);
            $email    = sanitize($_POST["email"]);

            Cliente::insert(new Cliente(0, $nome, $telefone, $email, $_POST["shopping_id"]));
            header("Location: index.php?controller=clientes&action=show");
        } else {
            $shoppings = Cliente::allShoppings();
            require_once("views/clientes/insert.php");
        }
    }
    public function delete() {
        Cliente::delete($_GET["cliente_id"]);
        header("Location: index.php?controller=clientes&action=show");
    }
    public function update() {
        if (isset($_POST["submitted"])) {
            $nome     = sanitize($_POST["nome"]);
            $telefone = sanitize($_POST["telefone"]);
            $email    = sanitize($_POST["email"]);
            
            Cliente::update(new Cliente($_POST['cliente_id'], $nome, $telefone, $email, $_POST["shopping_id"]));
            header("Location: index.php?controller=clientes&action=show");
        } else {
            $cliente = Cliente::find($_GET["cliente_id"]);
            $shoppings = Cliente::allShoppings();
            require_once("views/clientes/update.php");
        }
    }
}
?>