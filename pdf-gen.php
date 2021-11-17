<?php

require_once('fpdf182/fpdf.php');

require_once ('includes/dbh.inc.php');

$result = mysqli_query($conn, "SELECT * FROM results");

if(isset($_POST['btn_pdf'])){
    
    if($_POST['program'] == 1){
        
        class PDF extends FPDF {

            function Header() {

                // Logo
                $this->Image('files/logo.png',10,6,30);

                // Arial bold 15
                $this->SetFont('Arial','B',11);

                // Title
                $this->Cell(0,0,'HIGHER INSTITUTE FOR PROFESSIONAL DEVELOPMENT AND TRAINING',0,0,'C');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Bamenda, Nkambe - Cameroon',0,0,'C');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Tel: +273 652 477 481 / +237 679 152 393',0,0,'C');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Authorisation No: 17-08224/N/MINESUP/DDES/ESUP/SDA/NJN/ebm du 08 Dec. 2016',0,0,'R');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Motto: Creating visions, and empowering the future',0,0,'C');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Website: www.hipdet-edu.com / Email: info@hipdet-edu.com',0,0,'C');

                // Line break
                $this->Ln(7);
            }

        }
        
    } else {
        
        class PDF extends FPDF {

            function Header() {

                // Logo
                $this->Image('files/logo.png',10,6,30);

                // Arial bold 15
                $this->SetFont('Arial','B',11);

                // Title
                $this->Cell(0,0,'HIGHER INSTITUTE FOR PROFESSIONAL DEVELOPMENT AND TRAINING',0,0,'C');
                
                // Line break
                $this->Ln(7);
                
                $this->Cell(0,0,'Authorisation No: 17-08224/N/MINESUP/DDES/ESUP/SDA/NJN/ebm du 08 Dec. 2016',0,0,'R');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'HIPDET/DAPROTI, Bamenda, Nkambe - Cameroon',0,0,'C');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Tel: +273 652 477 481 / +237 679 152 393',0,0,'C');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Authorisation No: 00000045/MINEFOP /SG/DFOP/SDGSF/SACD OF 10 JUNE 2020',0,0,'R');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Motto: Skilled Base Training For Employment & Job Creation',0,0,'C');

                // Line break
                $this->Ln(7);

                $this->Cell(0,0,'Website: www.hipdet-edu.com / Email: info@hipdet-edu.com',0,0,'C');

                // Line break
                $this->Ln(7);
            }

        }
        
    }
    
        
    
    // Instanciation of inherited class
    $pdf = new PDF();
    
    $pdf->AliasNbPages();
    
    $pdf->AddPage();
    
    $pdf->SetFont('Times','',11);
    
    if($_POST['program'] == 1){
        
        $pdf->SetTitle('HIPDET - NURSING RESULTS');
        
    } else {
        
        $pdf->SetTitle('HIPDET - AUXILIARY RESULTS');
        
    }
    
    
    
    foreach(mysqli_query($conn, "SELECT * FROM students WHERE program=1") as $student){

        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM results WHERE student_id={$student['student_id']}")) > 0){
            
            //Print the student's name
            
            $pdf->Cell(40,7,'Name',1,0,'C');
            $pdf->Cell(55,7,strtoupper($student['name']),1,0,'C');
            $pdf->Cell(40,7,'Matricule Number',1,0,'C');
            $pdf->Cell(55,7,strtoupper($student['mat_num']),1,1,'C');
            $pdf->Cell(40,7,'Date Of Birth',1,0,'C');
            $pdf->Cell(55,7,strtoupper($student['dob']),1,0,'C');
            $pdf->Cell(40,7,'Place Of Birth',1,0,'C');
            $pdf->Cell(55,7,strtoupper($student['pob']),1,1,'C');
            
            // Line break
            $pdf->Ln(7);
            
            $pdf->Cell(40,7,'Academic Year',1,0,'C');
            $pdf->Cell(55,7,strtoupper($student['academic_year']),1,0,'C');
            
            $pdf->Cell(40,7,'Semester',1,0,'C');
            $pdf->Cell(55,7,'Semester '.strtoupper($_POST['semester']),1,1,'C');
            
            // Line break
            $pdf->Ln(7);
            
            //Print the table headings
            
            $pdf->Cell(10,10,'S/N',1,0,'L');
            $pdf->Cell(80,10,'Course Title',1,0,'C');
            $pdf->Cell(20,10,'C.V',1,0,'C');
            $pdf->Cell(20,10,'CA',1,0,'C');
            $pdf->Cell(20,10,'Exam',1,0,'C');
            $pdf->Cell(20,10,'Total',1,0,'C');
            $pdf->Cell(20,10,'Grade',1,1,'C');
            
            
            $sn = 0;
            
            $total_credits = 0;
            
            $total_cumulative_credits = 0;

            foreach(mysqli_query($conn, "SELECT * FROM results WHERE student_id={$student['student_id']}") as $result) {
                
                $sn++;

                if($result['course_id'] < 100){

                    $program = 'nursing';

                } else {

                    $program = 'auxiliary';

                }

                $course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM $program WHERE id={$result['course_id']}"));
                
                //Increment the Total Credits
                
                $total_credits = $total_credits + $course['credit_value'];
                
                
                // Get the result total
                
                $result_total = $result['ca'] + $result['exam'];
                
                
                // Set the grades
                
                if($result_total < 40){

                    $grade = 'F';

                    $credit_earned = 0;

                } else if((40 <= $result_total) && ($result_total < 45)){

                    $grade = 'D';

                    $credit_earned = 0;

                } else if((45 <= $result_total) && ($result_total < 50)){

                    $grade = 'D+';

                    $credit_earned = 0;

                } else if((50 <= $result_total) && ($result_total < 55)){

                    $grade = 'C';

                    $credit_earned = 2;

                } else if((55 <= $result_total) && ($result_total < 60)){

                    $grade = 'C+';

                    $credit_earned = 2.5;

                } else if((60 <= $result_total) && ($result_total < 70)){

                    $grade = 'B';

                    $credit_earned = 3;

                } else if((70 <= $result_total) && ($result_total < 80)){

                    $grade = 'B+';

                    $credit_earned = 3.5;

                } else if($result_total >= 80){

                    $grade = 'A';

                    $credit_earned = 4;

                }
                
                $cumulative_credit = $credit_earned * $course['credit_value'];
                
                $total_cumulative_credits = $total_cumulative_credits + $cumulative_credit;
                
                $gpa = $total_cumulative_credits/$total_credits;
                
                $pdf->Cell(10,10,$sn,1,0,'C');
                $pdf->Cell(80,10,ucwords(strtolower($course['course_title'])),1,0,'L');
                $pdf->Cell(20,10,$course['credit_value'],1,0,'C');
                $pdf->Cell(20,10,$result['ca'],1,0,'C');
                $pdf->Cell(20,10,$result['exam'],1,0,'C');
                $pdf->Cell(20,10,$result_total,1,0,'C');
                $pdf->Cell(20,10,$grade,1,1,'C');                

            }
            
            $pdf->Cell(150,10,' ',1,0,'C');
            $pdf->Cell(20,10,'GPA',1,0,'C');
            $pdf->Cell(20,10,number_format($gpa, 2).'/4',1,0,'C');
            
            $pdf->AddPage();

        }
        
        
        
    }
    
    if($_POST['program'] == 1){
        
        $document_name = 'HIPDET - NURSING.pdf';
        
    } else {
        
        $document_name = 'HIPDET - AUXILIARY.pdf';
        
    }
    
  $pdf->Output($document_name, 'D');
    
}