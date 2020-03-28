<?php
class ShoppingsController {
    public function show() {
        $shoppings  = Shopping::all();
        $totalVagas = "Shopping::allLots";
        require_once("views/shoppings/show.php");
    }
    public function insert() {
        if (isset($_POST["submitted"])) {
            $nome = sanitize($_POST["nome"]);
            $endereco = sanitize($_POST["endereco"]);
            Shopping::insert(new Shopping(0, $nome, $endereco));
            header("Location: index.php");
        } else {
            require_once("views/shoppings/insert.php");
        }
    }
    public function delete() {
        Shopping::delete($_GET["shopping_id"]);
        header("Location: index.php");
    }
    public function update() {
        if (isset($_POST["shopping_id"])) {
            $id = intval($_POST["shopping_id"]);
            $nome = sanitize($_POST["nome"]);
            $endereco = sanitize($_POST["endereco"]);
            Shopping::update(new Shopping($id, $nome, $endereco));
            header("Location: index.php");
        } else if (isset($_GET["shopping_id"]) && !empty($_GET["shopping_id"])) {
            $shopping = Shopping::find($_GET["shopping_id"]);
            require_once("views/shoppings/update.php");
        } else {
            header("Location: index.php");
        }
    }
}
