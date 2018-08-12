// import ipfs from '../ipfs';


if (typeof web3 !== 'undefined') {
    web3 = new Web3(web3.currentProvider);
} else {
    // set the provider you want from Web3.providers

web3 = new Web3(new Web3.providers.HttpProvider("http://127.0.0.1:8545"));
}
    
// web3.eth.defaultAccount = web3.eth.accounts[0];
abi = JSON.parse('[{"constant":true,"inputs":[],"name":"usercount","outputs":[{"name":"c","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_hash","type":"bytes32"}],"name":"response_of_user_form","outputs":[{"name":"a","type":"bytes32[]"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_hash","type":"bytes32"}],"name":"livecount","outputs":[{"name":"a","type":"uint256"},{"name":"b","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_hash","type":"bytes32"},{"name":"_fhash","type":"bytes32"}],"name":"formfilled","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"name":"_address","type":"address"},{"name":"_name","type":"string"},{"name":"_age","type":"uint256"},{"name":"_gender","type":"uint256"}],"name":"get_details","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_hash","type":"bytes32"}],"name":"get_form_details","outputs":[{"name":"adr","type":"address"},{"name":"na","type":"string"},{"name":"s","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"get_all_forms","outputs":[{"name":"a","type":"bytes32[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_address","type":"address"}],"name":"printuser","outputs":[{"name":"n","type":"string"},{"name":"a","type":"uint256"},{"name":"g","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"users","outputs":[{"name":"name","type":"string"},{"name":"age","type":"uint256"},{"name":"gender","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"forms_of_user","outputs":[{"name":"a","type":"bytes32[]"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_hash","type":"bytes32"},{"name":"_resp","type":"uint256"},{"name":"_price","type":"uint256"}],"name":"formdetails","outputs":[],"payable":true,"stateMutability":"payable","type":"function"}]');
var SurveyContract = web3.eth.contract(abi);

contractInstance = SurveyContract.at('0x072dd828ee74c460ede33fdbe809511a1adb74af')  ;




