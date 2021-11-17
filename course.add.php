<?php
    require_once('header.php');
?>

<div class="main-wrapper">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Add Courses</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="includes/course.add.inc.php?p_name=<?php echo $_GET['p_name'] ?>" method="post">
                    <div class="col-12 text-right">
                        <a href="courses.php?p_name=<?php echo $_GET['p_name'] ?>" class="btn btn-outline-primary">View Courses</a>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Course Title">
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="input-group">
                                <input type="text" class="form-control" name="code" placeholder="Course Code">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group">
                                <input type="number" class="form-control" name="credit_value" placeholder="Credit Value">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="input-group">
                                <input type="number" class="form-control" name="year" placeholder="Year">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="input-group">
                                <input type="number" class="form-control" name="semester" placeholder="Semester">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group">
                                <input type="number" class="form-control" name="lh" placeholder="Lecture Hours">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <input type="number" class="form-control" name="th" placeholder="Tutorial Hours">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <input type="number" class="form-control" name="ph" placeholder="Practical Hours">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <input type="number" class="form-control" name="spw" placeholder="SPW">
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="submit" class="btn btn-center btn-50 btn-outline-primary" name="add-course" value="Add Course">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once('footer.php');
?>