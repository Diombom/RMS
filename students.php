<?php
    require_once('header.php');
?>

<?php

    if(isset($_POST['filter'])){

        if(!empty($_POST['program']) && !empty($_POST['year'])){

            if($_POST['program'] == 1){
                
                $query = "SELECT * FROM students WHERE program={$_POST['program']} AND year={$_POST['year']}";
                
                $heading = 1;
                
            } else {
                
                $query = "SELECT * FROM students WHERE program={$_POST['program']}";
                
                $heading = 2;
                
            }

        } else if(!empty($_POST['program']) && empty($_POST['year'])) {

            $query = "SELECT * FROM students WHERE program={$_POST['program']}";

            $heading = 2;


        } else if(empty($_POST['program']) && !empty($_POST['year'])){

            $query = "SELECT * FROM students WHERE year={$_POST['year']}";

            $heading = 3;

        } else if(empty($_POST['year']) && empty($_POST['semester'])){

            $query = "SELECT * FROM students";

        }

    } else {

        $query = "SELECT * FROM students";

    }

?>

<div class="main-wrapper">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12 text-center">
               
                <h1>
                
                <?php
                    
                    if(isset($heading)){
                        
                        switch($heading){

                            case 1:
                                
                                if($_POST['program'] == 1){
                                    
                                    echo 'Nursing Students - Year '.$_POST['year'];
                                    
                                } else {
                                    
                                    echo 'Auxiliary Students';
                                    
                                }

                                break;

                            case 2:

                                if($_POST['program'] == 1){
                                    
                                    echo 'Nursing Students';
                                    
                                } else {
                                    
                                    echo 'Auxiliary Students';
                                    
                                }

                                break;

                            case 3:

                                echo 'Year '.$_POST['year'].' Students';

                        }
                        
                    } else {
                        echo 'All Students';
                    }
                
                ?>
                
                </h1>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="students.php" method="post">
                    <div class="row">
                        <div class="col-3">
                            <h3>Filter</h3>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <select name="program" id="program" class="form-control program">
                                    <option value="">Select Program</option>
                                <?php
                                    foreach(mysqli_query($conn, "SELECT * FROM program") as $program) {
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
                                <select name="year" id="year" class="form-control year">
                                    <option value="">Select Year</option>
                                    <option value="1">Year One</option>
                                    <option value="2">Year Two</option>
                                    <option value="3">Year Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <input type="submit" id="getStudents" class="btn btn-center btn-50 btn-outline-primary" name="filter" value="Filter">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
            <?php
                
                if(isset($_GET['action']) == 'add-student'){
                    
                    switch($_GET['state']){
                            
                        case 'success':
                            
                            echo '<p class="action-message success">'.$_GET['name'].' was successfully updated!</p>';

                            break;
                            
                        case 'fail':
                            
                            echo '<p class="action-message fail">'.$_GET['name'].' was not updated!</p>';

                            break;
                            
                    }
                    
                }  
            ?>
            </div>
            <div class="col-6 text-left">
                <h4>Showing <?php echo mysqli_num_rows(mysqli_query($conn, $query)) ?>/<?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students")) ?> students</h4>
            </div>
            <div class="col-6 text-right">
                <a href="student.add.php" class="btn btn-outline-primary">Add Student</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Matricule</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>POB</th>
                            <th>Program</th>
                            <th>Year</th>
                            <th>Enrolled In</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $index = 0;
                        foreach(mysqli_query($conn, $query) as $student){
                            $index = $index+1;
                    ?>
                        <tr id="<?php echo $student['student_id'] ?>">
                            <td><?php echo $index ?></td>
                            <td><?php echo $student['name'] ?></td>
                            <td><?php echo $student['mat_num'] ?></td>
                            <td><?php echo $student['gender'] ?></td>
                            <td><?php echo $student['dob'] ?></td>
                            <td><?php echo $student['pob'] ?></td>
                            <td><?php if($student['program'] == 1){
                                            echo 'Nursing';
                                        } else {
                                            echo 'Auxiliary';
                                        }
                                ?></td>
                            <td><?php echo $student['year'] ?></td>
                            <td><?php echo $student['academic_year'] ?></td>
                            <td><a href="student.edit.php?s_id=<?php echo $student['student_id'] ?>" class="btn btn-outline-primary">Edit</a></td>
                        </tr>
                    <?php 
                        }  
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
    require_once('footer.php')
?>