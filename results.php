<?php
    require_once('header.php');
?>

<div class="main-wrapper">
    <div class="container-fluid results">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Results</h1>
            </div>
        </div>
        <div class="row">
           <div class="col-4 text-center icon">
                <a href="results.view.php"><span><i class="fa fa-eye"></i></span></a>
            </div>
            <div class="col-4 text-center icon">
                <a href="results.add.php"><span><i class="fa fa-plus"></i></span></a>
            </div>
            <div class="col-4 text-center icon">
                <a href="results.edit.php"><span><i class="fa fa-refresh"></i></span></a>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="results">
        
    </div>
</div>

<?php 
    require_once('footer.php');
?>