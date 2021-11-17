<?php
    require_once('header.php');
?>

<?php
    if(isset($_GET['p_name'])){
        
        if(isset($_POST['filter'])){
            
            if(!empty($_POST['year']) && !empty($_POST['semester'])){
                
                $query = "SELECT * FROM {$_GET['p_name']} WHERE year={$_POST['year']} AND semester={$_POST['semester']}";
                
                $heading = 1;
                
                
            } else if(!empty($_POST['year']) && empty($_POST['semester'])) {
                
                $query = "SELECT * FROM {$_GET['p_name']} WHERE year={$_POST['year']}";
                
                $heading = 2;
                
                
            } else if($_GET['p_name'] == 'Auxiliary' && !empty($_POST['semester'])){
                
                $query = "SELECT * FROM {$_GET['p_name']} WHERE semester={$_POST['semester']}";
                
                $heading = 3;
                
            } else if(empty($_POST['year']) && empty($_POST['semester'])){
                
                $query = "SELECT * FROM {$_GET['p_name']}";
                
            }
            
        } else {
            
            $query = "SELECT * FROM {$_GET['p_name']}";
            
        }
?>
    <div class="main-wrapper">
        <div class="container-fluid content">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>
                    
                        <?php echo ucfirst($_GET['p_name']); ?>
                        
                        <?php
                            
                            if(isset($heading)){
                                
                                switch($heading){

                                    case 1:

                                        echo ' - Year '.$_POST['year'].' - Semester '.$_POST['semester'];

                                        break;

                                    case 2:

                                        echo ' - Year '.$_POST['year'];

                                        break;
                                        
                                    case 3:
                                        
                                        echo ' - Semester '.$_POST['semester'];
                                        
                                        break;
                                }
                                
                            }
        
                        ?>
                    
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="courses.php?p_name=<?php echo $_GET['p_name'] ?>" method="post">
                        <div class="row">
                            <div class="col-3">
                                <h3>Filter</h3>
                            </div>
                        <?php
                            if($_GET['p_name'] == 'Nursing'){
                        ?>
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
                        <?php
                            }  
                        ?>
                            <div class="col-3">
                                <div class="input-group">
                                    <select name="semester" id="semester" class="form-control semester">
                                        <option value="">Select Semester</option>
                                        <option value="1">First Semester</option>
                                        <option value="2">Second Semester</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <input type="submit" id="getResults" class="btn btn-center btn-50 btn-outline-primary get-results" name="filter" value="Filter">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                <?php

                    if(isset($_GET['action']) == 'edit-course'){

                        switch($_GET['state']){

                            case 'success':

                                echo '<p class="action-message success">'.$_GET['name'].' was successfully updated!</p>';

                                break;

                            case 'fail':

                                echo '<p class="action-message fail">'.$_GET['name'].' could not be  updated!</p>';

                                break;

                        }

                    }  
                ?>
                </div>
                <div class="col-6 text-left">
                    <h4>Showing <?php echo mysqli_num_rows(mysqli_query($conn, $query)) ?>/<?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM {$_GET['p_name']}")) ?> courses</h4>
                </div>
                <div class="col-6 text-right">
                    <a href="course.add.php?p_name=<?php echo $_GET['p_name'] ?>" class="btn btn-outline-primary">Add Course</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-light">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Course Title</th>
                                <th>Course Code</th>
                                <th>CV</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>LH</th>
                                <th>TH</th>
                                <th>SPW</th>
                                <th>PH</th>
                                <th></th>                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach(mysqli_query($conn, $query) as $course){
                        ?>
                            <tr id="<?php echo $course['id'] ?>">
                                <td><?php echo $course['id'] ?></td>
                                <td><?php echo $course['course_title'] ?></td>
                                <td><?php echo $course['course_code'] ?></td>
                                <td><?php echo $course['credit_value'] ?></td>
                                <td><?php echo $course['year'] ?></td>
                                <td><?php echo $course['semester'] ?></td>
                                <td><?php echo $course['lh'] ?></td>
                                <td><?php echo $course['th'] ?></td>
                                <td><?php echo $course['spw'] ?></td>
                                <td><?php echo $course['ph'] ?></td>
                                <td><a href="course.edit.php?p_name=<?php echo $_GET['p_name'] ?>&c_id=<?php echo $course['id']; ?>" class="btn btn-outline-primary">Edit</a></td>
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
    } else {
        header("Location: programs.php");
    }
?>

<?php
    require_once('footer.php');
?>