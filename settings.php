<?php
	if ((isset($_SESSION['exit']) && $_SESSION['exit'] == true) || isset($_POST['Exit'])) {
		$_SESSION['login'] = null;
		$_SESSION['exit'] = true;
		$_SESSION['loginchoose'] = null;
		 echo "<script>document.location.replace('./index.php');</script>";
		 exit;
	}
?><html>
	<head>
		<link  rel="stylesheet" type="text/css"/href="test.css">
		<title>
			Settings
		</title>
		<link  rel="stylesheet" type="text/css"/href="test.css">
        <style>
        body {
            background: url(image/bgg.png) no-repeat;
            background-size: 100%; /* Современные браузеры */
        }
        </style>
    </head>
    <body>
    	<form action="./home.php" method="post" enctype="multipart/form-data">
    	<table border="0" align="center" width="100%">
    		<tr>	
    			<td align="center">
    				<img src='image/bigHead.png' alt='Stud Journal'>
 				</td>
    		</tr>
    		<tr>
    			<td align = "center">
    				<table border = "0" cellpadding="10" cellspacing="10">
    					<tr>
    						<td align = "left">
    							<h3><font color='#4360c0' face='Myriad Pro'>Profile picture:</font></h3>
    						</td>
    						<td valign = "top" align = "left">
								<input type="file" name="avatar" id="file" />
    						</td>
    					</tr>
    				</table>
    			
    			</td>
    		</tr>
    		<tr>
    			<td align = "center" >
    				<input type = "submit" name = "save_settings" value = "" class = "savest">
    			</td>
    		</tr>
		</table>
		</form>
    </body>
</html>