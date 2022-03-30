<?php
namespace App\Model;

class ProdutoSql{
    /**
     * @param string $param
     * @param string $where
     * @return string
     */
    public function sqlCEP(string $param, string $where)
    {
        $where = ($where != "") ? "and cep = '{$where}'" : "";

        $Qry = "SELECT {$param} FROM cep where 1 = 1 $where order by id";

        return $Qry;
    }
}
