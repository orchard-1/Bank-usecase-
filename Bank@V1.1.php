<?php
class Customer{
    private $name;
    private $mobile;
    private $balance;
    private $aadhar;
    private $pan;
    private $account_number;
    private $password;
    private $type_of_account;
    public  $cards=array();
    

    public function getType_of_account()
    {
        return $this->type_of_account;
    }
 
    public function setType_of_account($type_of_account)
    {
        $this->type_of_account = $type_of_account;

        return $this;
    }

    #function for deposit()
    function deposit(){

        $amount=readline("Enter amount to deposit : ");
        $cuurent_balance=$this->getBalance();
        echo "current balace is ".$this->getBalance()."\n";
        $this->setBalance($cuurent_balance+$amount);
        echo "updated balace is ".$this->getBalance()."\n";
    }

    #function for withDraw()
    function withdraw(){
         $amount=readline("Enter amount to Withdraw : ");
         $cuurent_balance=$this->getBalance();
         echo "current balace is ".$this->getBalance()."\n";
         if($amount<=$cuurent_balance){
             $this->setBalance($cuurent_balance-$amount);
             echo "updated balace is ".$this->getBalance()."\n";
         }else{
             echo "Insufficient Funds...!\nAvailable : $cuurent_balance";
         }
    }

    #function to disable/enable the card
    function change_card_status(){
        $cardfound=0;
        $card_num=readline("Enter card Number : ");
        $type=readline("Enter type :");
        $cardfound=0;
    
         foreach($this->cards as $card=>$value){
            if($card==$card_num && $value["type"]==$type){
                $cardfound=1;
                if($value["status"]=="Active"){
                $this->set_card($card_num,$type,"InActive");
                echo "Suceessfully disabled $card_num";
                break;
            } else{
                    $card["status"]="Active";
                    echo "Suceessfully Activated $card_num";
                    break;
                }
           
            }
         }
       
        if($cardfound==0){
            echo "Invalid card Details";
        }
    }

    #function to change password
    function reset_password(){
     $current_password=readline("Enter the Current password : "); 
        if($current_password==$this->getPassword()){
            $new_password=readline("Enter new password : ");
            $this->setPassword($new_password);
            echo "Password Reset Successful";
        }else{
            echo "Incorrect password..!";
        }

    }
    //==========================================================
    function my_profile(){
        echo "\nAccount A/c no : ".$this->getAccount_number()."\n";
        echo "==============================\n Name : ".$this->getName()."\n";
        echo "\n Account type : ".$this->getType_of_account();
        echo "\n==============================\n"; 
        echo "\n Mobile : ".$this->getMobile();
        echo "\n==============================\n"; 
        echo "\n Balance : ".$this->getBalance();
        echo "\n==============================\n"; 
        echo "\n Aadhar : ".$this->getAadhar();
        echo "\n==============================\n"; 
        echo "\n PAN : ".$this->getPan();
        echo "\n==============================\n"; 
        echo "=========== CARDS ===========\n";
        foreach($this->cards as $card => $value){
            echo "Card NUmber : ".$card."\n";
            echo "Type : ".$value["type"]."\n";
            echo "Status :".$value["status"]."\n";
            echo "===================================\n";
        }
    }

    # adding card to customer 
    function set_card($card_num,$type,$status){
        $this->cards[$card_num]=array("type"=>$type,"status"=>$status);
    }

    #changind status of card
    function set_status($card_num,$type,$status){
          $this->cards[$card_num]["status"]=$status;
    }

     # Get the value of name
    public function getName()
    {
        return $this->name;
    }
 
    # Set the value of name
    public function setName($name)
    {
        $this->name = $name;
    }

    # Get the value of mobile
    public function getMobile()
    {
        return $this->mobile;
    }

     # Set the value of mobile
   
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    #Get the value of balance
     public function getBalance()
    {
        return $this->balance;
    }
    # Set the value for balance
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    # Get the value of aadhar
      public function getAadhar()
    {
        return $this->aadhar;
    }

    #set the value of aadhar
    public function setAadhar($aadhar)
    {
        $this->aadhar = $aadhar;

    }
    
    # Get the value of pan
     public function getPan()
    {
        return $this->pan;
    }

    # Set the value of pan
     public function setPan($pan)
    {
        $this->pan = $pan;
    }

    # Get the value of account_number
    public function getAccount_number()
    {
        return $this->account_number;
    }

    # Set the value of account_number
    public function setAccount_number($account_number)
    {
        $this->account_number = $account_number;
    }
    
    # Get the value of password
    public function getPassword()
    {
        return $this->password;
    }

    # Set the value of password
    public function setPassword($password)
    {
        $this->password = $password;
    }
}

 #end of Customer class
 // =========================================================



 //==========================================================
 # start of Bank Class

class Bank{
    public const BANK_NAME ="HDFC"; 
    public $ifsc="HDFC0001636";
    public $address="6-5-34,\n OPP. PUJITHA APARTMENT \nHYDERABAD ROAD,\n TELANGANA ";
    public static $Customers= array();
    public static $minmum_avarage_balance;
    public static $intrest_rate;
        static function push($customer_obj){
            array_push(Bank::$Customers,$customer_obj);
            echo "\n==========================================================\n";
            echo "Successfully added Customer ". $customer_obj->getName();
            echo "\npassword :".$customer_obj->getPassword();
            echo "\n==========================================================\n";
        }

    }

 #Bank class Ended
 // ==============================================================


 # start of Admin Class

class Admin{ 
    private $admin_name="chinmaya";
    private $password="1234";
    
    # Get the value of Admin password
     public function getPassword()
    {
        return $this->password;
    }
    
    # Set the value of password
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    # Get the value of admin_name
    public function getAdmin_name()
    {
        return $this->admin_name;
    }

    # Set the value of admin_name
    public function setAdmin_name($admin_name)
    {
        $this->admin_name = $admin_name;
    }
    # remove customer
    function remove_customer(){
        $account_number=readline("Enter customer Account no : ");
        $customer_found=0;
        foreach(Bank::$Customers as $obj){
            if($obj->getAccount_number()==$account_number){
                $obj->setAccount_number(-1);
                echo "removed Account A/c no :$account_number";
                break;  
            }
        }
        
    }
    
    # function to update customer 
    function update_customer(){
        $account_number=readline("Enter Customers Account Number : ");
        $account_found=0;
        foreach(Bank::$Customers as $obj){
            if($obj->getAccount_number()==$account_number ){
                $account_found=1;
                echo "======== UPADTING MOBILE NUMBER ==========";
                $mobile=validate_mobile();  
                $obj->setMobile($mobile);
                echo "Successfully updated mobile number";
             }
        }
        if($account_found==0){
            echo "No Account Found\nEnter valid account Number";
        }
    }
    #start of add_customer();
    //=========================================================
    function add_customer(){
        $customer_obj=new Customer();
        $name=validate_name();
        $mobile=validate_mobile();
        # balance will be zero fro new account
        $balance=0;
        $aadhar=validate_aadhar();
        $pan=validate_pan();
        $account_number=$aadhar;
        #adding debit card
         $card_num=$aadhar*10000;
         $type="debit";
         $status="Active";
         $customer_obj->set_card($card_num,$type,$status);
         #adding credit card
         $card_num=$aadhar*10000-1;
         $type="credit";
         $status="Active";
         $newstring="$name.$mobile.$aadhar.$pan";
         $unquiestring=uniqid();
         $unquiestring=$unquiestring.$newstring;
         $password=md5($unquiestring);
         $customer_obj->set_card($card_num,$type,$status);
         $customer_obj->setName($name);
         $customer_obj->setAadhar($aadhar);
         $customer_obj->setAccount_number($account_number);
         $customer_obj->setMobile($mobile);
         #type of account
         $type_of_account=readline("\nEnter type of account : ");
         $customer_obj->setType_of_account($type_of_account);
         $customer_obj->setPan($pan);
         $customer_obj->setBalance($balance);
         $customer_obj->setPassword($password);
         #pushing customer object to the array in Bank Class
         Bank::push($customer_obj);      
    }
    # start of set_minmum_balance()
    function set_minmum_balance(){
        $minmum_avarage_balance=null;
        $minmum_avarage_balance=readline("Enter MAB :");
        Bank::$minmum_avarage_balance=$minmum_avarage_balance;
        echo "Successfully Updated MAB rate\n";
        echo "Current MAB  is $minmum_avarage_balance";
    }
    //===================================
    #fuction for viewing customer
    function view_profile(){
        $account_number=readline("Enter account Number : ");
        foreach(Bank::$Customers as $obj){
            if($obj->getAccount_number()==$account_number){
                echo "\nDetails of the user with A/c no : $account_number are:\n";
                echo "==============================\n Name : ".$obj->getName()."\n";
                echo "\n Account type : ".$obj->getType_of_account();
                echo "\n==============================\n"; 
                echo "\n Mobile : ".$obj->getMobile();
                echo "\n==============================\n"; 
                echo "\n Balance : ".$obj->getBalance();
                echo "\n==============================\n"; 
                echo "\n Aadhar : ".$obj->getAadhar();
                echo "\n==============================\n"; 
                echo "\n PAN : ".$obj->getPan();
                echo "\n==============================\n"; 
                echo "=========== CARDS ===========\n";
                    foreach($obj->cards as $card => $value){
                        echo "Card NUmber : ".$card."\n";
                        echo "Type : ".$value["type"]."\n";
                        echo "Status :".$value["status"]."\n";
                        echo "===================================\n";
                    }
            }else{
                   echo "Invalid Account number ";
                }   
        }
    }

     # start of set_intrest_rate()
    function set_intrest_rate(){
        $intrest_rate=readline("Enter Intrest rate :");
        Bank::$intrest_rate=$intrest_rate;
        echo "Successfully Updated Intrest Rate rate\n";
        echo "Current Intrest Rate  is $intrest_rate";
    }

}

    # end of Admin class

    // ====================================================================

# driver block

    # function to get display menu
    function get_menu(){
    echo "\n=========== MAIN MENU ===============";
    echo "\n1.Admin\n2.Customer\n";
    }

    # function for customer menu
    function get_customer_menu(){
        echo "\n=========== CUSTOMER MENU ===============\n";
        echo "1.DEPOSIT\n2.WITHDRAW\n3.BALANCE_INQUIRY\n4.PROFILE";
        echo "\n5.CHANGE_CARD_STATUS\n6.Change Password\ ";
    }
    
    #creating admin menu
    function get_admin_menu(){
        echo"\n=========== ADMIN MENU ===============";
        echo "\n1.ADD CUSTOMER\n2.VIEW CUSTOMER\n";
        echo "3.UPDATE\n4.REMOVE\n5.setMAB\n6.set Intrest Rate\n";
    }

    # end of Admin menu
    //===================================================

    # function to check validity of username(Admin)
    function validate_admin_name($username){
        $admin_obj=new Admin();  
        if($admin_obj->getAdmin_name()==$username){
        return true;
        }else{
            return false;
        }
    }
    # end of validate_customername()
    // ==================================
    
    #function for Admin login
    function admin_login(){
        $admin_name=readline("Enter Admin User_name : ") ;
            if(validate_admin_name($admin_name)){
                 $password=readline("Enter Admin password : ") ;
                    if(validate_password($password)){
                        echo "\nHello $admin_name.....\nsucessfully logged in\n";
                        return 1;
                    }
            }
        return 0;
    } 
    // end of admin_login()
    #=============================================================

    # function to check validity of password(Admin)
    function validate_password($password){
        $admin_obj=new Admin();  
        if($admin_obj->getPassword()==$password){
            return true;
        }
            return false;
    }
    
    # end of validate_password()
    // ==================================
    #function Customer Login
    function customer_login(){
        $account_number=readline("\nEnter Account_Number :");
        $password=readline("\nEnter Your Password :");
        $obj=validate_customer($account_number,$password);
            if($obj){
                echo "\nHello....! ".$obj->getName(); 
                echo "\n Login Successful";   
                return $obj;
            }
        return false;
    }
    
    #validate Customer credentials ()
    function validate_customer($account_number,$password){
        foreach(Bank::$Customers as $obj){
            if($obj->getAccount_number()==$account_number && $obj->getPassword()==$password){
                return $obj;
            }
        }
        return false;
    }

    #function for Customer operations
    function customer_operations($choice,$obj){
    
        switch($choice){
            
            case 1:$obj->deposit();
                    break;
            case 2:$obj->withdraw();
                    break;
            case 3:echo "Available balance is :".$obj->getBalance();    
                    break;    
            case 5: $obj->change_card_status();
                    break;
            case 6:  $obj->reset_password();
                    break;  
            case 4: $obj->my_profile();
                    break;               
            case "exit": echo "\nExited from Customer\n";
                    break; 
            default : echo "\nChoose a Valid Option from Customer MENU";
                    break; 
        }
    }

 
    //==========================================================
    
    #creating admin_operations
    function admin_operations($choice){
        $admin_obj=new Admin();
        switch($choice){
    
            case 1: $admin_obj->add_customer();
                    break;
            case 2: $admin_obj->view_profile();
                    break;  
            case 3: $admin_obj->update_customer();
                    break; 
            case 4: $admin_obj->remove_customer();
                    break;                    
            case 5: $admin_obj->set_minmum_balance();
                    break;
            case 6: $admin_obj->set_intrest_rate();       
                    break;
            case "exit": echo "\nExited from Admin\n";   
                    break;
            default : echo "Enter a valid option from Admin menu\n";     
        }

    }
    #end of admin_operations();
    //===================================================



        //==========================================
    #validating Customer name
    function validate_name(){
        $name=0;
        $count=0;
        do{
            if($count==0){
                $name=readline("Enter Customer name :");
                 $count++;
            }else{
                $name=readline("Enter A Valid Customer name :"); 
            }
        }while(!preg_match('/^[a-zA-Z]+\s[a-zA-z]*/i', $name));
        return $name;
    }

    #validate pan
    function validate_pan(){
        $count=0;
        $pan=0;
        do{
            if($count==0){
                $pan=readline("\nEnter PAN number : ");
                $count++;
            }else{
                $pan=readline("\nEnter A valid PAN number : ");
            }
        }while(!preg_match('/[A-Z]{5}[0-9]{4}[A-Z]{1}/', $pan));
        return $pan;
    }
    #validate mobile
    function validate_mobile(){
        $count=0;
        $mobile=0;
            do{
            if($count==0){
                $mobile=readline("\nEnter Mobile number : ");
                $count++;
            }else{
                $mobile=readline("\nEnter A valid Mobile number : ");
            }
            }while(!preg_match('/[6-9]{1}[0-9]{9}/', $mobile));
        return $mobile;
    }

    #validate aadhar
    function validate_aadhar(){
        $aadhar=0;
        $count=0;
        do{
            if($count==0){
                $aadhar=readline("\nEnter Aadhar number : ");
                $count++;
            }else{
                $aadhar=readline("\nEnter A valid Aadhar number : ");
            }
        
        }while(!preg_match('/[2-9]{1}[0-9]{9}/', $aadhar));
        return $aadhar;
    }
    
//=================================================================
#start of logic
$option=0;
$admin_obj=new Admin();
echo "====================== BANK APPLICATION =========================";
do{
    get_menu();
    # take option from user
    $option=readline("Enter your option : ");
    switch($option){
        case 1: 
                 if(admin_login()){
                    $choice;
                    do{
                    get_admin_menu(); 
                    $choice=readline("\nchoose your Admin option : ");
                        admin_operations($choice);
                    }while($choice!="exit");
                 }else{
                     echo "Invalid Admin Credentials";
                 }
                break;
        case 2: $obj=customer_login();
                if($obj){
                 $choice;
                 do{
                     get_customer_menu(); 
                     $choice=readline("\nchoose your Customer option : ");
                      customer_operations($choice,$obj);
                }while($choice!="exit");
                }else{
                    echo "Invalid Customer credentials";
                } 
                break;
        case "exit": echo "\nyou are exited from the Bank App\nThank you....!!\n";      
                break;
        default: echo "Choose Valid option from the MENU";
                break;            
    }

}while($option!="exit");



?>