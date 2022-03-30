<?php
require '../../vendor/autoload.php';
$produto = new \App\Model\Produto();
$produtoDao = new \App\Model\ProdutoDao();

$erros = false;
$dados = array();
$dadoCEP = array();

$valForm = filter_input_array( INPUT_GET, FILTER_DEFAULT );

if($valForm['tipo'] == '01'){
    if($valForm['cep']){
        //Verifica se o CEP já está cadastrado
        $dados = $produtoDao->read("*", $valForm['cep']);
        if(count($dados) == 0){ //Busca o cep
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://viacep.com.br/ws/'.$valForm['cep'].'/json/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = json_decode(curl_exec($curl));

            if(!$response->erro && $response->cep){
                $produto->setCep($response->cep);
                $produto->setLogradouro($response->logradouro);
                $produto->setComplemento($response->complemento);
                $produto->setBairro($response->bairro);
                $produto->setLocalidade($response->localidade);
                $produto->setUF($response->uf);
                $produto->setIbge($response->ibge);
                $produto->setGia($response->gia);
                $produto->setDDD($response->ddd);
                $produto->setSiafi($response->siafi);

                if($produtoDao->create($produto) == true){
                    $dados = $produtoDao->read("*", $valForm['cep']);
                }else{
                    $erros = true;
                    $dadoCEP['atencao'] = utf8_encode("CEP Não localizado.");
                }
            }
        }
    }
}

if(!$erros){
    if(count($dados) > 0){
        foreach($dados as $key => $value){
            $dadoCEP['sucesso'][$key]['cep']         = $value['cep'];
            $dadoCEP['sucesso'][$key]['logradouro']  = utf8_encode($value['logradouro']);
            $dadoCEP['sucesso'][$key]['complemento'] = utf8_encode($value['complemento']);
            $dadoCEP['sucesso'][$key]['bairro']      = utf8_encode($value['bairro']);
            $dadoCEP['sucesso'][$key]['localidade']  = utf8_encode($value['localidade']);
            $dadoCEP['sucesso'][$key]['uf']          = utf8_encode($value['uf']);
        }
    }else{
        $dadoCEP['atencao'] = utf8_encode("CEP Não localizado.");
    }
}

echo json_encode($dadoCEP, true);
