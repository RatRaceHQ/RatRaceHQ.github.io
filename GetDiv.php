<?php
$Module1 = $_GET['q'];

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
	?>