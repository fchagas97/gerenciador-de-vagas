<?php
class Shopping {
    public $id;
    public $nome;
    public $endereco;

    public function __construct($id, $nome, $endereco) {
        $this->id         = $id;
        $this->nome       = $nome;
        $this->endereco   = $endereco;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM shoppings");
        foreach($req->fetchAll() as $shopping) {
            $list[] = new Shopping($shopping['shopping_id'], $shopping['shopping_nome'], $shopping['shopping_endereco']);
        }
        return $list;
    }

    public static function insert($post) {
        $db  = Db::getInstance();
        $req = $db->prepare("INSERT INTO shoppings(shopping_nome, shopping_endereco) VALUES (:nome, :endereco)");
        $req->execute(array("nome"=>$post->nome, "endereco"=>$post->endereco));
    }

    public static function delete($id) {
        $db  = Db::getInstance();
        $id  = intval($id);
        
        $req = $db->prepare("DELETE FROM vagas WHERE shopping_id=:id");
        $req->execute(array("id"=>$id));

        $req = $db->prepare("DELETE FROM clientes WHERE shopping_id=:id");
        $req->execute(array("id"=>$id));

        $req = $db->prepare("DELETE FROM shoppings WHERE shopping_id=:id");
        $req->execute(array("id"=>$id));
        
    }

    public static function update($post) {
        $db  = Db::getInstance();
        $req = $db->prepare("UPDATE shoppings SET shopping_nome=:nome, shopping_endereco=:endereco WHERE shopping_id=:id");
        $req->execute(array("nome"=>$post->nome, "endereco"=>$post->endereco, "id"=>$post->id));
    }

    public static function find($id) {
        $db = Db::getInstance();

        $id = intval($id);
        $req = $db->prepare('SELECT * FROM shoppings WHERE shopping_id=:id');
        $req->execute(array('id' => $id));
        $shopping = $req->fetch();

        return new Shopping($shopping['shopping_id'], $shopping['shopping_nome'], $shopping['shopping_endereco']);
    }

    /* Exibe todas as vagas do shopping */
    public static function allLots($id) {
        $db = Db::getInstance();

        $id = intval($id);
        $req = $db->prepare('SELECT COUNT(*) AS total FROM vagas WHERE shopping_id=:id');
        $req->execute(array('id' => $id));
        $count = $req->fetch()['total'];
        
        return $count;
    }
}
?>