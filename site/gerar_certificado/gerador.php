<?php
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
require('fpdf/alphapdf.php');
require('PHPMailer/class.phpmailer.php');

$dsn = 'mysql:host=localhost;dbname=ceu';
$user = 'root';
$senha = '';

try {
    $conexao = new PDO($dsn, $user, $senha);
    
    $query = '
    SELECT tb_usuario.nome, tb_atividade.nome as atv_nome, tb_atividade.tipo,tb_atividade.carga_hr, 
    tb_atividade.data_inicio,tb_atividade.data_fim FROM tb_atividade INNER JOIN tb_usuario ON (tb_usuario.id = tb_atividade.id)
    ';

    $stmt = $conexao->prepare($query);
    $stmt->execute();

    $lista_usuario = $stmt->fetchAll();
    
    
    foreach ($lista_usuario as $key => $value);
 

} catch (PDOException $e) {
    echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
   
}

$email    = "juniorxy29@hotmail.com";
$nome     = utf8_decode($value['nome']);

$empresa  = "CENTRAL DE EVENTOS UESPI";
$curso    = $value['atv_nome'];
$data_i     = $value['data_inicio'];
$data_f    = $value['data_fim'];
$carga_h  = $value['carga_hr'];


$texto1 = utf8_decode($empresa);
$texto2 = utf8_decode("pela participação na ".$curso." \n realizado de ".$data_i." à ".$data_f." com carga horária total de ".$carga_h." horas/aula.");
$texto3 = utf8_decode("Piauí, ".utf8_encode(strftime( '%d de %B de %Y', strtotime( date( 'Y-m-d' ) ) )));


$pdf = new AlphaPDF();


$pdf->AddPage('L');

$pdf->SetLineWidth(1.5);



$pdf->Image('certificado.jpg',0,0,295);


$pdf->SetAlpha(1);


$pdf->SetFont('Arial', '', 15); 
$pdf->SetXY(109,46); 
$pdf->MultiCell(265, 10, $texto1, '', 'L', 0); 


$pdf->SetFont('Arial', '', 30);
$pdf->SetXY(20,86); 
$pdf->MultiCell(265, 10, $nome, '', 'C', 0); 


$pdf->SetFont('Arial', '', 15); 
$pdf->SetXY(20,110); 
$pdf->MultiCell(265, 10, $texto2, '', 'C', 0); 


$pdf->SetFont('Arial', '', 15); 
$pdf->SetXY(205,175); 
$pdf->MultiCell(165, 10, $texto3, '', 'L', 0);

$pdfdoc = $pdf->Output('', 'S');



$subject = 'Seu Certificado do Workshop';
$messageBody = "Olá $nome<br><br>É com grande prazer que entregamos o seu certificado.<br>Ele está em anexo nesse e-mail.<br><br>Atenciosamente,<br>Lincoln Borges<br><a href='http://www.lnborges.com.br'>http://www.lnborges.com.br</a>";


$mail = new PHPMailer();
$mail->SetFrom("centraldeeventosuespi@gmail.com", "Certificado");
$mail->Subject    = $subject;
$mail->MsgHTML(utf8_decode($messageBody));
$mail->AddAddress("centraldeeventosuespi@gmail.com"); 
$mail->addStringAttachment($pdfdoc, 'certificado.pdf');
$mail->Send();

$certificado="arquivos/$nome.pdf"; 
$pdf->Output($certificado,'F'); 

$pdf->Output(); 

?>