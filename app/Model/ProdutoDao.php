<?php
namespace App\Model;

class ProdutoDao extends ProdutoSql {
    /**
     * @param Produto $p
     * @return bool
     */
    public function create(Produto $p):bool
    {
        $sql = "INSERT INTO cep 
                      (cep, logradouro, complemento, bairro, localidade, uf, ibge, gia, ddd, siafi) 
                VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getCep());
        $stmt->bindValue(2, $p->getLogradouro());
        $stmt->bindValue(3, $p->getComplemento());
        $stmt->bindValue(4, $p->getBairro());
        $stmt->bindValue(5, $p->getLocalidade());
        $stmt->bindValue(6, $p->getUF());
        $stmt->bindValue(7, $p->getIbge());
        $stmt->bindValue(8, $p->getGia());
        $stmt->bindValue(9, $p->getDDD());
        $stmt->bindValue(10, $p->getSiafi());

        return $stmt->execute();
    }

    /**
     * @param string $param
     * @param string $where
     * @return array
     */
    public function read(string $param, string $where = ""):array
    {
        $resultado = [];
        $sql = parent::sqlCEP($param, $where);

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $resultado;
    }

    /**
     * @param Produto $p
     * @return bool
     */
    public function update(Produto $p):bool
    {
            $sql = "UPDATE cep
                     SET cep = ?, logradouro = ?, complemento = ?, bairro = ?, localidade = ?, uf = ?, ibge = ?, gia = ?, ddd = ?, siafi = ?
                    WHERE id = {$p->getID()}";
            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->bindValue(1, $p->getCep());
            $stmt->bindValue(2, $p->getLogradouro());
            $stmt->bindValue(3, $p->getComplemento());
            $stmt->bindValue(4, $p->getBairro());
            $stmt->bindValue(5, $p->getLocalidade());
            $stmt->bindValue(6, $p->getUF());
            $stmt->bindValue(7, $p->getIbge());
            $stmt->bindValue(8, $p->getGia());
            $stmt->bindValue(9, $p->getDDD());
            $stmt->bindValue(10, $p->getSiafi());

           return $stmt->execute();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id):bool
    {
        $sql = "DELETE FROM cep WHERE id = {$id}";

        $stmt = Conexao::getConn()->prepare($sql);
        return $stmt->execute();
    }
}