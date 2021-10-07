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

		$id = intval($_POST['id']);

		foreach ($obj as $key => $val) {
			if ($val['id'] == $id) {
				$obj[$key]['deleted'] = true;
			}
		}		

		$json = json_encode($obj);
		file_put_contents('./data.json', $json);

		echo '<p>Submission successfully deleted! <a href="/">Go back?</a></p>';

		?>
	</body>
</html>
