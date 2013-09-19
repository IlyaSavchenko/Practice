<?php
	function main() {
		session_start();
		$table = $_SESSION["table"];
		$file = CreateFile($table);
			SendFile($file);
	}

	function CreateFile($table) {
		$rowprefix = "\\trowd\\trql\ltrrow\\trpaddft3\\trpaddt0\\trpaddfl3\\trpaddl0\\trpaddfb3\\trpaddb0\\trpaddfr3\\trpaddr0\\clbrdrt\\brdrhair\\brdrw1\\brdrcf1\\clbrdrl\\brdrhair\\brdrw1\\brdrcf1\\clbrdrb\\brdrhair\\brdrw1\\brdrcf1\\cellx2000\\clbrdrt\\brdrhair\\brdrw1\\brdrcf1\\clbrdrl\\brdrhair\\brdrw1\\brdrcf1\\clbrdrb\\brdrhair\\brdrw1\\brdrcf1\\clbrdrr\\brdrhair\\brdrw1\\brdrcf1\\cellx2500\\pgndec\\pard\\plain";
		$rowpostfix = "}\\cell\\row\pard";
		$cellprefix = "\\s20\\noline\\intbl{\\rtlch\\ltrch\\loch ";
		$cellpostfix = "}\\cell\\pard\\plain";


		$fileName = "../Marks of ".$table["name"].".rtf";
		$fd = fopen($fileName, 'wt');
		fwrite($fd, "{\\rtf1\\ansi\\ansicpg1251\\deff0{\\fonttbl{\\f0\\froman\\fcharset204{\\*\\fname Times New Roman;}Times New Roman CYR;}{\\f1\\froman Times New Roman;}}");
		fwrite($fd, "Marks for ".$table["name"].".\\par");
		foreach ($table["marks"] as $key => $value) {
			fwrite($fd, $rowprefix . $cellprefix . $key . $cellpostfix . $cellprefix . $value . $rowpostfix);
		}
		fwrite($fd, "}");
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
		} 
		else {
		      header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		      header('Status: 404 Not Found');
		}
		exit;
	}

	main();
?>