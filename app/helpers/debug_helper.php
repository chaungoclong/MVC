<?php 

function log_data(...$data) {
	foreach ($data as $key => $value) {
		echo "<pre>" . print_r($value, true) . "</pre><br>";
	}
}