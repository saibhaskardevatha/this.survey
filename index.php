<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>this.Survey</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  	<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="http://formbuilder.online/assets/js/form-render.min.js"></script>
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
					<a class="nav-link active" href="/">Create</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/fill.php">Fill</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/responses.php">Responses</a>
				</li>
			</ul>
		</div>
		<span class="navbar-text small text-truncate mt-1 w-50 text-right order-1 order-md-last">Hello! <span id="username"></span></span>
	</nav>
	<div class="container">
	<br><br><br>
		<div id="fb-editor"></div>
		<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<div class="form-group">
				<label for="num_response">Number of Responses</label>
				<input type="number" class="form-control" id="num_response">
			</div>
			<div class="form-group">
				<label for="ether_pr">Ether per Response</label>
				<input type="number" class="form-control" id="ether_pr">
			</div>
			<button class="btn btn-primary" id="save-btn" onclick="saveAll(this)">Save</button>
        </div>        
      </div>
    </div>
  </div>
		
	</div>
	<script src="js/app.js"></script>
	<script src="https://unpkg.com/ipfs-api/dist/index.min.js" crossorigin="anonymous"></script>
	<script>

	var url_string = window.location.href;
    var url = new URL(url_string);
    var key = url.searchParams.get("key");
    key = key.toLocaleLowerCase();

	var a;

	var ipfs = window.IpfsApi('localhost', '5001')

	const Buffer = window.IpfsApi().Buffer;

	jQuery(function($) {

			contractInstance.printuser(key, {gas: 1000000}, function(error, result){
				if(!error){
					a = result[0];
					console.log(a);

					$('#username').html(a);
				}else{
					console.log(error);
					// location.href = "/launch.php"
				}
			})

	var fbTemplate = document.getElementById('fb-editor'),
		options = {
			onSave: function(){
				$('#myModal').modal('toggle');
			}
		};
	var formBuilder = $(fbTemplate).formBuilder(options);
	

	saveAll = function(element){

		var num_response = $('#num_response').val();
		var ether_pr = $('#ether_pr').val();

		var formData = formBuilder.actions.getData('json');
			var formRenderOpts = {
				dataType: 'json',
				formData: formData
			};
		var renderedForm = $('<div />');
		renderedForm.formRender(formRenderOpts);

		var htmlString = renderedForm.html();

		var buffer = Buffer(htmlString);
		// console.log(buffer);
		// console.log(htmlString);
		var ipfshash;

		ipfs.files.add(buffer, (error, result) => {
			if(error){
				console.log(error);
			}else{
				ipfshash = result[0].hash;
				// console.log(ipfshash);
				ipfshash = ipfshash.slice(2,-1);

				var bucks = num_response*ether_pr;
				console.log(bucks);

				contractInstance.formdetails(ipfshash, num_response, ether_pr, {gas: 1000000, value: web3.toWei(bucks, 'ether')}, function(error, result){
					if(!error){
						location.href = "/index.php";
					}else{
						console.log(error);
					}
				})
			}
		})
		
		// contractInstance.formdetails()
		// var xmlhttp = new XMLHttpRequest();
		// var name = "xyz";//Change It! 
		// xmlhttp.open("POST","store.php");
		// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		// xmlhttp.send("html="+htmlString+"&&name="+name);

	}});
	</script>
</body>
</html>