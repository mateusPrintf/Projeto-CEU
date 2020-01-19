<?php

include_once "../../service/conexao.php";

try {
   
    $conexao = new Conexao();
    
    $query = '
    SELECT tb_atividade.nome as atv_nome, tb_atividade.valor FROM tb_atividade
    WHERE tb_atividade.id = :id_atividade
    ';

    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id_atividade', $_GET['id_atv']);
    $stmt->execute();

    $atividades = $stmt->fetchAll();
    
    foreach ($atividades as $key => $value);
 
} catch (PDOException $e) {
    echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
   
}

$nome = $value['atv_nome'];
$valor = $value['valor'].'.00';

$data['token'] ='e9e956c5-1102-4679-9013-4629a03d4fe1f293e9544834b4db0bb7d3cb3ef2441b4bf5-0183-4a74-b079-66d7282ed14a';
$data['email'] = 'juniorplay1288@gmail.com';
$data['currency'] = 'BRL';
$data['itemId1'] = '1';
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = "$nome";
$data['itemAmount1'] = "$valor";

$url = 'https://ws.pagseguro.uol.com.br/v2/checkout';
//$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml= curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($xml);

$codigo = $xml->code;

//echo($codigo);

?>