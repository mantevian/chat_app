<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>

	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/form.css">
</head>

<body>
	<form action="create/result.php" method="post">
		<div class="form-field">
			tag: @<input type="text" id="username" name="username" required size="33" placeholder="my_epic_tag"
				pattern="[A-Za-z0-9_]{3,24}" />
			<span class="validity"></span>
			(only letters, numbers and underscores, max 24 chars)
		</div>

		<div class="form-field">
			display name: <input type="text" id="displayname" name="displayname" size="33" placeholder="My Name"
				pattern=".{1,32}" />
			<span class="validity"></span>
			(optional, max 32 chars)
		</div>

		<div class="form-field">
			pronouns: <input type="text" id="pronouns" name="pronouns" size="33" placeholder="he, she, they"
				pattern="([A-Za-z]{1,10}[^A-Za-z]*){0,5}" />
			<span class="validity"></span>
			(optional, max 5 pronouns, separated with any non-letters)
		</div>

		<div class="form-field">
			location: <input type="text" id="location" name="location" size="65" placeholder="The Universe"
				pattern=".{1,64}" />
			<span class="validity"></span>
			(optional, max 64 chars)
		</div>

		<div class="form-field">
			birthday: <input type="date" id="birthday" name="birthday" />
			(optional)
		</div>

		<div class="form-field">
			profile color: <input type="color" id="color" name="color" />
		</div>

		<div class="form-field">
			profile avatar: <input type="text" id="avatar" name="avatar" size="64" pattern="https*:\/\/[\w%\?\/\.=]+" />
			<span class="validity"></span>
			(only link, optional)
		</div>

		<div class="form-field">
			password: <input type="password" id="password" name="password" size="64" pattern=".{12,64}" />
			<span class="validity"></span>
			(min length 12)
		</div>

		<div class="form-field">
			<input type="submit" value="register" />
		</div>
	</form>
</body>

</html>