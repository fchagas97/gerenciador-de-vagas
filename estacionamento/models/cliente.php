<?php
class Cliente {
    public $id;
    public $nome;
    public $telefone;
    public $email;
    public $shopping_id;

    public function __construct($id, $nome, $telefone, $email, $shopping_id) {
        $this->id           = $id;
        $this->nome         = $nome;
        $this->telefone     = $telefone;
        $this->email        = $email;
        $this->shopping_id  = $shopping_id;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT clientes.*, shoppings.shopping_nome FROM clientes, shoppings WHERE clientes.shopping_id = shoppings.shopping_id");
        foreach($req->fetchAll() as $key => $cliente) {
            $list[$key] = new Cliente($cliente['cliente_id'], $cliente['cliente_nome'], $cliente['cliente_telefone'], $cliente['cliente_email'], $cliente['shopping_id']);
            $list[$key]->shopping_nome = $cliente['shopping_nome'];
        }
        return $list;
    }

    public static function insert($post) {
        $db  = Db::getInstance();
        $req = $db->prepare("INSERT INTO clientes(cliente_nome, cliente_telefone, cliente_email, shopping_id) VALUES (:nome, :telefone, :email, :shopping_id)");
        $req->execute(array("nome"=>$post->nome, "telefone"=>$post->telefone, "email"=>$post->email, "shopping_id"=>$post->shopping_id));
    }

    public static function delete($id) {
        $db  = Db::getInstance();
        $id  = intval($id);

        $req = $db->prepare("UPDATE vagas SET vaga_disponibilidade='desocupada' WHERE vagas.cliente_id=:id");
        $req->execute(array("id"=>$id));

        $req = $db->prepare("DELETE FROM clientes WHERE cliente_id=:id");
        $req->execute(array("id"=>$id));
    }

    public static function update($post) {
        $db = Db::getInstance();

        $req = $db->prepare("UPDATE vagas SET vaga_disponibilidade='desocupada', cliente_id=NULL WHERE cliente_id=:id AND shopping_id<>:shopping_id");
        $req->execute(array("id"=>$post->id, "shopping_id"=>$post->shopping_id));

        $req = $db->prepare("UPDATE clientes SET cliente_nome=:nome, cliente_telefone=:telefone, cliente_email=:email, shopping_id=:shopping_id WHERE cliente_id=:id");
        $req->execute(array("nome"=>$post->nome, "telefone"=>$post->telefone, "email"=>$post->email, "id"=>$post->id, "shopping_id"=>$post->shopping_id));
    }

    public static function find($id) {
        $db = Db::getInstance();

        $id = intval($id);
        $req = $db->prepare('SELECT * FROM clientes WHERE cliente_id=:id');
        $req->execute(array('id' => $id));
        $cliente = $req->fetch();

        return new Cliente($cliente['cliente_id'], $cliente['cliente_nome'], $cliente['cliente_telefone'], $cliente['cliente_email'], $cliente['shopping_id']);
    }

    /* Exibe todos os shoppings */
    public static function allShoppings() {
        $list = [];
        $db = Db::getInstance();

        $req = $db->query("SELECT shopping_id, shopping_nome FROM shoppings");
        foreach ($req->fetchAll() as $shopping) {
            $list[$shopping["shopping_id"]] = $shopping["shopping_nome"];
        }
        return $list;
    }
}
