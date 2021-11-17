<?php
    require_once('header.php');

    $courses = mysqli_query($conn, "SELECT * FROM {$_GET['p_name']} WHERE id={$_GET['c_id']}");
    
    while($course = mysqli_fetch_assoc($courses)){
?>

<div class="main-wrapper">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Update Course</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="includes/course.edit.inc.php?p_name=<?php echo $_GET['p_name'] ?>&c_id=<?php echo $_GET['c_id'] ?>" method="post">
                    <div class="col-12 text-right">
                        <a href="courses.php?p_name=<?php echo $_GET['p_name'] ?>" class="btn btn-outline-primary">Go Back</a>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Course Title</span>
                        </div>
                        <input type="text" class="form-control" name="name" value="<?php echo $course['course_title'] ?>">
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Course Code</span>
                                </div>
                                <input type="text" class="form-control" name="code" value="<?php echo $course['course_code'] ?>">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Credit Value</span>
                                </div>
                                <input type="number" class="form-control" name="credit_value" value="<?php echo $course['credit_value'] ?>">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Year</span>
                                </div>
                                <input type="number" class="form-control" name="year" value="<?php echo $course['year'] ?>">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Semester</span>
                                </div>
                                <input type="number" class="form-control" name="semester" value="<?php echo $course['semester'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">LH</span>
                                </div>
                                <input type="number" class="form-control" name="lh" value="<?php echo $course['lh'] ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">TH</span>
                                </div>
                                <input type="number" class="form-control" name="th" value="<?php echo $course['th'] ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PH</span>
                                </div>
                                <input type="number" class="form-control" name="ph" value="<?php echo $course['ph'] ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">SPW</span>
                                </div>
                                <input type="number" class="form-control" name="spw" value="<?php echo $course['spw'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="submit" class="btn btn-center btn-50 btn-outline-primary" name="update-course" value="Update Course">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    }
    require_once('footer.php');
?>