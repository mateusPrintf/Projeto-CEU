<? include_once('./index.php'); ?>

<?php 
require_once 'vendor/autoload.php';


use Dompdf\Dompdf;

$dsn = 'mysql:host=127.0.0.1;dbname=ceu';
$user = 'root';
$senha = '';


try {
	$conexao = new PDO($dsn, $user, $senha);
	
	$query = ' SELECT tb_usuario.nome AS usu_nome, tb_atividade.nome FROM tb_usuario INNER JOIN tb_inscricao_atividade INNER JOIN tb_atividade on 
	(tb_usuario.id = tb_inscricao_atividade.id_usuario AND tb_atividade.id = tb_inscricao_atividade.id_atividade) WHERE tb_inscricao_atividade.id_atividade = :id_atividade';

	$stmt = $conexao->prepare($query);
	$stmt->bindValue(':id_atividade', $_GET['id_atv']);
	$stmt->execute();

	$atividade = $stmt->fetchAll(); 

	foreach($atividade as $att);
	
	
} catch (PDOException $e) {
	echo 'Mensagem: '.$e->getMessage();
	
}


$html ='<h1> Relação de Inscritos: '.$att['nome'].' </h1>';
$html .= '<table border=1 width=100% >';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th scope="col" width=10% >#</th>';
$html .= '<th scope="col" width=40% >Nome</th>';
$html .= '<th scope="col" width=100% >Assinatura</th>';
$html .= '</tr>';
$html .= '</thead>';

$html .='<tbody>';
if (empty($atividade) == false) { 
	foreach($atividade as $id => $att) {
		$html .= '<tr>';
		$html .= '<th>'.$id.'</th>';
		$html .= '<td>'.$att['usu_nome'].'</td>';
		$html .= '<th scope="col"></th>';
	}	
} else { 
	
	$html .= '<th width=100%>';
	$html .= '<h2>Sem Inscrições.</h2>';
	$html .= '</th>';
};
$html .='</tbody>';	

$html .='</table>';


 $dompdf = new Dompdf;
//converter o html
$dompdf->loadHtml($html);

//definir tamanho e orientação
$dompdf-> setPaper('A4', 'portrait');

//renderizar o html
$dompdf->render();

//enviar para o browser

$dompdf->stream('relatorio.pdf', array('Attachment' =>false));