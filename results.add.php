<?php
require_once('header.php');
?>

<?php

if(isset($_POST['program']) && !empty($_POST['program'])){
    
    switch($_POST['program']){
            
        case 1:
            
            foreach(mysqli_query($conn, "SELECT * FROM program WHERE id={$_POST['program']}") as $p){ 
                
                $program = $p['name'];
            
            }
            
            $a = "SELECT * FROM {$program} WHERE year={$_POST['year']} AND semester={$_POST['semester']}";
            
            $b = "SELECT * FROM students WHERE program={$_POST['program']} AND year={$_POST['year']} ORDER BY name ASC";
            
            break;
            
        case 2:
            
            foreach(mysqli_query($conn, "SELECT * FROM program WHERE id={$_POST['program']}") as $p){ 
                
                $program = $p['name'];
            
            }
            
            $a = "SELECT * FROM {$program} WHERE semester={$_POST['semester']}";
            
            $b = "SELECT * FROM students WHERE program={$_POST['program']} ORDER BY name ASC";
            
            break;
            
    }
    
}

?>

<div class="main-wrapper">
<?php
    if(isset($_POST['add-results'])){
        
        $c_id = $_POST['course'];
        
        $c_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM {$program} WHERE id={$c_id}"))['course_title'];
        
?>
    <div class="container-fluid results">
        <div class="row">
            <div class="col-12 text-center">
               
                <?php
                    if($_POST['type'] == 'ca'){

                        $type = 'CA';

                    } else {

                        $type = ucfirst($_POST['type']);

                    }
                ?>
                <h2><?php echo ucwords(strtolower($c_name)) ?></h2>
                <h5><?php echo $type.' (Year '.$_POST['year'].' - Semester '.$_POST['semester'].')' ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="includes/results.add.inc.php" method="post">
                    <div class="col-12 text-right">
                        <a href="results.add.php" class="btn btn-outline-primary">Go Back</a>
                    </div>
                    <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                    <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                    <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                    <input type="hidden" name="course" value="<?php echo $_POST['course'] ?>">
                    <input type="hidden" name="b" value="<?php echo $b ?>">
                    <table class="table table-striped table-light">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $index = 0;
                            foreach(mysqli_query($conn, $b) as $student){
                                $index = $index + 1;
                        ?>
                            <tr>
                                <td><?php echo $index ?></td>
                                <td><?php echo $student['name'] ?></td>
                                <td><input type="number" class="form-control" name="<?php echo $student['student_id'] ?>"></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    <div class="input-group">
                        <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="add-results" value="Add Results">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php        
    } else {
?>
    <div class="container-fluid results">
        <div class="row">
            <div class="col-12">
                <form action="results.add.php" method="post">
                <?php
                    if(!isset($a)){
                ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3>Please select the appropriate options to proceed.</h3>
                        </div>
                        <div class="col-12 text-right">
                            <a href="results.php" class="btn btn-outline-primary">Go Back</a>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <select name="program" id="program" class="form-control">
                                <?php
                                    foreach(mysqli_query($conn, "SELECT * FROM program") as $program){
                                ?>
                                    <option value="<?php echo $program['id'] ?>"><?php echo $program['name'] ?></option>
                                <?php
                                    }  
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <select name="year" id="year" class="form-control">
                                    <option value="1">Year One</option>
                                    <option value="2">Year Two</option>
                                    <option value="3">Year Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <select name="semester" id="semester" class="form-control">
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <select name="type" id="type" class="form-control">
                                    <option value="ca">CA</option>
                                    <option value="exam">Exam</option>
                                    <option value="internship">Internship</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="submit" class="btn btn-50 btn-center btn-outline-primary" value="Next">
                        </div>
                    </div> 
                <?php
                    } else {
                ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <?php
                                if($_POST['type'] == 'ca'){
                                    
                                    $type = 'CA';
                                    
                                } else if($_POST['type'] == 'both'){
                                    
                                    $type = 'CA & Exam';
                                    
                                } else {
                                    
                                    $type = ucfirst($_POST['type']);
                                    
                                }
                            ?>
                            <?php
                                if($_POST['program'] == 1){
                            ?>
                                <h2><?php echo $program.' - Year '.$_POST['year'].' - Semester '.$_POST['semester'].' - '.$type ?></h2>
                            <?php
                                } else {
                            ?>
                                <h2><?php echo $program.' - Semester '.$_POST['semester'].' - '.$type ?></h2>
                            <?php    
                                }
                            ?>
                            
                        </div>
                        
                        <div class="col-12 text-center">
                            <h4>Please select the course to proceed.</h4>
                        </div>
                        <div class="col-12 text-right">
                            <a href="results.add.php" class="btn btn-outline-primary">Go Back</a>
                        </div>
                           
                        <input type="hidden" class="form-control" name="program" value="<?php echo $_POST['program'] ?>">
                        
                        <input type="hidden" class="form-control" name="year" value="<?php echo $_POST['year'] ?>">
                        
                        <input type="hidden" class="form-control" name="semester" value="<?php echo $_POST['semester'] ?>">
                        
                        <input type="hidden" class="form-control" name="type" value="<?php echo $_POST['type'] ?>">
                        
                        <div class="input-group">
                            <select name="course" id="course" class="form-control">
                            <?php
                                foreach(mysqli_query($conn, $a) as $course){
                                    
                                    $r_check = "SELECT * FROM records WHERE course_id={$course['id']}";
                                    
                                    if(mysqli_num_rows(mysqli_query($conn, $r_check)) > 0){
                                        
                                        switch($_POST['type']){
                                                
                                            case 'ca':
                                               
                                                $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM records WHERE course_id={$course['id']}"));
                                                
                                                if($r['ca'] == NULL){
                                            ?>
                                                <option value="<?php echo $course['id'] ?>"><?php echo $course['course_title'] ?></option>
                                            <?php
                                                }
                                                
                                                break;
                                                
                                            case 'exam':
                                                
                                                $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM records WHERE course_id={$course['id']}"));
                                                
                                                if($r['exam'] == NULL){
                                            ?>
                                                <option value="<?php echo $course['id'] ?>"><?php echo $course['course_title'] ?></option>
                                            <?php
                                                }
                                                
                                                break;
                                                
                                            case 'internship':
                                                
                                                $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM records WHERE course_id={$course['id']}"));
                                                
                                                if($r['internship'] == NULL){
                                            ?>
                                                <option value="<?php echo $course['id'] ?>"><?php echo $course['course_title'] ?></option>
                                            <?php
                                                }
                                                
                                                break;                                               
                                        }
                                        
                                    } else {
                                ?>
                                    <option value="<?php echo $course['id'] ?>"><?php echo $course['course_title'] ?></option>
                                <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="add-results" value="Proceed">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <p class="fail">NOTE: If you don't find a registered course here, this is because the results for the course have already been inputed. You can update them in the <a href="results.edit.php">update</a> section</p>
                    </div>
                <?php
                    }  
                ?>
                    
                </form>
            </div>
        </div>
    </div>   
<?php
    }
?>
</div>

<?php
    require_once('footer.php');
?>

