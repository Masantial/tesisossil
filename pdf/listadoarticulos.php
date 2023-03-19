<?php
session_start();
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';

$productos=ejecutarSQL::consultar("SELECT * FROM producto");

class PDF extends FPDF{

}


$pdf=new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(0,255,255);
$pdf->Ln(11);
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(0,255,255);
$pdf->Cell (0,10,utf8_decode('Listado de Productos'),1,1,'C');
$pdf->Image('encabezado.png',-1,2,-80);
$pdf->Ln(9);
$pdf->Cell (45,5,utf8_decode('Codigo Prodcuto'),1,1,'C');
$pdf->Cell (125,-5,utf8_decode('Descripcion'),1,1,'C');
$pdf->Cell (280,5,utf8_decode('Precio'),1,1,'C');
$pdf->Cell (330,-5,utf8_decode('Costo'),1,1,'C');
$pdf->Cell (384,5,utf8_decode('Stock'),1,1,'C');
$pdf->Ln(8);
$sDet=ejecutarSQL::consultar("SELECT p.CodigoProd, p.NombreProd, p.Precio, p.Costo, p.Stock FROM producto p");
while($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)){
    $consulta=ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$fila1['CodigoProd']."'");
    $fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $pdf->Cell (45,8,utf8_decode($fila['CodigoProd']),0,0,'L');
    $pdf->Cell (80,8,utf8_decode($fila1['NombreProd']),0,0,'L');
    $pdf->Cell (30,8,utf8_decode('$'.$fila1['Precio']),0,0,'L');
    $pdf->Cell (30,8,utf8_decode('$'.$fila1['Costo']),0,0,'L');
    $pdf->Cell (30,8,utf8_decode($fila1['Stock']),0,0,'L');
    $pdf->Ln(10);
   // $suma += $fila1['PrecioProd']*$fila1['CantidadProductos'];
    mysqli_free_result($consulta);
}

$pdf->Output();