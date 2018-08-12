pragma solidity ^0.4.15;

contract survey{
    
    
    // struct to store User Details - Name Age Gender hash of forms created and mapping of hash to count of forms filled - Gender as 0,1,2 
    
    struct user_details{
        string name;
        uint age;
        uint gender;
        bytes32[] created;
        mapping(bytes32 => uint) filled;
    }
    
    mapping(address=>user_details) public users;
    
    // TO store users address 
    
    address[] user_list;
    
    // Function - Get User details in registration page
    
    function get_details(address _address,string _name,uint _age,uint _gender) public {
        users[_address].name=_name;
        users[_address].age = _age;
        users[_address].gender=_gender;
        user_list.push(_address);         
    }
    
    // Returns the number of users stored 
    
    function usercount () public view returns (uint c ){
        return user_list.length;
    }    
   
    // Print a given user's details 
    
    function printuser (address _address) public view returns (string n,uint a, uint g){
        return(users[_address].name,users[_address].age,users[_address].gender);
    }
    
    
    // struct to store form details 
    struct form_details{
        uint resp;
        uint price;
        uint total;
        address owner;
        uint count;
        string name;
    }
    // mapping of IPFS hash to form Details
    
    mapping(bytes32 => form_details) forms;
    bytes32[] hashlist;
    
    
    // Function - To get Form Details 
    uint pool;
    function formdetails(bytes32 _hash,uint _resp,uint _price) public payable{
        uint localpool;
        forms[_hash].resp=_resp;
        forms[_hash].price=_price;
        localpool = _resp*_price;
        forms[_hash].total=localpool;
        
            
        hashlist.push(_hash);
        pool += _resp*_price  ;
        forms[_hash].owner=msg.sender;
        forms[_hash].count = 0;
        users[msg.sender].created.push(_hash);
        forms[_hash].name=users[msg.sender].name;
    }
    // store the form filler address against a given form 
    mapping(bytes32 =>address[]) responses;
    mapping(bytes32 => bytes32[]) filled_responses;
   
    
    // To transfer value to survey filler from pool 
    function formfilled (bytes32 _hash, bytes32 _fhash) public payable {  
        require(forms[_hash].count <= forms[_hash].resp && users[msg.sender].filled[_hash]==0);
        msg.sender.transfer (forms[_hash].price *(1 ether));
        pool -=forms[_hash].price  ;
        forms[_hash].count +=1;
        users[msg.sender].filled[_hash] +=1;
        responses[_hash].push(msg.sender);
        filled_responses[_hash].push(_fhash);
    }
    //return list of all forms created
    
    function get_all_forms() public view returns (bytes32[] a){
        return(hashlist);
    
    }
    // return form details of given hash
    function get_form_details (bytes32 _hash) public returns(address adr,string na,uint s){
        return(forms[_hash].owner,forms[_hash].name,forms[_hash].price);
    }
    
    // return the count number of times a form is filled & total to be filled
    function livecount (bytes32 _hash) public returns(uint a,uint b) {
        return (forms[_hash].count,forms[_hash].resp);
    }
    function forms_of_user() public returns (bytes32[] a){
        return users[msg.sender].created;
    }
    function response_of_user_form(bytes32 _hash) public returns (bytes32[] a){
        if(forms[_hash].owner == msg.sender)
        
            return filled_responses[_hash];
    }
}