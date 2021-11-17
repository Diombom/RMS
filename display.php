<?php require_once('header.php'); ?>

<div class="main-wrapper">

<?php

    foreach(mysqli_query($conn, "SELECT * FROM students") as $student){
        $student_id = $student['student_id'];
        
        $a = "SELECT * FROM results
        JOIN nursing n ON n.course_code = results.course_code
        WHERE student_id={$student_id}";
        
        $row_index = 1;
        $credit_value_total = 0;
        $cumulative_credit_total = 0;
        
?>
        
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center"><?php echo $student['name'] ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-light">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">COURSE CODE</th>
                                <th scope="col">COURSE TITLE</th>
                                <th scope="col">CV</th>
                                <th scope="col">CA</th>
                                <th scope="col">EXAM</th>
                                <th scope="col">FINAL</th>
                                <th scope="col">GRADE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach(mysqli_query($conn, $a) as $data){
                            
                                    
                                    $total_score = $data['ca_score'] + $data['exam_score'];

                                    if($total_score < 40){

                                        $grade = 'F';

                                        $credit_earned = 0;

                                    } else if((40 <= $total_score) && ($total_score < 45)){

                                        $grade = 'D';

                                        $credit_earned = 0;

                                    } else if((45 <= $total_score) && ($total_score < 50)){

                                        $grade = 'D+';

                                        $credit_earned = 0;

                                    } else if((50 <= $total_score) && ($total_score < 55)){

                                        $grade = 'C';

                                        $credit_earned = 2;

                                    } else if((55 <= $total_score) && ($total_score < 60)){

                                        $grade = 'C+';

                                        $credit_earned = 2.5;

                                    } else if((60 <= $total_score) && ($total_score < 70)){

                                        $grade = 'B';

                                        $credit_earned = 3;

                                    } else if((70 <= $total_score) && ($total_score < 80)){

                                        $grade = 'B+';

                                        $credit_earned = 3.5;

                                    } else if($total_score >= 80){

                                        $grade = 'A';

                                        $credit_earned = 4;

                                    }

                                    $cumulative_credit = $data['credit_value'] * $credit_earned;

                            ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row_index; ?>
                                    </th>
                                    <td>
                                        <?php echo $data['course_code'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['course_title'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['credit_value'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['ca_score'] ?>
                                    </td>
                                    <td>
                                        <?php echo $data['exam_score'] ?>
                                    </td>
                                    <td>
                                        <?php echo $total_score ?>
                                    </td>
                                    <td>
                                        <?php echo $grade ?>
                                    </td>
                                </tr>
                                <?php
                                    $row_index++;
                                    $credit_value_total = $credit_value_total + $data['credit_value'];
                                    $cumulative_credit_total = $cumulative_credit_total + $cumulative_credit;
                                    
                        }

                        $gpa = $cumulative_credit_total / $credit_value_total;
                    ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>GPA</td>
                                        <td>
                                            <?php echo number_format($gpa, 2).'/4'; ?>
                                        </td>
                                    </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }
?>

</div>

<?php require_once('footer.php'); ?>