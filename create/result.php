<?php
	$data = simplexml_load_file("../data.xml") or die("Error: No data");
	$id = intval($data->users["currentid"]);
	$data->users["currentid"] = $id + 1;
	
	$user = $data->users->addChild("user");


	// USERNAME
	$username = $_POST["username"];
	if (strlen($username) < 3)
		die("Username too short (min 3 chars)");

	if (strlen($username) > 24)
		die("Username too long (max 24 chars)");

	if ($data->users->xpath("user[@username=\"$username\"]")[0])
		die("Username $username already exists");


	// DISPLAY NAME
	$displayname = $_POST["displayname"];
	if (strlen($displayname) == 0)
		$displayname = $username;

	if (strlen($displayname) > 32)
		die("Display name too long (max 32 chars)");


	// AVATAR
	$avatar = $_POST["avatar"];


	// PRONOUNS
	$pronouns = implode(",", preg_split("/[^A-Za-z]+/", $_POST["pronouns"]));


	// LOCATION
	$location = $_POST["location"];


	// BIRTHDAY
	$birthday = strtotime($_POST["birthday"]);
	

	// COLOR
	$color = str_replace("#", "", $_POST["color"]);


	// PASSWORD
	$password = $_POST["password"];

	
	$user->addAttribute("id", $id);
	$user->addAttribute("username", $username);
	$user->addAttribute("displayname", $displayname);
	$user->addAttribute("avatar", $avatar);
	$user->addAttribute("pronouns", $pronouns);
	$user->addAttribute("location", $location);
	$user->addAttribute("borntimestamp", $birthday);
	$user->addAttribute("color", $color);
	$user->addAttribute("createdtimestamp", time());
	$user->addAttribute("password", $password);
	
	$data->asXML("../data.xml");

	
	// redirect to newly created page
	header("Location: ../index.php?id=$id");
	die();
?>