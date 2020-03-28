<?php
class Vaga {
    public $id;
    public $numero;
    public $disponibilidade;
    public $modalidade;
    public $cliente_id;
    public $shopping_id;

    public function __construct($id, $numero, $disponibilidade, $modalidade, $cliente_id, $shopping_id) {
        $this->id              = $id;
        $this->numero          = $numero;
        $this->disponibilidade = $disponibilidade;
        $this->modalidade      = $modalidade;
        $this->cliente_id      = $cliente_id;
        $this->shopping_id     = $shopping_id;
    }

    public static function all($id) {
        $list = [];
        $db = Db::getInstance();

        $id = intval($id);
        $req = $db->prepare("SELECT vagas.*, clientes.cliente_nome FROM vagas LEFT JOIN clientes ON vagas.cliente_id = clientes.cliente_id WHERE vagas.shopping_id=:id ORDER BY vagas.vaga_numero ASC");
        $req->execute(array("id" => $id));
        foreach ($req->fetchAll() as $key => $vaga) {
            $list[$key] = new Vaga($vaga["vaga_id"], $vaga["vaga_numero"], $vaga["vaga_disponibilidade"], $vaga["vaga_modalidade"], $vaga["cliente_id"], $vaga["shopping_id"]);
            $list[$key]->cliente_nome = $vaga['cliente_nome'];
        }
        return $list;
    }

    public static function insert($post) {
        $db  = Db::getInstance();
        $req = $db->prepare("INSERT INTO vagas(vaga_numero, vaga_disponibilidade, vaga_modalidade, cliente_id, shopping_id) VALUES (:numero, :disponibilidade, :modalidade, :cliente_id, :shopping_id)");
        $req->execute(array("numero" => $post->numero, "disponibilidade" => $post->disponibilidade, "modalidade" => $post->modalidade, "cliente_id" => $post->cliente_id, "shopping_id" => $post->shopping_id));
    }

    public static function delete($id) {
        $db  = Db::getInstance();
        $id  = intval($id);

        $req = $db->prepare("DELETE FROM vagas WHERE vagas.vaga_id=:id");
        $req->execute(array("id" => $id));
    }

    public static function update($post) {
        $db  = Db::getInstance();
        $req = $db->prepare("UPDATE vagas SET vaga_numero=:numero, vaga_disponibilidade=:disponibilidade, vaga_modalidade=:modalidade, cliente_id=:cliente_id, shopping_id=:shopping_id WHERE vaga_id=:id");
        $req->execute(array("numero" => $post->numero, "disponibilidade" => $post->disponibilidade, "modalidade" => $post->modalidade, "cliente_id" => $post->cliente_id, "shopping_id" => $post->shopping_id, "id" => $post->id));
    }

    public static function find($id) {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare("SELECT * FROM vagas WHERE vagas.vaga_id=:id");
        $req->execute(array("id" => $id));
        $vaga = $req->fetch();

        return new Vaga($vaga["vaga_id"], $vaga["vaga_numero"], $vaga["vaga_disponibilidade"], $vaga["vaga_modalidade"], $vaga["cliente_id"], $vaga["shopping_id"]);
    }

    /* Exibe o nome do shopping ao qual as vagas pertencem */
    public static function shoppingName($id) {
        $db   = Db::getInstance();
        $id   = intval($id);
        $req  = $db->prepare("SELECT shoppings.shopping_nome AS nome FROM shoppings WHERE shoppings.shopping_id=:id");
        $req->execute(array("id" => $id));
        $name = $req->fetch()['nome'];

        return $name;
    }

    /* Exibe o total de vagas do shopping especificado */
    public static function totalOf($id) {
        $db   = Db::getInstance();
        $id   = intval($id);
        $req  = $db->prepare("SELECT COUNT(*) AS total FROM vagas WHERE vagas.shopping_id=:id");
        $req->execute(array("id" => $id));
        $total = $req->fetch()['total'];

        return $total;
    }

    /* Exibe todos os clientes do shopping */
    public static function allClients($id) {
        $list = [];
        $db = Db::getInstance();

        $id = intval($id);
        $req = $db->prepare("SELECT clientes.cliente_id, clientes.cliente_nome FROM clientes LEFT JOIN vagas ON clientes.cliente_id=vagas.cliente_id WHERE vagas.cliente_id IS NULL AND clientes.shopping_id=:id ORDER BY clientes.cliente_nome ASC");
        $req->execute(array("id" => $id));
        foreach ($req->fetchAll() as $cliente) {
            $list[$cliente["cliente_id"]] = $cliente["cliente_nome"];
        }
        return $list;
    }

    /* Exibe o nome do cliente ocupante da vaga */
    public static function clientName($id) {
        $db  = Db::getInstance();
        $id  = intval($id);
        $req = $db->prepare("SELECT clientes.cliente_nome AS nome FROM clientes LEFT JOIN vagas ON clientes.cliente_id=vagas.cliente_id WHERE vagas.vaga_id=:id");
        $req->execute(array("id" => $id));
        $name = $req->fetch()['nome'];

        return $name;
    }
}
