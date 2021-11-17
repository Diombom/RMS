<?php
    require_once('includes/dbh.inc.php');

foreach(mysqli_query($conn, "SELECT * FROM students") as $student){
    
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM results WHERE student_id={$student['student_id']}")) > 0){
        
        echo '<h2>'.$student['name'].'</h2>';
        
        foreach(mysqli_query($conn, "SELECT * FROM results WHERE student_id={$student['student_id']}") as $result) {
            
            if($result['course_id'] < 100){
                
                $program = 'nursing';
                
            } else {
                
                $program = 'auxiliary';
                
            }
            
            $course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM $program WHERE id={$result['course_id']}"));
            
            echo $course['course_title'].'  -  -  -  '.$result['ca'].'  -  -  -  '.$result['exam'].'<br>';
            
        }
        
    }
    
}
    