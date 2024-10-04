<?php 
       require_once("fpdf/fpdf.php");

       
          $pdf = new FPDF();
          $pdf->AddPage();

          $pdf->SetFillColor(0, 0, 128);
          $pdf->Rect(0, 0, 210, 297, 'F');

          $pdf->SetFont("Arial", "B", 24);
          $pdf->SetTextColor(255, 255, 255);
          $pdf->Cell(0, 20, "Marvel Blog Account Details", 0, 1, "C");
          $pdf->Ln(10);

          $pdf->SetFont("Arial", "", 14);
          $pdf->SetTextColor(255, 255, 255);

          $pdf->Cell(50, 10, "Name: ", 0, 0);
          $pdf->Cell(100, 10, 'Ali hyder', 0, 1);

          $pdf->Cell(50, 10, "Email: ", 0, 0);
          $pdf->Cell(100, 10, 'Ali@gmail.com', 0, 1);

          $pdf->Cell(50, 10, "Password: ", 0, 0);
          $pdf->Cell(100, 10, '090078671', 0, 1);

          $pdf->Cell(50, 10, "Gender: ", 0, 0);
          $pdf->Cell(100, 10, 'Male', 0, 1);

          $pdf->Cell(50, 10, "Date of Birth: ", 0, 0);
          $pdf->Cell(100, 10,'1 Oct 1999', 0, 1);

          $pdf->Cell(50, 10, "Address: ", 0, 0);
          $pdf->MultiCell(100, 10, 'Village Aamri');

          $pdf->Output('i','Ali Hyder_credentials.pdf');


 ?>