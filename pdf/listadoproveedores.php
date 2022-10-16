<?php
session_start();
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';

$productos=ejecutarSQL::consultar("SELECT * FROM proveedor ");

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
$pdf->Cell (0,10,utf8_decode('Listado de Proveedores'),1,1,'C');
$pdf->Image('logochico.png',70,10,-100);
$pdf->Ln(9);
$pdf->Cell (45,5,utf8_decode('Codigo Proveedor'),1,1,'C');
$pdf->Cell (145,-5,utf8_decode('Razon Social'),1,1,'C');
$pdf->Cell (190,5,utf8_decode('Direccion'),1,1,'R');
$pdf->Ln(5);

$sDet=ejecutarSQL::consultar("SELECT p.NITProveedor, p.NombreProveedor, p.Direccion FROM proveedor p");
while($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)){
    $consulta=ejecutarSQL::consultar("SELECT * FROM proveedor WHERE NITProveedor='".$fila1['NITProveedor']."'");
    $fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $pdf->Cell (45,8,utf8_decode($fila['NITProveedor']),1,0,'C');
    $pdf->Cell (100,8,utf8_decode($fila1['NombreProveedor']),1,0,'C');
    $pdf->Cell (45,8,utf8_decode($fila1['Direccion']),1,0,'C');
    //$pdf->Cell (30,10,utf8_decode('$'.$fila1['PrecioProd']*$fila1['CantidadProductos']),1,0,'C');
    $pdf->Ln(10);
   // $suma += $fila1['PrecioProd']*$fila1['CantidadProductos'];
    mysqli_free_result($consulta);
}

$pdf->Output();