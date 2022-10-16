<?php
session_start();
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';

$productos=ejecutarSQL::consultar("SELECT * FROM cliente ");

class PDF extends FPDF{

}


$pdf=new PDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(0,255,255);
$pdf->Cell (0,25,utf8_decode(''),1,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(0,255,255);
$pdf->Cell (196,10,utf8_decode('Listado de Clientes'),1,1,'C');
$pdf->Image('logochico.png',70,10,-100);
$pdf->Ln(9);
$pdf->Cell (20,-5,utf8_decode('Codigo Cliente'),1,1,'L');
$pdf->Cell (80,5,utf8_decode('Nombre'),1,1,'C');
$pdf->Cell (130,-5,utf8_decode('Apellido'),1,1,'C');
$pdf->Cell (207,5,utf8_decode('Direccion'),1,1,'C');
$pdf->Cell (300,-5,utf8_decode('Mail'),1,1,'C');
$pdf->Cell (390,5,utf8_decode('Telefono'),1,1,'C');
$pdf->Ln(5);

$sDet=ejecutarSQL::consultar("SELECT c.NIT, c.NombreCompleto,c.Apellido, c.Direccion, c.Email, c.Telefono FROM cliente c");
while($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)){
    $consulta=ejecutarSQL::consultar("SELECT * FROM cliente WHERE NIT='".$fila1['NIT']."'");
    $fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $pdf->Cell (20,8,utf8_decode($fila['NIT']),1,0,'C');
    $pdf->Cell (30,8,utf8_decode($fila1['NombreCompleto']),1,0,'C');
    $pdf->Cell (30,8,utf8_decode($fila1['Apellido']),1,0,'C');
    $pdf->Cell (45,8,utf8_decode($fila1['Direccion']),1,0,'C');
    $pdf->Cell (45,8,utf8_decode($fila1['Email']),1,0,'C');
    $pdf->Cell (45,8,utf8_decode($fila1['Telefono']),1,0,'C');
  
    $pdf->Ln(10);

    mysqli_free_result($consulta);
}

$pdf->Output();