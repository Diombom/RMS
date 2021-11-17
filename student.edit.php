<?php
    require_once('header.php');
?>

<?php
    if(isset($_GET['s_id'])){
        
        $students = mysqli_query($conn, "SELECT * FROM students WHERE student_id={$_GET['s_id']}");
        
        while($student = mysqli_fetch_assoc($students)){
?>
   
<div class="main-wrapper">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Edit Student</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <form action="includes/student.edit.inc.php" method="post">
                   <div class="row">
                        <div class="col-12 text-right">
                            <a href="students.php" class="btn btn-outline-primary">Go Back</a>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="hidden" class="form-control" name="s_id" value="<?php echo $student['student_id'] ?>">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name</span>
                        </div>
                        <input type="text" class="form-control" name="name" value="<?php echo $student['name'] ?>">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mat. Num.</span>
                        </div>
                        <input type="text" class="form-control" name="mat" value="<?php echo $student['mat_num'] ?>">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Gender</span>
                                </div>
                                <select name="gender" class="form-control">
                                <?php
                                    if($student['gender'] == 'Male'){
                                ?>
                                    <option value="Male" selected="selected">Male</option>
                                    <option value="Female">Female</option>
                                <?php
                                    } else {
                                ?>
                                    <option value="Male">Male</option>
                                    <option value="Female" selected="selected">Female</option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">D.O.B</span>
                                </div>
                                <input type="date" class="form-control" name="dob" value="<?php echo $student['dob'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">P.O.B</span>
                                </div>
                                <input type="text" class="form-control" name="pob" value="<?php echo $student['pob'] ?>">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Program</span>
                                </div>
                                <select name="program" class="form-control">
                                <?php
                                    foreach(mysqli_query($conn, "SELECT * FROM program") as $program){
                                ?>
                                    <option value="<?php echo $program['id'] ?>"
                                        <?php
                                            if($student['program'] == $program['id']){
                                                echo 'selected="selected"';
                                            }
                                        ?>
                                    ><?php echo $program['name'] ?></option> 
                                <?php
                                    }  
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Year</span>
                                </div>
                                <select name="year" class="form-control">
                                    <option value="1"
                                        <?php
                                            if($student['year'] == 1){
                                                echo 'selected="selected"';
                                            }
                                        ?>
                                    >Year One</option>
                                    <option value="2"
                                        <?php
                                            if($student['year'] == 2){
                                                echo 'selected="selected"';
                                            }
                                        ?>
                                    >Year Two</option>
                                    <option value="3"
                                        <?php
                                            if($student['year'] == 3){
                                                echo 'selected="selected"';
                                            }
                                        ?>
                                    >Year Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group text-center">
                        <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="edit-student" value="Edit Student">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
   
<?php
        }
    } else {
        
        header("Location: students.php");
        
        exit();
        
    }
?>



<?php
    require_once('footer.php');
?>