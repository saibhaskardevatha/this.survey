<script src="js/app.js"></script>
<script src="https://unpkg.com/ipfs-api/dist/index.min.js" crossorigin="anonymous"></script>

<script>

    var ipfs = window.IpfsApi('localhost', '5001')

    const Buffer = window.IpfsApi().Buffer;

    var newJSON = <?php
        $myJSON = json_encode($_POST);
        echo $myJSON;
    ?>
    var formHash = <?php
        $myJSON = json_encode($_POST);
        $FormHash = $myJSON.hashkey;
        echo $FormHash;
    ?>
    formHash = formHash.slice(2,-1);

    var ipfshash;
    var buffer = Buffer(newJSON);

    ipfs.files.add(buffer, function(error, result){
        if(!error){
            ipfshash = result[0].hash;
            ipfshash = ipfshash.slice(2,-1);
            contractInstance.formfilled(web3.fromAscii(formHash), web3.fromAscii(ipfshash),{gas: 1000000}, function(error, result){
                if(!error){
                    location.href = "/fill.php";
                }else{
                    console.log(error);
                }
            })
        }
    })
</script>