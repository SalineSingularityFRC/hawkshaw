<!DOCTYPE html>
<html>
	<head>
		<title>Hawkshaw</title>
		<meta charset="utf-8"/>
		<style>
		table {
			border-collapse: collapse;
		}

		th, td {
			border: 1px solid black;
			padding: 10px;
		}
		</style>
	</head>
	<body>
		<h1>Hawkshaw</h1>
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
				foreach ($a as $i) {
					// add a background color according to the color attribute
					echo '<td style="background-color:' . $i['color'] . ';">' . $i['name'] . '</td>';
				}
			}

			// deconstruct a parent object
			function parents($a) {
				echo '<td>' . join(", ", $a) . '</td>';
			}

			$txt = file_get_contents('./data.json');
			$obj = json_decode($txt, true);

			// generate the rows in the html table from the json data
			foreach ($obj as $i) {
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

		<a href="/add.html">add item</a>
	</body>
</html>
