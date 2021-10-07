<!DOCTYPE html>
<html>
	<head>
		<title>Hawkshaw :: mod</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php
		// WARNING! WARNING!
		// this could easily be the source of race conditions!

		$txt = file_get_contents('./data.json');
		$obj = json_decode($txt, true);

		// process the parents text
		// TODO : handle if an input is not an int
		if (count($_POST['parents']) != 0) {
			$parents = explode(",", $_POST['parents']);
			// convert to ints
			$parents = array_map('intval', $parents);
		} else {
			$parents = null;
		}

		// process the tags
		// TODO : slim this down
		$tags = array();
		if ($_POST['todo'] == 'on') {
			$j = array(
				"color" => "#666666",
				"name" => "todo"
			);
			array_push($tags, $j);
		}
		if ($_POST['progress'] == 'on') {
			$j = array(
				"color" => "#ff0000",
				"name" => "in progress"
			);
			array_push($tags, $j);
		}
		if ($_POST['done'] == 'on') {
			$j = array(
				"color" => "#00ff00",
				"name" => "done"
			);
			array_push($tags, $j);
		}


		$a = array(
			// the id is the length of the array (current id + 1)
			"id" => count($obj),
			"name" => $_POST['name'],
			"type" => $_POST['type'],
			"tags" => $tags,
			"parents" => $parents,
			"deleted" => false
		);

		array_push($obj, $a);
		$json = json_encode($obj);
		file_put_contents('./data.json', $json);

		echo '<p>Submission successfully added! <a href="/">Go back?</a></p>';

		?>
	</body>
</html>
