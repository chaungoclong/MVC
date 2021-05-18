<h1>this is index</h1>
<table>
	<thead>
		<th>ID</th>
		<th>Name</th>
	</thead>

	<tbody>
		<?php foreach ($data as $key => $value): ?>
			<tr>
				<td><?= $value["id"] ?></td>
				<td><?= $value["name"] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>