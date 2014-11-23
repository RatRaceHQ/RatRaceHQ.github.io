<?php

Function LoadNavArrow($Present,$Max,$Module1,$Content1){

//Connect
		include("dbinfo.inc.php");
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
	echo "</div>";
	
	$sql = "SELECT Distinct(Content_num) FROM main_table WHERE Division='".$Content1."' AND Module='".$Module1."' ORDER BY Content_num ASC ";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		$i=1;
		while($row = $result->fetch_assoc()) {
			if ($i==$Present){
				$j=$row["Content_num"];
				break;
			}
			$i=$i+1;
		}
		$sql = "SELECT * FROM main_table WHERE Division='".$Content1."' AND Module='".$Module1."' AND Content_num = '".$j."'ORDER BY Content_order ASC ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			$i=1;
			while($row = $result->fetch_assoc()) {
				if ($i==1){
				echo "<h4>".$row["Content"]."</h4>";
				}else{
				echo "<p>".$row["Content"]."</p>";
				}
			
			$i=$i+1;
			}
		}
		
	}
	
	echo "</div>";
	if ($Present==1){
	echo "<a href='#' class='navigation navigation-prev'><i class='fa fa-angle-left'></i></a>";
	}else{
	$i=$Present-1;
	echo "<a onclick=LoadContentonclick('".$Module1."','".$Content1."','".$i."') class='navigation navigation-prev'><i class='fa fa-angle-left'></i></a>";
	}
	
	if ($Present==$Max){
	echo "<a href='#' class='navigation navigation-next'><i class='fa fa-angle-right'></i></a>";
	}else{
	$i=$Present+1;
	//echo $i;
	// echo "<a href='index.php?Module=".$Module1."&Content=".$Content1."&Content_Num=".$i."' class='navigation navigation-next'><i href='index.php?Module=".$Module1."&Content=".$Content1."&Content_Num=".$i."' class='fa fa-angle-right'></i></a>";
	echo "<a onclick=LoadContentonclick('".$Module1."','".$Content1."','".$i."') class='navigation navigation-next'><i class='fa fa-angle-right'></i></a>";
	}
	
	
	echo "</div>";
	$conn->close();
}

function LoadDiv($Module1){
//Connect
	include("dbinfo.inc.php");
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	///
			$sql = "SELECT distinct(Module) FROM main_table WHERE Module='".$Module1."' ORDER BY Module ASC Limit 1";
			$result = $conn->query($sql);
			
					if ($result->num_rows > 0){
						while($row = $result->fetch_assoc()) {
							$sql = "SELECT Distinct(Division) FROM main_table WHERE Module='".$Module1."' ORDER BY Division ASC ";	
							$result = $conn->query($sql);
							if ($result->num_rows > 0){
								while($row = $result->fetch_assoc()) {
									$mdl=str_replace(" ","-",$Module1);
									$Div=str_replace(" ","-",$row["Division"]);
									//$mdl=str_replace(" ","-",$Module1);
									//$Div=str_replace(" ","-",$row["Division"]);
									echo "<li><a ID='".$mdl."','".$Div."','1'   onclick=LoadContentonclick('".$mdl."','".$Div."','1') >".$row["Division"]."</a></li>";
									}
							}						
						}
					}else{
						$sql = "SELECT distinct(Module) FROM main_table ORDER BY Module ASC Limit 1";
						$result = $conn->query($sql);
			
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
									$Mdl=$row["Module"];
								}
									$sql = "SELECT Distinct(Division) FROM main_table WHERE Module='".$Mdl."' ORDER BY Division ASC ";	
								$result = $conn->query($sql);
								if ($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										$mdl=str_replace(" ","-",$Mdl);
									$Div=str_replace(" ","-",$row["Division"]);
									echo "<li><a ID='".$mdl."','".$Div."','1'   onclick=LoadContentonclick('".$mdl."','".$Div."','1') >".$row["Division"]."</a></li>";
									}
							}		
							}
						
					}					
	$conn->close();	
}

Function MainCont($Module1,$Content1,$Content_num1){
		//Connect
		include("dbinfo.inc.php");
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		if ($Module1==''){
		
			$sql = "SELECT distinct(Module) FROM main_table ORDER BY Module ASC Limit 1";
			$result = $conn->query($sql);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						$Mdl="".$row["Module"]."";
					}
				}
				$sql = "SELECT Division FROM main_table WHERE Module='".$Mdl."' ORDER BY Division ASC Limit 1";	
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						$Divtmp="".$row["Division"]."";
					}
					$sql = "SELECT Distinct(Content_num) FROM main_table WHERE Division='".$Divtmp."'  ";	
					$result = $conn->query($sql);
					echo "<h6 >1/".$result->num_rows."<!--numbering for large screens--></h6>";
					LoadNavArrow(1,$result->num_rows,$Mdl,$Divtmp);
				}
		} else {
			
			$sql = "SELECT distinct(Module) FROM main_table WHERE Module='".$Module1."' ORDER BY Module ASC Limit 1";
			$result = $conn->query($sql);
					if ($result->num_rows > 0){
						while($row = $result->fetch_assoc()) {
							$Mdl="".$row["Module"]."";
						}
						$sql = "SELECT Distinct(Content_num) FROM main_table WHERE Division='".$Content1."' AND Module='".$Module1."' ORDER BY Module ASC ";
						$result = $conn->query($sql);
						if ($result->num_rows > 0){
						
							if ($result->num_rows < $Content_num1 || $Content_num1=="" ){
								$Content_num1=1;
							}
							echo "<h6 >".$Content_num1."/".$result->num_rows."<!--numbering for large screens--></h6>";
							LoadNavArrow($Content_num1,$result->num_rows,$Module1,$Content1);
							
						}else {
							$sql = "SELECT Division FROM main_table WHERE Module='".$Mdl."' ORDER BY Division ASC Limit 1";	
							$result = $conn->query($sql);
							if ($result->num_rows > 0){
								while($row = $result->fetch_assoc()) {
								$Divtmp="".$row["Division"]."";
							}
							$sql = "SELECT Distinct(Content_num) FROM main_table WHERE Division='".$Divtmp."'  ";	
							$result = $conn->query($sql);
							echo "<h6 >1/".$result->num_rows."<!--numbering for large screens--></h6>";
							LoadNavArrow(1,$result->num_rows,$Mdl,$Divtmp);
							}
						}						
					}else{
							$sql = "SELECT distinct(Module) FROM main_table ORDER BY Module ASC Limit 1";
							$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								$Mdl="".$row["Module"]."";
							}
						}
						$sql = "SELECT Division FROM main_table WHERE Module='".$Mdl."' ORDER BY Division ASC Limit 1";	
						$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								$Divtmp="".$row["Division"]."";
							}
							$sql = "SELECT Distinct(Content_num) FROM main_table WHERE Division='".$Divtmp."'  ";	
							$result = $conn->query($sql);
							echo "<h6 >1/".$result->num_rows."<!--numbering for large screens--></h6>";
							LoadNavArrow(1,$result->num_rows,$Mdl,$Divtmp);
						}
					}
			
		}
		
		$conn->close();



}

Function Infobar($Module1,$Content1){
		//Connect
		include("dbinfo.inc.php");
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		if ($Module1==''){
		
			$sql = "SELECT distinct(Module) FROM main_table ORDER BY Module ASC Limit 1";
			$result = $conn->query($sql);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						echo "<p>".$row["Module"]."<span>>";
						$Mdl="".$row["Module"]."";
					}
				}
			$sql = "SELECT Division FROM main_table WHERE Module='".$Mdl."' ORDER BY Division ASC Limit 1";	
			$result = $conn->query($sql);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						echo "<span/>".$row["Division"]."</p></div>";
					}
				}
		} else {
			
			$sql = "SELECT distinct(Module) FROM main_table WHERE Module='".$Module1."' ORDER BY Module ASC Limit 1";
			$result = $conn->query($sql);
					if ($result->num_rows > 0){
						while($row = $result->fetch_assoc()) {
							echo "<p>".$row["Module"]."<span>>";
							$Mdl="".$row["Module"]."";
						}
						$sql = "SELECT Division FROM main_table WHERE Division='".$Content1."' AND Module='".$Module1."' ORDER BY Module ASC Limit 1";
						$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								echo "<span/>".$row["Division"]."</p></div>";
							}
						}else {
							$sql = "SELECT Division FROM main_table WHERE Module='".$Mdl."' ORDER BY Division ASC Limit 1";	
							$result = $conn->query($sql);
							if ($result->num_rows > 0){
								while($row = $result->fetch_assoc()) {
									echo "<span/>".$row["Division"]."</p></div>";
								}
							}
						}						
					}else{
							$sql = "SELECT distinct(Module) FROM main_table ORDER BY Module ASC Limit 1";
							$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								echo "<p>".$row["Module"]."<span>>";
								$Mdl="".$row["Module"]."";
							}
						}
							$sql = "SELECT Division FROM main_table WHERE Module='".$Mdl."' ORDER BY Division ASC Limit 1";	
							$result = $conn->query($sql);
						if ($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								echo "<span/>".$row["Division"]."</p></div>";
							}
						}
					}
			
		}
		
		$conn->close();
	}

function selectmodule($Module1){	
	//Connect
	include("dbinfo.inc.php");
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	///
	
	if ($Module1==''){
	$Module1="Select";
	}
	echo "<form><select name='Module' class='dropdown' onchange='showDiv(this.value)'>";
	// echo "<option value='value0'>";
	// echo $Module1;
	// echo "</option>";
	// Create connection
	

	$sql = "SELECT distinct(Module) FROM main_table";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		
		// output data of each row
		$i=1;
		while($row = $result->fetch_assoc()) {
		
		 if ($Module1=="".$row["Module"]."")
		 { 
			$Selct='Selected';
		}
		else
		{
			$Selct='';
		 }
			echo  "<option value='".$row["Module"]."";		
			echo  "' ";
			echo $Selct;
			echo ">".$row["Module"]."</option>";
			$i=$i+1;	
		}
		
	} else {
		echo "0 results";
	}
	$conn->close();
	echo 		"</select></form>";
}
?>
