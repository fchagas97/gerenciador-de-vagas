<?php
class VagasController {
    public function show() {
        if (isset($_GET["shopping_id"]) && !empty($_GET["shopping_id"])) {
            $id = $_GET["shopping_id"];
            $nomeShopping = Vaga::shoppingName($id);
            $totalVagas = Vaga::totalOf($id);
            $vagas = Vaga::all($id);
            require_once("views/vagas/show.php");
        } else {
            header("Location: index.php");
        }
    }

    public function insert() {
        if (isset($_GET["shopping_id"]) && !empty($_GET["shopping_id"])) {
            if (isset($_POST["submitted"])) {
                Vaga::insert(new Vaga(0, $_POST["numero"], $_POST["disponibilidade"], $_POST["modalidade"], NULL, $_GET["shopping_id"]));
                header("Location: index.php?controller=vagas&action=show&shopping_id=" . $_GET["shopping_id"]);
            } else {
                $clientes = Vaga::allClients($_GET["shopping_id"]);
                require_once("views/vagas/insert.php");
            }
        } else {
            header("Location: index.php");
        }
    }

    public function delete() {
        $vaga_id     = $_GET["vaga_id"];
        $shopping_id = $_GET["shopping_id"];
        Vaga::delete($vaga_id);
        header("Location: index.php?controller=vagas&action=show&shopping_id=" . $shopping_id);
    }

    public function update() {
        if (isset($_GET["shopping_id"])) {
            if (isset($_POST["submitted"])) {
                $cliente = intval($_POST["cliente_id"]);
                if ($cliente == 0) {
                    $disponibilidade = "desocupada";
                } else {
                    $disponibilidade = "ocupada";
                }
                Vaga::update(new Vaga($_POST["vaga_id"], $_POST["numero"], $disponibilidade, $_POST["modalidade"], $cliente, $_GET["shopping_id"]));
                header("Location: index.php?controller=vagas&action=show&shopping_id=" . $_GET["shopping_id"]);
            } else if (isset($_GET["vaga_id"]) && !empty($_GET["vaga_id"])) {
                $vaga = Vaga::find($_GET["vaga_id"]);
                $clientes = Vaga::allClients($_GET["shopping_id"]);
                $cliente_nome = Vaga::clientName($_GET["vaga_id"]);
                require_once("views/vagas/update.php");
            } else {
                header("Location: index.php?controller=vagas&action=show&shopping_id=" . $_GET["shopping_id"]);
            }
        } else {
            header("Location: index.php");
        }
    }
}
