<?php
    require_once('header.php');
?>

<div class="main-wrapper">
    <div class="container-fluid results">
                    
    <?php

        if(isset($_POST['view-by'])){
    
            switch($_POST['view-by']){
                    
                case 'course':
                    
            ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM program WHERE id={$_POST['program']}"))['name'] ?> - <?php echo 'Semester '.$_POST['semester'] ?></h1>
                            <h5>Showing results per course.</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="row">
                                    <div class="col-6 text-left">
                                        <a href="results.view.php" class="btn btn-outline-primary">Go Back</a>
                                    </div>
                                    <div class="col-6 text-right">
                                        <input type="hidden" name="view-by" value="student">
                                        <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                                        <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                        <div class="input-group">
                                            <div class="col-12 text-right">
                                                <input type="submit" class="btn btn-50 btn-outline-primary" name="change-view" value="View By Student"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                      
                         
                       
            <?php
                    
                    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM records")) > 0){
                        
                        foreach(mysqli_query($conn, "SELECT * FROM records WHERE program_id={$_POST['program']} AND semester={$_POST['semester']}") as $course){
                            
                            $c_id = $course['course_id'];
                                
                    ?>
                            <div class="row">
                                <div class="col-12 text-center">
                                <?php
                                    $program = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM program WHERE id={$_POST['program']}"))['name'];
                                
                                    $course_title = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM {$program} WHERE id={$c_id}"))['course_title'];
                            
                                ?>
                                    <h3><?php echo ucwords(strtolower($course_title)) ?></h3>
                                </div>
                                <div class="col-12">
                                    <table class="table table-striped table-light">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Student's Name</th>
                                                <th>CA</th>
                                                <th>Exam</th>
                                                <th>Total</th>
                                                <th>Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $index = 0;
                                            foreach(mysqli_query($conn, "SELECT * FROM results WHERE course_id={$c_id} ORDER BY course_id ASC") as $result){
                                                $index = $index + 1;
                                                $student_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE student_id={$result['student_id']}"))['name'];
                                        ?>
                                            <tr>
                                                <td><?php echo $index ?></td>
                                                <td><?php echo $student_name ?></td>
                                                <td>
                                                <?php
                                                    if(!empty($result['ca'])){
                                                        echo $result['ca'];
                                                    } else {
                                                        echo '<p class="fail"> - </p>';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php
                                                    if(!empty($result['exam'])){
                                                        echo $result['exam'];
                                                    } else {
                                                        echo '<p class="fail"> - </p>';
                                                    }
                                                ?>   
                                                </td>
                                                <td>
                                                <?php
                                                    if((!empty($result['ca'])) && (!empty($result['exam']))){
                                                        
                                                        $total = $result['ca'] + $result['exam'];
                                                        
                                                        echo $total;
                                                        
                                                    } else {
                                                        echo '<p class="fail"> - </p>';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php
                                                    
                                                    if(isset($total)){
                                                        
                                                        if($total < 40){

                                                            $grade = 'F';

                                                            $credit_earned = 0;

                                                        } else if((40 <= $total) && ($total < 45)){

                                                            $grade = 'D';

                                                            $credit_earned = 0;

                                                        } else if((45 <= $total) && ($total < 50)){

                                                            $grade = 'D+';

                                                            $credit_earned = 0;

                                                        } else if((50 <= $total) && ($total < 55)){

                                                            $grade = 'C';

                                                            $credit_earned = 2;

                                                        } else if((55 <= $total) && ($total < 60)){

                                                            $grade = 'C+';

                                                            $credit_earned = 2.5;

                                                        } else if((60 <= $total) && ($total < 70)){

                                                            $grade = 'B';

                                                            $credit_earned = 3;

                                                        } else if((70 <= $total) && ($total < 80)){

                                                            $grade = 'B+';

                                                            $credit_earned = 3.5;

                                                        } else if($total >= 80){

                                                            $grade = 'A';

                                                            $credit_earned = 4;

                                                        }
                                                        
                                                    }  
                                                
                                                    if((!empty($result['ca'])) && (!empty($result['exam']))){
                                                        
                                                        $total = $result['ca'] + $result['exam'];
                                                        
                                                        echo $grade;
                                                        
                                                    } else {
                                                        echo '<p class="fail"> - </p>';
                                                    }
                                                ?>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                         
                    <?php
                            
                        }
                        
                    } else {
                ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h5 class="fail">No results have been registered yet!</h5>
                        </div>
                    </div> 
                     
                <?php
                        
                    }
                    
                    break;
                    
                case 'student':
                    
            ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM program WHERE id={$_POST['program']}"))['name'] ?> - <?php echo 'Semester '.$_POST['semester'] ?></h1>
                            <h5>Showing results per student</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form class="pb-0" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="row">
                                    <div class="col-6 text-left">
                                        <a href="results.view.php" class="btn btn-outline-primary">Go Back</a>
                                    </div>
                                    <div class="col-6 text-right">
                                        <input type="hidden" name="view-by" value="course">
                                        <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                                        <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                        <div class="input-group">
                                            <div class="col-12 text-right">
                                                <input type="submit" class="btn btn-50 btn-outline-primary" name="change-view" value="View By Course">  
                                            </div>
                                        </div>  
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-12">
                            <form action="pdf-gen.php" method="post">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <input type="hidden" name="program" value='<?php echo $_POST['program'] ?>'>
                                        <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                        <input type="submit" class="btn btn-50 btn-outline-primary" name="btn_pdf" value="Save Results">
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    <?php
                        if($_POST['program'] == 1){
                    ?>
                        
                        <div class="row">
                            <div class="col-12">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                    <div class="row">
                                        <input type="hidden" name="view-by" value="student">
                                        <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                                        <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                        <div class="col-4 offset-2 text-right">
                                            <div class="input-group text-right">
                                                <select name="year" id="year" class="form-control">
                                                    <option value="">Select Year</option>
                                                    <option value="1">Year One</option>
                                                    <option value="2">Year Two</option>
                                                    <option value="3">Year Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="change-year" value="Change Year">
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <form action="pdf-gen.php" method="post">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <input type="hidden" name="program" value='<?php echo $_POST['program'] ?>'>
                                        <input type="submit" class="btn btn-50 btn-outline-primary" name="btn_pdf" value="Save Results">
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                           
                    <?php
                        }
                    
                        if(isset($_POST['year'])){
                            
                            if($_POST['year'] == ""){
                               
                                $a = "SELECT * FROM students WHERE program={$_POST['program']}";
                                
                            } else {
                                
                                $a = "SELECT * FROM students WHERE program={$_POST['program']} AND year={$_POST['year']}";
                                
                            }
                            
                        } else {
                            
                            $a = "SELECT * FROM students WHERE program={$_POST['program']}";
                            
                        }
                    ?>   
            
                <?php
                    
                    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM records WHERE program_id={$_POST['program']}")) > 0){
                        
                        $program = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM program WHERE id={$_POST['program']}"))['name'];
                        
                        foreach(mysqli_query($conn, $a) as $student){
                            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM results WHERE student_id={$student['student_id']}")) > 0){
                            
                    ?>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h2><?php echo $student['name'] ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-light">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Course Title</th>
                                                <th scope="col">Course Code</th>
                                                <th scope="col">C.V</th>
                                                <th scope="col">CA</th>
                                                <th scope="col">Exam</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            $index = 0;
                                            
                                            $credit_value_total = 0;

                                            $cumulative_credit_total = 0;

                                            foreach(mysqli_query($conn, "SELECT * FROM {$program} WHERE year={$student['year']}") as $course){

                                                $index = $index + 1;

                                                $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM results WHERE course_id={$course['id']} AND student_id={$student['student_id']}"));

                                                if($course['semester'] == $_POST['semester']){
                                        ?>

                                                <tr>
                                                    <td><?php echo $index ?></td>
                                                    <td><?php echo $course['course_title'] ?></td>
                                                    <td><?php echo $course['course_code'] ?></td>
                                                    <td><?php echo $course['credit_value'] ?></td>
                                                    <td>
                                                    <?php
                                                        if(!empty($result['ca'])){

                                                            $ca = $result['ca'];

                                                            echo $ca;

                                                        } else {

                                                            echo '<p class="fail"> - </p>';

                                                        }
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        if(!empty($result['exam'])){

                                                            $exam = $result['exam'];

                                                            echo $exam;

                                                        } else {

                                                            echo '<p class="fail"> - </p>';

                                                        }
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        if((!empty($result['ca'])) && (!empty($result['exam']))){

                                                            $total = $result['ca'] + $result['exam'];

                                                            echo $total;

                                                        } else {
                                                            echo '<p class="fail"> - </p>';
                                                        }
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php

                                                        if(isset($total)){

                                                            if($total < 40){

                                                                $grade = 'F';

                                                                $credit_earned = 0;

                                                            } else if((40 <= $total) && ($total < 45)){

                                                                $grade = 'D';

                                                                $credit_earned = 0;

                                                            } else if((45 <= $total) && ($total < 50)){

                                                                $grade = 'D+';

                                                                $credit_earned = 0;

                                                            } else if((50 <= $total) && ($total < 55)){

                                                                $grade = 'C';

                                                                $credit_earned = 2;

                                                            } else if((55 <= $total) && ($total < 60)){

                                                                $grade = 'C+';

                                                                $credit_earned = 2.5;

                                                            } else if((60 <= $total) && ($total < 70)){

                                                                $grade = 'B';

                                                                $credit_earned = 3;

                                                            } else if((70 <= $total) && ($total < 80)){

                                                                $grade = 'B+';

                                                                $credit_earned = 3.5;

                                                            } else if($total >= 80){

                                                                $grade = 'A';

                                                                $credit_earned = 4;

                                                            }

                                                            $cumulative_credit = $course['credit_value'] * $credit_earned;

                                                        }  

                                                        if((!empty($result['ca'])) && (!empty($result['exam']))){

                                                            $total = $result['ca'] + $result['exam'];

                                                            echo $grade;

                                                        } else {
                                                            echo '<p class="fail"> - </p>';
                                                        }
                                                    ?>
                                                    </td>
                                                </tr>

                                        <?php
                                                    if((!empty($result['ca'])) && (!empty($result['exam']))){
                                                        
                                                        $credit_value_total = $credit_value_total + $course['credit_value'];
                                                        
                                                    }
                                                    
                                                    if(isset($cumulative_credit)){
                                                        
                                                        $cumulative_credit_total = $cumulative_credit_total + $cumulative_credit;
                                                        
                                                    }

                                                }

                                                if($cumulative_credit_total > 0){

                                                    $gpa = $cumulative_credit_total / $credit_value_total;
                                                    
                                                } else {
                                                    
                                                    $gpa = '<p class="fail"> - </p>';
                                                    
                                                }
                                            }
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>GPA</td>
                                                <td>
                                                <?php echo number_format($gpa, 2).'/4'?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                    <?php      
                        }
                ?>    
                    
                    
                <?php
                        }
                    } else {
                ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h5 class="fail">No results have been registered yet!</h5>
                        </div>
                    </div> 
                     
                <?php
                        
                    }
                    
                    break;
                    
            }

        } else {
    ?>
        
        <div class="row w-60">
            <div class="col-6">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="input-group">
                        <div class="col-3">
                            <select name="program" id="program" class="form-control">
                                <option value="1">Nursing</option>
                                <option value="2">Auxiliary</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="semester" id="semester" class="form-control">
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="view-by" id="view" class="form-control">
                                <option value="course">View by course</option>
                                <option value="student">View by student</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="change-view" value="View Results">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    <?php
        }
    ?>
    </div>
</div>






<?php
    require_once('footer.php');
?>