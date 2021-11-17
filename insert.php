<?php

require_once('includes/dbh.inc.php');

foreach(mysqli_query($conn, "SELECT * FROM students WHERE year=1") as $student){
    
    $student_id = $student['student_id'];
    
    foreach(mysqli_query($conn, "SELECT * FROM nursing WHERE semester=1") as $course){
        
        $course_code = $course['course_code'];
        
        $ca_score = RAND(12, 28);
        
        $exam_score = RAND(28, 65);
        
        //Query all the existing records on the result table
        
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM results")) > 0){
            
            echo 'Records have already been inserted. You will only have to update them <br>';
            
        } else {
            mysqli_query($conn, "INSERT INTO results (course_code, student_id, ca_score) VALUES ('$course_code', '$student_id', '$ca_score')");
        }
        
    }
}