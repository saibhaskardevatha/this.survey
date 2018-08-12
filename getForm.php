<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Fill Form | this.Survey</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<div class="d-flex w-50 order-0">
			<a class="navbar-brand mr-1" href="/">this.Survey</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse justify-content-center order-2" id="collapsingNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="/">Create</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/fill.php">Fill</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/responses.php">Responses</a>
				</li>
			</ul>
		</div>
		<span class="navbar-text small text-truncate mt-1 w-50 text-right order-1 order-md-last">Hello! User</span>
	</nav>
    <br><br><br>
<div class="container">
    <form action="addResponse.php" method="POST">
		<input type="hidden" id="hashkey" name="haskey" value="<?php $_GET['key'] ?>">
    <?php
        $hashkey = $_GET['key'];
		echo file_get_contents("https://ipfs.io/ipfs/".$hashkey);
    ?>
    </form>
</div>
</body>
</html>