<!DOCTYPE html>
<html lang="en">
	<?php include 'head.php'?>
	<body class="nav-md">
	<div class="container body">
	  <div class="main_container">
	  	<?php include 'sidebar.php';?>
	  	<?php include 'header.php';?>

        <!-- page content -->
        <div class="right_col" role="main">
          <?=$content?>
        </div>
        <?php include 'footer.php'?>
	  </div>
	</div>
	<?php include 'javascript.php'?>
	</body>
</html>