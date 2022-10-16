<?php

require 'pdf/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage ();

$pdf->Output();


?>