<?php
    require_once('header.php');
?>

<div class="main-wrapper">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Add Student</h1>
            </div>
            <div class="col-12 text-center">
            <?php
                
                if(isset($_GET['action']) == 'add-student'){
                    
                    switch($_GET['state']){
                            
                        case 'success':
                            
                            echo '<p class="action-message success">'.$_GET['name'].' was successfully added to the database!</p>';

                            break;
                            
                        case 'fail':
                            
                            echo '<p class="action-message fail">'.$_GET['name'].' could not be  added to the database!</p>';

                            break;
                            
                    }
                    
                }  
            ?>
            </div>
        </div>   
        <div class="row">
            <div class="col-12 text-center">
                <form action="includes/student.add.inc.php" method="post">
                   <div class="row">
                        <div class="col-12 text-right">
                            <a href="students.php" class="btn btn-outline-primary">View Students</a>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Name of student">
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" name="mat" placeholder="Student matricule number">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <select name="gender" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <input type="date" class="form-control" name="dob">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="pob" placeholder="Place of Birth">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group">
                                <select name="program" class="form-control">
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
                        <div class="col-4">
                            <div class="input-group">
                                <select name="year" class="form-control">
                                    <option value="1">Year One</option>
                                    <option value="2">Year Two</option>
                                    <option value="3">Year Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group text-center">
                        <input type="submit" class="btn btn-50 btn-center btn-outline-primary" name="add-student" value="Add Student">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once('footer.php');
?>