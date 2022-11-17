<!DOCTYPE html>
<html lang="en">


<?php
$id = 0;
if (isset($_GET["id"])) {
	$id = intval(htmlspecialchars($_GET["id"]));
}

$data = simplexml_load_file("../data.xml")->users->xpath("user[@id=\"$id\"]")[0] or die("Error: No data");
?>


<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update user</title>

	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/form.css">
</head>

<body>
	<h1>Manage account @<?= $data["username"] ?></h1>
	<form action="update/result.php" method="post">
		<div style="display: none">
			<input type="text" id="id" name="id" value="<?= $id ?>" />
		</div>

		<div style="display: none">
			<input type="text" id="username" name="username" value="<?= $data["username"] ?>" />
		</div>

		<div class="form-field">
			your password: <input type="password" id="password" name="password" size="64" pattern=".{12,64}" />
			<span class="validity"></span>
		</div>

		<div class="form-field">
			display name: <input type="text" id="displayname" name="displayname" size="33" placeholder="My Name"
				pattern=".{1,32}" value="<?= $data["displayname"] ?>" />
			<span class="validity"></span>
			(max 32 chars)
		</div>

		<div class="form-field">
			pronouns: <input type="text" id="pronouns" name="pronouns" size="33" placeholder="he, she, they"
				pattern="([A-Za-z]{1,10}[^A-Za-z]*){0,5}" value="<?= $data["pronouns"] ?>" />
			<span class="validity"></span>
			(max 5 pronouns, separated with any non-letters)
		</div>

		<div class="form-field">
			location: <input type="text" id="location" name="location" size="65" placeholder="The Universe"
				pattern=".{1,64}" value="<?= $data["location"] ?>" />
			<span class="validity"></span>
			(max 64 chars)
		</div>

		<div class="form-field">
			birthday: <input type="date" id="birthday" name="birthday" value="<?= $data["borntimestamp"] ?>" />
		</div>

		<div class="form-field">
			profile color: <input type="color" id="color" name="color" value="#<?= $data["color"] ?>" />
		</div>

		<div class="form-field">
			profile avatar: <input type="text" id="avatar" name="avatar" size="64" pattern="https*:\/\/[\w%\?\/\.=]+"
				value="<?= $data["avatar"] ?>" />
			<span class="validity"></span>
			(only link)
		</div>

		<div class="form-field">
			<input type="submit" value="update" />
		</div>
	</form>

	<div class="go-back">
		<a href=" ../?id=<?= $id ?>">
			Go back
		</a>
	</div>

	<div class="delete-account">
		<a href=" ../delete?id=<?= $id ?>">
			Delete your account
		</a>
	</div>
</body>

</html>