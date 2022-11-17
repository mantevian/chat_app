<?php
	$data = simplexml_load_file("../data.xml") or die("Error: No data");

	// USERNAME
	$username = $_POST["username"];

	$user = $data->users->xpath("user[@username=\"$username\"]")[0];

	// LOGIN
	if (!$user)
		die("Username $username doesn't exist");
	
	if ($_POST["password"] != $user["password"])
		die("Password doesn't match");


	unset($data->users->xpath("user[@username=\"$username\"]")[0][0]);
	
	$data->asXML("../data.xml");

	print("User @$username successfully deleted");
?>