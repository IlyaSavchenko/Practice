<?php @session_start();
	function main() {
		$table = $_SESSION["export"];
		if ($table != null) {
			$file = CreateFile($table);
			SendFile($file);
		}
		else 
			echo "We so sorry, but we does not have information for export :(";
	}

	function CreateFile($table) {
		$fileName = "../Marks of " . $table["name"].".txt";
		$fd = fopen($fileName, 'wt');
		fwrite($fd, "Marks for ".$table["name"].".\n");
		foreach ($table["marks"] as $key => $value) {
			fwrite($fd, $key.": ".$value."\n");
		}
		fclose($fd);
		return $fileName;
	}

	function SendFile($filename) {
		if (file_exists($filename)) {
		    header($_SERVER["SERVER_PROTOCOL"] . ' 200 OK');
		    header('Content-Type: application/octet-stream');
		    header('Last-Modified: ' . gmdate('r', filemtime($filename)));
		    header('ETag: ' . sprintf('%x-%x-%x', fileinode($filename), filesize($filename), filemtime($filename)));
		    header('Content-Length: ' . (filesize($filename)));
		    header('Connection: close');
		    header('Content-Disposition: attachment; filename="' . basename($filename) . '";');
		    $f=fopen($filename, 'r');
		    while(!feof($f)) {
		      echo fread($f, 1024);
		      flush();
		    }
		    fclose($f);
		    unlink($filename);
		} 
		else {
		      header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		      header('Status: 404 Not Found');
		}
		exit;
	}


	main();
?>