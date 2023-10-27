<?php


include_once __DIR__ . '/../database/conexao.php';


class  VagaDAO
{
    private $dbh;

    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    public function getAll()
    {
        $query = "SELECT * FROM techjobsdb.vaga";
        $stmt = $this->dbh->query($query);
        $rows = $stmt->fetchAll();
        $this->dbh = null;
        return $rows;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM techjobsdb.vaga WHERE id = :id;";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_BOTH);


        $this->dbh = null;
        return $row;
    }

    public function insert($nome, $tipo, $descricao, $salario, $carga_horaria, $data_publicacao, $data_expiracao)
    {

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $salario = filter_input(INPUT_POST, 'salario', FILTER_SANITIZE_SPECIAL_CHARS);
        $carga_horaria = filter_input(INPUT_POST, 'carga_horaria', FILTER_SANITIZE_SPECIAL_CHARS);
        $data_publicacao = filter_input(INPUT_POST, 'data_publicacao', FILTER_SANITIZE_SPECIAL_CHARS);
        $data_expiracao = filter_input(INPUT_POST, 'data_expiracao', FILTER_SANITIZE_SPECIAL_CHARS);
        $query = "INSERT INTO techjobsdb.vaga
         (nome, tipo, descricao, salario, carga_horaria, data_publicacao, data_expiracao) 
VALUES (:nome, :tipo, :descricao, :salario, :carga_horaria, :data_publicacao, :data_expiracao);";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":salario", $salario);
        $stmt->bindParam(":carga_horaria", $carga_horaria);
        $stmt->bindParam(":data_publicacao", $data_publicacao);
        $stmt->bindParam(":data_expiracao", $data_expiracao);

        $result = $stmt->execute();
        $this->dbh = null;

        return $result;
    }


    public function update($id, $nome, $tipo, $descricao, $salario, $carga_horaria, $data_publicacao, $data_expiracao): int
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) ?? 0;
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $salario = filter_input(INPUT_POST, 'salario', FILTER_SANITIZE_SPECIAL_CHARS);
        $carga_horaria = filter_input(INPUT_POST, 'carga_horaria', FILTER_SANITIZE_SPECIAL_CHARS);
        $data_publicacao = filter_input(INPUT_POST, 'data_publicacao', FILTER_SANITIZE_SPECIAL_CHARS);
        $data_expiracao = filter_input(INPUT_POST, 'data_expiracao', FILTER_SANITIZE_SPECIAL_CHARS);

        $query = "UPDATE techjobsdb.vaga 
        SET nome = :nome, tipo = :tipo, descricao = :descricao, salario = :salario,
         carga_horaria = :carga_horaria, data_publicacao = :data_publicacao,
          data_expiracao = :data_expiracao WHERE id = :id;";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":salario", $salario);
        $stmt->bindParam(":carga_horaria", $carga_horaria);
        $stmt->bindParam(":data_publicacao", $data_publicacao);
        $stmt->bindParam(":data_expiracao", $data_expiracao);
        $result = $stmt->execute();
        $this->dbh = null;

        return $result;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM techjobsdb.vaga WHERE id = :id";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(":id", $id);

        $result = $stmt->execute();
        $result = $stmt->rowCount();
        $this->dbh = null;
        return $result;
    }
}
