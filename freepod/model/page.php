<?php

class Page
{

	public function __construct()
	{

		echo '
			<link rel="stylesheet" type="text/css" href="assets/components/require.css">
			<link rel="stylesheet" type="text/css" href="assets/components/bootstrap/css/bootstrap.min.css">
			<script src="assets/components/require.js"></script>
			<script>require(["/assets/scripts/main.js"])</script>

			<!-- CRRR -->
			';
	}
}

?>