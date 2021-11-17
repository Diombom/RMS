<?php

require_once('includes/dbh.inc.php');

if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM results")) > 0){
    foreach(mysqli_query($conn, "SELECT * FROM students WHERE year=1") as $student){
        
        $student_id = $student['student_id'];
        
        $exam_score = RAND(26, 58);
        
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM results WHERE student_id={$student_id}")) > 0){
            echo 'This student already has marks for this course';
        } {
            mysqli_query($conn, "UPDATE results SET exam_score={$exam_score} WHERE student_id={$student_id}");
        }
    }
} else {
    echo 'Please <a href="insert.php">input CA</a> marks first! <br>';
}