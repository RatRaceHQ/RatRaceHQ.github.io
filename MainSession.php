<?php
$Module1 = str_replace("-"," ",$_GET['q']);
$Division1 = str_replace("-"," ",$_GET['d']);
$Content_num1 = $_GET['n'];
include('Funcphp.php');
include('dbinfo.inc.php');
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die('Connection failed: ' . $conn->connect_error);
	} 
	
			echo "<div class='breadcrumb_container row'><!--breadcrumb-->
					<div class='breadcrumb small-6 large-12 medium-12 columns'>
					<p>".$Module1."<span>><span/>".$Division1."</p></div> 
					<!--numbering for small screens-->
					<div class='counter-mobile small-6 show-for-small-only columns'></div>
					</div>

					<div class='page-wrapper row'><!--content-->
					<div class='content-wrapper'>
					<div class='visible-for-medium-up'>";
						$sql = "SELECT Distinct(Content_num) FROM main_table WHERE Division='".$Division1."' AND Module='".$Module1."' ORDER BY Module ASC ";
						$result = $conn->query($sql);
						if ($result->num_rows > 0){
						
							if ($result->num_rows < $Content_num1 || $Content_num1=="" ){
								$Content_num1=1;
							}
							echo "<h6 >".$Content_num1."/".$result->num_rows."<!--numbering for large screens--></h6>";
							LoadNavArrow($Content_num1,$result->num_rows,$Module1,$Division1);
							}
	$conn->close();	
	?>