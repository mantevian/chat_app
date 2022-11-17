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
	<title>Delete user</title>

	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/form.css">
</head>


<body>
	<h1>Delete account @<?= $data["username"] ?></h1>

	<form action="delete/result.php" method="post">
		<div class="form-field">
			your tag: @<input type="text" id="username" name="username" value="<?= $data["username"] ?>" readonly />
			<span class="validity"></span>
		</div>

		<div class="form-field">
			your password: <input type="password" id="password" name="password" size="64" pattern=".{12,64}" />
			<span class="validity"></span>
		</div>

		<div class="form-field">
			<input type="submit" value="delete" />
		</div>
	</form>

	<div class="go-back">
		<a href=" ../update?id=<?= $id ?>">
			Go back
		</a>
	</div>
</body>

</html>