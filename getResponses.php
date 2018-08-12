<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Responses | this.Survey</title>
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
					<a class="nav-link active" href="/responses.php">Responses</a>
				</li>
			</ul>
		</div>
		<span class="navbar-text small text-truncate mt-1 w-50 text-right order-1 order-md-last">Hello! User</span>
	</nav>
    <br><br><br>
<div class="container">
    <table id="response-table">

	</table>
</div>
<script src="js/app.js"></script>
<script src="https://unpkg.com/ipfs-api/dist/index.min.js" crossorigin="anonymous"></script>
<script>

	var url_string = window.location.href;
    var url = new URL(url_string);
    var key = url.searchParams.get("key");
	key = key.toLocaleLowerCase();
	
	var responses;
	var finalContent = '';

	contractInstance.response_of_user_form(web3.fromAscii(key.slice(2,-1)), {gas: 1000000}, function(error, result){
		if(!error){
			responses = result;
			responses.forEach(function(listItem, index){
				$.get("https://ipfs.io/ipfs/Qm"+listItem, function(data){
					var jsonkeys = Object.keys(data);
					for(var i = 0; i < jsonkeys.length; i++){
						var content = "<th>"+data.jsonkeys[i]+"</th>";
						finalContent = finalContent + content;
					}
				}, "json");
				finalContent = "<tr>"+finalContent+"</tr>";
			})
			$("#response-table").innerHTML(finalContent);
		}else{
			console.log(error);
		}
	})
</script>
</body>
</html>