<?php
	$data = simplexml_load_file("data.xml") or die();

	foreach ($data->users->children() as $user) {
		$avatar = $data["avatar"];
		if (strlen($avatar) == 0)
			$avatar = "assets/default_avatar.jpg";
?>

<div class="nav-line" title="<?= $user["displayname"] ?> @<?= $user["username"] ?>">
	<a class="nav-button" href="?id=<?= $user["id"] ?>">
		<img src="<?= $avatar ?>" />
	</a>
	<div class="nav-username">
		<?= $user["displayname"] ?> @<?= $user["username"] ?>
	</div>
</div>

<?php
	}
?>

<div class="nav-line" title="Create">
	<a class="nav-button" href="/create">
		<img src="assets/add.png" style="opacity: 0.3"/>
	</a>
	<div class="nav-username">
		Create
	</div>
</div>