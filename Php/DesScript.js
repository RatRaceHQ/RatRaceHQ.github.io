function showDiv(str) {
		
		  if (str=="") {
			document.getElementById("DivLoad").innerHTML="";
			return;
		  } 
		  if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200 ) {
			  document.getElementById("DivLoad").innerHTML=xmlhttp.responseText;
			}
		  }
		  xmlhttp.open("GET","php/GetDiv.php?q="+str,true);
		  xmlhttp.send();
		}
		

function LoadContentonclick(mdl,Div,Num) {
		
		  if (mdl=="") {
			document.getElementById("MainSession").innerHTML="";
			return;
		  } 
		  if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200 ) {
			  document.getElementById("MainSession").innerHTML=xmlhttp.responseText;
			}
		  }
			var str1 = "php/MainSession.php?q="+mdl;
			var str2 = "&d="+Div;
			var str3 = "&n="+Num;
			var res = str1.concat(str2,str3);
		  xmlhttp.open("GET",res,true);
		  xmlhttp.send();
		}