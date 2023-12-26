<?php
	include "passwordcheck.php";
	$tabHeaderMatches = '<div class="bs-example table-responsive"><table class="table table-striped table-bordered"><thead><tr><th>Rang</th><th></th><th>Nom</th><th>Volée 1</th><th>Volée 2</th><th>Volée 3</th><th>Volée 4</th><th>Volée 5</th><th>Score</th></tr></thead><tbody>';
	$tabFooter = '</tbody></table></div>';
	$password = "";
	if (isset($_POST['password'])) $password = $_POST['password'];
	if ($password=="" || $password!=$passwordcheck) {
		header('HTTP/1.0 401 Unauthorized');
		die();
	}
	
	// Write event name in a file
	include "saveeventname.php";

	$jsonData = stripslashes($_POST['data']);
	$obj = json_decode($jsonData);
	$file = fopen("matches.html","w");
	$roundTitle = $obj->{'title'};
	fwrite($file,'<h2>'.$roundTitle.'</h2>');
	$targetList = $obj->{'targetList'};
	foreach ($targetList as $target) {
		$targetId = $target->{'target'};
		$categName = $target->{'categ'};
		$markerList = $target->{'markerList'};
		$winner = $target->{'winner'};
		$tieBreak = $target->{'tieBreak'};
		$archerArray = $target->{'archerList'};

		fwrite($file,'<h2>CIBLE '.$targetId.' - '.$categName.'</h2>');
		fwrite($file,$tabHeaderMatches);
		
		$archerIndex = 0;
		foreach ($archerArray as $archer) {
			$name = $archer->{'name'};
			$rank = $archer->{'initialRank'};
			$score = $archer->{'score'};
			if ($tieBreak && $winner==$archerIndex && count($markerList)>0) $score++;
			fwrite($file, '<tr>');
			fwrite($file, '<td>'.$rank.'</td>');
			if ($winner==$archerIndex) fwrite($file, '<td><img src="./images/greenspot.png"></td>');		
			else fwrite($file, '<td><img src="./images/redspot.png"></td>');		
			fwrite($file, '<td>'.$name.'</td>');
			$volleyList = $archer->{'volleyList'};
			$volleyIndex=0;
			foreach ($volleyList as $volley) {
				if ($volley<0) $volley='';
				if (count($markerList)>$volleyIndex && $markerList[$volleyIndex]==$archerIndex) fwrite($file, '<td>'.$volley.'&nbsp;<span class="badge">&nbsp;</span></td>');		
				else fwrite($file, '<td>'.$volley.'</td>');		
				$volleyIndex++;
			}
			for ($i=$volleyIndex; $i<5; $i++) fwrite($file, '<td></td>');		
			fwrite($file, '<td>'.$score.'</td>');
					
			fwrite($file, '</tr>');
			$archerIndex++;
		}
		fwrite($file, $tabFooter);
	}

	$timestampFile = fopen("timestamp.json","w");
	fwrite($timestampFile,'{"timestamp":'.time().'}');
	fclose($timestampFile);
?>