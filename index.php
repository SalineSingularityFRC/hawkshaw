<!DOCTYPE html>
<html>
	<head>
		<title>Hawkshaw</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
	</head>
	<body>
		<h1>Hawkshaw</h1>

		<span><a href="/add.html">add item</a> <a href="/del.html">delete item</a></span>

		<br/><br/>

		<!-- this is where the database data goes -->
		<table id="db-table">
			<!-- headers -->
			<tr>
				<th>ID</th>
				<th>Type</th>
				<th>Name</th>
				<th>Tags</th>
				<th>Parents</th>
			</tr>

			<?php
			// WARNING! WARNING!
			// PHP IS AN INSECURE LANGUAGE, AND I DO NOT KNOW WHAT I'M DOING
			// perhaps we can get ness to pentest this for me...

			// generate an html cell ('<td>' element)
			function cell($a) {
				echo '<td>' . $a . '</td>';
			}

			// make an id that is linkable
			function id($a) {
				echo '<td id="item-' . $a . '">' . $a . '</td>';
			}

			// deconstruct a tag object
			function tag($a) {
				echo '<td>';
				foreach ($a as $i) {
					// add a background color according to the color attribute
				       	echo '<span class="tag" style="background-color:' . $i['color'] . ';">' . $i['name'] . '</span>';
				}
				echo '</td>';
			}

			// deconstruct a parent object
			function parents($a) {
				echo '<td>';
				foreach ($a as $i) {
					echo '<a href="#item-' . $i . '">' . $i . '</a> ';
				}
				echo '</td>';
			}

			$txt = file_get_contents('./data.json');
			$obj = json_decode($txt, true);

			// generate the rows in the html table from the json data
			foreach ($obj as $i) {
				// skip "deleted" entries
				if ($i['deleted']) {
					continue;
				}

				echo '<tr>';
				id($i['id']);
				cell($i['type']);
				cell($i['name']);
				tag($i['tags']);
				parents($i['parents']);
				echo '</tr>';
			}
			
			?>
		</table>

		<h6><i>made w/ luv by the <a href="https://github.com/SalineSingularityFRC/hawkshaw" target="_blank">saline singularity</a> scouting team &lsaquo;3</i></h6>
	</body>
</html>
