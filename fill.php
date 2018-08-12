<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Fill | this.Survey</title>
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
					<a class="nav-link active" href="/fill.php">Fill</a>
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
    <div class="card-columns">
       
    </div>
</div>
<script src="js/app.js"></script>
<script src="https://unpkg.com/ipfs-api/dist/index.min.js" crossorigin="anonymous"></script>

<script>

	$(document).ready(function() {
		var allForms;

		contractInstance.get_all_forms({gas: 1000000}, function(error, result){
			if(!error){
				allForms = result;
				var ownerPubK;
				var owner;
				var price;
				var finalContent = '';
				allForms.forEach(function(listItem, index){
					contractInstance.get_form_details(web3.fromAscii(listItem), {gas:10000000}, function(error, result){
						if(!error){
							ownerPubK = result[0];
							owner = result[1];
							price = result[2];
							var content = `<div class="card">
												<div class="card-body text-center">
													<h4 class="card-title">${owner}</h4>
													<p class="card-text">Get ${price} Ether</p>
													<a href="getForm.php?key=Qm${listItem}" class="btn btn-dark">Fill this</a>
												</div> 
											</div>`
							finalContent = finalContent+content;
							
						}else{
							console.log(error);
						}
						
					})
				})
				$(".card-columns").innerHTML(finalContent);
			}
		})
	}

</script>

</body>
</html>