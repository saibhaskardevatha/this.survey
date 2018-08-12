<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login | this.Survey</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" >
    <h1 > Login  </h1>
    <br></br>
    <label for="key" class ="col-lg-2 control-label">Enter Public Key</label>
    <input id="key" type="text" >
    <br></br>
    <label for="gender" class ="col-lg-2 control-label">Select Gender</label>
    <select name="Gender" >
    <option value = "0">Male</option>
    <option value = "1">Female</option>
    <option value = "2">Others</option>
    </select>
    <br></br>
    <a class="btn btn-dark" id="submit">Login</a>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="js/app.js"></script>
<script>

$("#submit").click(function(){
    contractInstance.printuser($("#key").val(),(err,res)){
        if(!err&&res.args.gender==$("#gender").val())
            location.href="index.php?key="+$("#key").val();

    }
});

</script>
</body>
</html>