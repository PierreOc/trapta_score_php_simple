<?php
    $eventname = "Tir non nommé";
	if (isset($_POST['eventname'])) $eventname = $_POST['eventname'];
	// modef 26 dec 2023 Pierre
    //$eventname = substr(preg_replace('/{}();:,.=@#$/', '', $eventname), 50);
	if (strlen($eventname)>1)
	{
		$eventnameFile = fopen("eventname.txt","w");
		fwrite($eventnameFile,$eventname);
		fclose($eventnameFile);
	}
