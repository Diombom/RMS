<?php
    require_once('header.php');
?>

<div class="main-wrapper">
    <div class="container-fluid content">
        <div class="row">
            <div class="col-12 text-center"><h3>Programs</h3></div>
        </div>
        <div class="row">
            <div class="col-12 text-center w-60">
                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Program</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach(mysqli_query($conn, "SELECT * FROM program") as $program){
                    ?>
                        <tr>
                            <td><?php echo $program['id']; ?></td>
                            <td><?php echo ucfirst($program['name']); ?></td>
                            <td><a href="courses.php?p_name=<?php echo $program['name'] ?>" class="btn btn-outline-primary">View Courses</a></td>
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
    require_once('footer.php');
?>