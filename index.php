<!DOCTYPE html>
<html lang="en">


<?php
date_default_timezone_set('Europe/Moscow');

$id = 0;
if (isset($_GET["id"])) {
	$id = intval(htmlspecialchars($_GET["id"]));
}

$currentuser = simplexml_load_file("data.xml")->users->xpath("user[@id=\"$id\"]")[0] or die("Error: No data");

$avatar = $currentuser["avatar"];
if (strlen($avatar) == 0)
	$avatar = "assets/default_avatar.jpg";

$hexcolor = $currentuser["color"];
list($red, $green, $blue) = sscanf("$hexcolor", "%02x%02x%02x");
?>


<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $currentuser["username"] ?>
	</title>

	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/index.css">

	<style>
		:root {
			--accent: rgb(<?= "$red, $green, $blue" ?>);
			--accent-60: rgb(<?= "$red, $green, $blue, 0.6" ?>);
			--accent-30: rgb(<?= "$red, $green, $blue, 0.3" ?>);

			--text-on-custom-color: rgb(<?= ($red * 0.299 + $green * 0.587 + $blue * 0.114 > 186) ? "60, 60, 60" : "230, 230, 230"; ?>)
		}
	</style>
</head>

<body>
	<div id="header" class="generic-block">
		<label for="burger-checkbox" id="burger-button">
			<img src="assets/menu-burger.png" />
		</label>

		<div id="logo">
			<div></div>
		</div>

		<a id="settings-button" href="/update?id=<?= $id ?>">
			<img src="assets/settings.png" />
		</a>
	</div>

	<div id="main">
		<input id="burger-checkbox" type="checkbox" />

		<div id="nav">
			<?php
				include("list.php");
			?>
		</div>

		<div id="profile">
			<div id="profile-info">
				<div id="profile-main-block" class="generic-block">
					<div id="banner-wrapper">
						<div id="banner"></div>

						<img id="avatar" src="<?= $avatar ?>" />
					</div>

					<div id="profile-main-info">
						<div id="user-display-name">
							<?= $currentuser["displayname"] ?>
						</div>

						<div id="user-tag">
							@<?= $currentuser["username"] ?>
						</div>

						<div id="user-bio">
							<?= str_replace("\n", "<br>", $currentuser["bio"]); ?>
						</div>
					</div>
				</div>

				<div id="profile-secondary-block">
					<div id="profile-buttons" style="border-top: 2\px solid var(--background-dark);">
						<button id="follow-button">
							Follow
						</button>

						<button id="message-button">
							Message
						</button>
					</div>

					<div id="user-follow-info" style="border-bottom: 2px solid var(--background-dark);">
						<div>
							<div class="follow-number">50</div>
							followers
						</div>

						<div>
							<div class="follow-number">50</div>
							following
						</div>
					</div>

					<div id="user-pronouns">
						<?php
							foreach (explode(",", $currentuser["pronouns"]) as $pronoun) {
							?>
						<div class="pronoun">
							<?= $pronoun ?>
						</div>
						<?php
							}
							?>

					</div>

					<div id="user-additional-info">
						<div id="user-location">
							<img src="assets/location.png" />
							<?= $currentuser["location"] ?>
						</div>

						<div id="user-birthday">
							<img src="assets/birthday.png" />
							Born <?= date("j F Y", intval($currentuser["borntimestamp"])) ?>
						</div>

						<div id="user-join-date">
							<img src="assets/calendar.png" />
							Joined <?= date("j F Y", intval($currentuser["createdtimestamp"])) ?>
						</div>
					</div>
				</div>
			</div>

			<div id="profile-posts">
				<div id="create-post" class="generic-block">
					<textarea rows="3"></textarea>
					<button>Post</button>
				</div>

				<div class="post generic-block">
					<a class="post-heading">
						<img class="post-avatar" src="<?= $avatar ?>" />
						<div class="post-author">
							<div class="post-author-name">
								<?= $currentuser["displayname"] ?>
							</div>
							<div class="post-author-tag">@<?= $currentuser["username"] ?>
							</div>
						</div>
					</a>
					<div class="post-text">
						hello world
					</div>
					<div class="post-timestamp">
						<?= date("Y-m-d H:i:s") ?>
					</div>
					<div class="post-reactions">
						<div class="add-reaction-button">
							<img src="assets/add.png" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>