<?php
	$data = simplexml_load_file("../data.xml") or die("Error: No data");


	// USERNAME
	$id = $_POST["id"];

	$user = $data->users->xpath("user[@id=\"$id\"]")[0];

	
	// LOGIN
	if (!$user)
		die("That user doesn't exist");

	if ($_POST["password"] != $user["password"])
		die("Password doesn't match");


	$username = $user["username"];


	// DISPLAY NAME
	$displayname = $user["displayname"];
	if (strlen($_POST["displayname"]) != 0)
		$displayname = $_POST["displayname"];

	if (strlen($displayname) > 32)
		die("Display name too long (max 32 chars)");


	// AVATAR
	$avatar = $user["avatar"];
	if (strlen($_POST["avatar"]) != 0)
		$avatar = $_POST["avatar"];


	// PRONOUNS
	$pronouns = $user["pronouns"];
	if (strlen($_POST["pronouns"]) > 0)
		$pronouns = implode(",", preg_split("/[^A-Za-z]+/", $_POST["pronouns"]));


	// LOCATION
	$location = $user["location"];
	if (strlen($_POST["location"]) > 0)
		$location = $_POST["location"];


	// BIRTHDAY
	$birthday = $user["birthday"];
	if (strlen($_POST["birthday"]) > 0)
		$birthday = strtotime($_POST["birthday"]);


	// COLOR
	$color = $user["color"];
	if (strlen($_POST["color"]) > 0)
		$color = str_replace("#", "", $_POST["color"]);

	
	$user["displayname"] = $displayname;
	$user["avatar"] = $avatar;
	$user["pronouns"] = $pronouns;
	$user["location"] = $location;
	$user["borntimestamp"] = $birthday;
	$user["color"] = $color;
	
	$data->asXML("../data.xml");

	
	// redirect to the updated page
	header("Location: ../index.php?id=$id");
	die();
?>