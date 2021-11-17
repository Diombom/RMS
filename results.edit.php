<?php
    require_once('header.php');
?>

<div class="main-wrapper">
    <div class="container-fluid results">
        
        <div class="row">
            <div class="col-12 text-center">
                <h1>Edit Results</h1>
            </div>
        </div>
        
    <?php
        if(isset($_POST['type'])){
            
            if(isset($_POST['program'])){
                
                $program = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM program WHERE id={$_POST['program']}"));
                
                if($_POST['program'] == 1){
                    
                    if(isset($_POST['year'])){
                        
                        if(isset($_POST['semester'])){
                        
                            if(isset($_POST['edit-results'])){

                                $course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM {$program['name']} WHERE id={$_POST['course']}"));
                    ?>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <h2><?php echo strtoupper($program['name']).' - Semester '.$_POST['semester'] ?></h2>
                                </div>
                                <div class="col-12 text-center">
                                    <h5><?php echo $course['course_title'] ?></h5>
                                </div>
                                <div class="col-12 w-60 text-right">
                                    <a href="results.edit.php" class="btn btn-outline-primary">Go Back</a>
                                </div>
                            </div>
                            <div class="row">
                                <form action="includes/results.edit.inc.php" method="post">
                                    <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                                    <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                                    <input type="hidden" name="year" value="<?php echo $_POST['year'] ?>">
                                    <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                    <input type="hidden" name="course" value="<?php echo $course['id'] ?>">
                                    <table class="table table-striped table-light">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>STUDENT NAME</th>
                                                <th><?php echo strtoupper($_POST['type']) ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $index = 0;
                                            foreach(mysqli_query($conn, "SELECT * FROM results WHERE course_id={$course['id']}") as $result){

                                                $index++;

                                                $s_id = $result['student_id'];

                                        ?>

                                            <tr>
                                                <td><?php echo $index ?></td>
                                                <td><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE student_id={$s_id}"))['name'] ?></td>
                                                <td>
                                                    <input type="hidden" name="student" value="<?php echo $s_id ?>">
                                                    <div class="input-group">
                                                    <?php

                                                        switch($_POST['type']){

                                                            case 'ca':

                                                    ?>
                                                                <input type="number" class="form-control" name="<?php echo $s_id ?>" value="<?php echo $result['ca'] ?>">
                                                    <?php 
                                                            break;

                                                            case 'exam':
                                                    ?>
                                                                <input type="number" class="form-control" name="<?php echo $s_id ?>" value="<?php echo $result['exam'] ?>">
                                                    <?php 
                                                            break;

                                                            case 'internship':
                                                     ?>
                                                                <input type="number" class="form-control" name="<?php echo $s_id ?>" value="<?php echo $result['internship'] ?>">
                                                    <?php 
                                                            break;
                                                        }

                                                    ?>
                                                    </div>
                                                </td>
                                            </tr>


                                        <?php        
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="col-12 text-center">
                                        <input type="submit" class="btn btn-center btn-50 btn-outline-primary" name="update-results" value="Update Results">
                                    </div>
                                </form>
                            </div>

                    <?php
                            } else {
                    ?>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <h2><?php echo strtoupper($program['name']).' - Semester '.$_POST['semester'] ?></h2>
                                </div>
                                <div class="col-12 w-60 text-right">
                                    <a href="results.edit.php" class="btn btn-outline-primary">Go Back</a>
                                </div>
                            </div>
                            <div class="row">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                    <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                                    <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                                    <input type="hidden" name="year" value="<?php echo $_POST['year'] ?>">
                                    <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                    <div class="row">
                                    <?php
                                        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM records WHERE program_id={$program['id']} AND semester={$_POST['semester']}")) > 0){
                                    ?>

                                        <div class="col-8">
                                            <div class="input-group">
                                                <select name="course" id="course" class="form-control">
                                                <?php
                                                    foreach(mysqli_query($conn, "SELECT * FROM {$program['name']} WHERE semester={$_POST['semester']}") as $course){
                                                        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM records WHERE course_id={$course['id']}")) > 0){
                                                    ?>
                                                        <option value="<?php echo $course['id'] ?>"><?php echo $course['course_title'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="edit-results" value="Edit Results">
                                            </div>
                                        </div>

                                    <?php
                                        } else {
                                    ?>
                                        <div class="col-12 text-center">
                                            <p class="fail">Ooops. Looks like no course has been registered for this semester yet!</p>
                                        </div>
                                    <?php
                                        }
                                    ?>

                                    </div> 
                                </form>
                            </div>

                    <?php
                            }

                        } else {
                    ?>
                       
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2><?php echo strtoupper($program['name']).' - Year '.$_POST['year'] ?></h2>
                        </div>
                        <div class="col-12 text-center">
                            <h5>Select semester</h5>
                        </div>
                        <div class="col-12 text-right">
                            <a href="results.edit.php" class="btn btn-outline-primary">Go Back</a>
                        </div>
                    </div>
                    <form style="width: 100%;" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                        <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                        <input type="hidden" name="year" value="<?php echo $_POST['year'] ?>">
                        <div class="row">
                            <div class="col-6 text-center">
                                <button class="btn btn-outline-primary btn-option" name="semester" value="1" type="submit">First Semester</button>
                            </div>
                            <div class="col-6 text-center">
                                <button class="btn btn-outline-primary btn-option" name="semester" value="2" type="submit">Second Semester</button>
                            </div>
                        </div>
                    </form>
                       
                    <?php 
                        }
                        
                    } else {
                ?>
                    
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2><?php echo strtoupper($program['name']) ?></h2>
                        </div>
                        <div class="col-12 text-center">
                            <h5>Select year</h5>
                        </div>
                        <div class="col-12 text-right">
                            <a href="results.edit.php" class="btn btn-outline-primary">Go Back</a>
                        </div>
                    </div>
                    <form style="width: 100%;" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                        <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                        <div class="row">
                            <div class="col-4 text-center">
                                <button class="btn btn-outline-primary btn-option" name="year" value="1" type="submit">Year One</button>
                            </div>
                            <div class="col-4 text-center">
                                <button class="btn btn-outline-primary btn-option" name="year" value="2" type="submit">Year Two</button>
                            </div>
                            <div class="col-4 text-center">
                                <button class="btn btn-outline-primary btn-option" name="year" value="3" type="submit">Year Three</button>
                            </div>
                        </div>
                    </form>
                       
                <?php
                    }
                    
                } else {
                    
                    if(isset($_POST['semester'])){
                        
                        if(isset($_POST['edit-results'])){
                            
                            $course = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM {$program['name']} WHERE id={$_POST['course']}"));
                ?>
                     
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2><?php echo strtoupper($program['name']).' - Semester '.$_POST['semester'] ?></h2>
                            </div>
                            <div class="col-12 text-center">
                                <h5><?php echo $course['course_title'] ?></h5>
                            </div>
                            <div class="col-12 w-60 text-right">
                                <a href="results.edit.php" class="btn btn-outline-primary">Go Back</a>
                            </div>
                        </div>
                        <div class="row">
                            <form action="includes/results.edit.inc.php" method="post">
                                <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                                <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                                <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                <input type="hidden" name="course" value="<?php echo $course['id'] ?>">
                                <table class="table table-striped table-light">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>STUDENT NAME</th>
                                            <th><?php echo strtoupper($_POST['type']) ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $index = 0;
                                        foreach(mysqli_query($conn, "SELECT * FROM results WHERE course_id={$course['id']}") as $result){
                                            
                                            $index++;
                                            
                                            $s_id = $result['student_id'];
                                            
                                    ?>
                                         
                                        <tr>
                                            <td><?php echo $index ?></td>
                                            <td><?php echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE student_id={$s_id}"))['name'] ?></td>
                                            <td>
                                                <input type="hidden" name="student" value="<?php echo $s_id ?>">
                                                <div class="input-group">
                                                <?php
                                                    
                                                    switch($_POST['type']){
                                                        
                                                        case 'ca':
                                                            
                                                ?>
                                                            <input type="number" class="form-control" name="<?php echo $s_id ?>" value="<?php echo $result['ca'] ?>">
                                                <?php 
                                                        break;
                                                            
                                                        case 'exam':
                                                ?>
                                                            <input type="number" class="form-control" name="<?php echo $s_id ?>" value="<?php echo $result['exam'] ?>">
                                                <?php 
                                                        break;
                                                            
                                                        case 'internship':
                                                 ?>
                                                            <input type="number" class="form-control" name="<?php echo $s_id ?>" value="<?php echo $result['internship'] ?>">
                                                <?php 
                                                        break;
                                                    }
                                                    
                                                ?>
                                                </div>
                                            </td>
                                        </tr>
                                          
                                           
                                    <?php        
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                <div class="col-12 text-center">
                                    <input type="submit" class="btn btn-center btn-50 btn-outline-primary" name="update-results" value="Update Results">
                                </div>
                            </form>
                        </div>
                           
                    <?php
                        } else {
                    ?>
                       
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2><?php echo strtoupper($program['name']).' - Semester '.$_POST['semester'] ?></h2>
                            </div>
                            <div class="col-12 w-60 text-right">
                                <a href="results.edit.php" class="btn btn-outline-primary">Go Back</a>
                            </div>
                        </div>
                        <div class="row">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                                <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                                <input type="hidden" name="semester" value="<?php echo $_POST['semester'] ?>">
                                <div class="row">
                                <?php
                                    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM records WHERE program_id={$program['id']} AND semester={$_POST['semester']}")) > 0){
                                ?>

                                    <div class="col-8">
                                        <div class="input-group">
                                            <select name="course" id="course" class="form-control">
                                            <?php
                                                foreach(mysqli_query($conn, "SELECT * FROM {$program['name']} WHERE semester={$_POST['semester']}") as $course){
                                                    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM records WHERE course_id={$course['id']}")) > 0){
                                                ?>
                                                    <option value="<?php echo $course['id'] ?>"><?php echo $course['course_title'] ?></option>
                                                <?php
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="edit-results" value="Edit Results">
                                        </div>
                                    </div>

                                <?php
                                    } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <p class="fail">Ooops. Looks like no course has been registered for this semester yet!</p>
                                    </div>
                                <?php
                                    }
                                ?>

                                </div> 
                            </form>
                        </div>
                       
                <?php
                        }
                        
                    } else {
                ?>
                       
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2><?php echo strtoupper($program['name']) ?></h2>
                        </div>
                        <div class="col-12 text-center">
                            <h5>Select semester</h5>
                        </div>
                        <div class="col-12 text-right">
                            <a href="results.edit.php" class="btn btn-outline-primary">Go Back</a>
                        </div>
                    </div>
                    <form style="width: 100%;" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                        <input type="hidden" name="program" value="<?php echo $_POST['program'] ?>">
                        <div class="row">
                            <div class="col-6 text-center">
                                <button class="btn btn-outline-primary btn-option" name="semester" value="1" type="submit">First Semester</button>
                            </div>
                            <div class="col-6 text-center">
                                <button class="btn btn-outline-primary btn-option" name="semester" value="2" type="submit">Second Semester</button>
                            </div>
                        </div>
                    </form>     
                        
                <?php      
                    }
                    
                }
                
            } else {
        ?>
            <div class="row">
                <div class="col-12 text-center">
                    <h5>Select Program</h5>
                </div>
                <div class="col-12 text-right">
                    <a href="" class="btn btn-outline-primary">Go Back</a>
                </div>
            </div>
            <form style="width: 100%" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="row">
                    <input type="hidden" name="type" value="<?php echo $_POST['type'] ?>">
                <?php
                    foreach(mysqli_query($conn, "SELECT * FROM program ORDER BY name ASC") as $program){
                ?>
                    <div class="col-6 text-center">
                        <button class="btn btn-outline-primary btn-option" name="program" value="<?php echo $program['id'] ?>" type="submit"><?php echo $program['name'] ?></button>
                    </div>
                <?php
                    }
                ?>
                </div>
            </form>  
        <?php      
            }
            
            
        } else {
    ?>   
        <div class="row">
            <div class="col-12 text-center">
                <h5>Select result type</h5>
            </div>
        </div>
        <form style="width: 100%" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="row">
                <div class="col-4 text-center">
                    <input type="submit" class="btn btn-outline-primary btn-option" name="type" value="ca"> 
                </div>
                <div class="col-4 text-center">
                    <input type="submit" class="btn btn-outline-primary btn-option" name="type" value="exam"> 
                </div>
                <div class="col-4 text-center">
                    <input type="submit" class="btn btn-outline-primary btn-option" name="type" value="internship">
                </div>
            </div>
        </form>    
    <?php      
        }  
    ?>
        
    </div>
</div>


<?php
    require_once('footer.php');
?>