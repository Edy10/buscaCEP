<?php
namespace App\Model;

class Produto{
    private $id, $cep, $logradouro, $complemento, $bairro, $localidade, $uf, $ibge, $gia, $ddd, $siafi;
    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    public function getCep(){
        return $this->cep;
    }
    public function setCep($cep){
        $this->cep = $cep;
    }

    public function getLogradouro(){
        return $this->logradouro;
    }
    public function setLogradouro($logradouro){
        $this->logradouro = $logradouro;
    }

    public function getComplemento(){
        return $this->complemento;
    }
    public function setComplemento($complemento){
        $this->complemento = $complemento;
    }

    public function getBairro(){
        return $this->bairro;
    }
    public function setBairro($bairro){
        $this->bairro = $bairro;
    }

    public function getLocalidade(){
        return $this->localidade;
    }
    public function setLocalidade($localidade){
        $this->localidade = $localidade;
    }

    public function getUF(){
        return $this->uf;
    }
    public function setUF($uf){
        $this->uf = $uf;
    }

    public function getIbge(){
        return $this->ibge;
    }
    public function setIbge($ibge){
        $this->ibge = $ibge;
    }

    public function getGia(){
        return $this->gia;
    }
    public function setGia($gia){
        $this->gia = $gia;
    }

    public function getDDD(){
        return $this->ddd;
    }
    public function setDDD($ddd){
        $this->ddd = $ddd;
    }

    public function getSiafi(){
        return $this->siafi;
    }
    public function setSiafi($siafi){
        $this->siafi = $siafi;
    }

}