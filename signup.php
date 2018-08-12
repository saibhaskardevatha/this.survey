<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sign Up | this.Survey</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container"  >
    <h1 >Sign Up  </h1>
    <br></br>
    <label for="key" class ="col-lg-2 control-label">Enter Public Key</label>
    <input id="key" type="text" >
    <br></br>
    <label for="name" class ="col-lg-2 control-label">Enter Name</label>
    <input id="name"  type="text"  >
    <br></br>
    <label for="age" class ="col-lg-2 control-label">Enter Age</label>
    <input id="age" type="text" >
    <br></br>
    <label for="gender" class ="col-lg-2 control-label">Select Gender</label>
    <select name="gender" id="gender">
    <option value = "0">Male</option>
    <option value = "1">Female</option>
    <option value = "2">Others</option>
    </select>
    <br></br>
    <a class="btn btn-dark" id="submit">Sign Up!</a>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="js/app.js"></script>
<script>


$("#submit").click(function(){
    var pubK = $("#key").val();
    
    contractInstance.get_details(pubK, $("#name").val(), $("#age").val(), $("#gender").val(), {gas: 1000000}, function(error, result){
        if(!error){
            location.href = "index.php?key="+pubK;
        }else{
            console.log(error);
        }
    });
});

</script>
</body>
</html>