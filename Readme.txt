## documentaion for using BankUsecase used Singleton class Admin

#choose any option from MAIN-MENU
    1.For Admin login
    2.For User login

## enter "exit" to exit from any MENU


#admin credentials
    1.Admin_username is chinmaya
    2.Admin_password is 1234

# Customer credentials
    1.Accountnumber of Customer (Account number is same as Aadhar Number)
    2.password for customer is generated at the time of account creation
    password is a 32 bit hash (User can modify his password later)

# Rules for Entering Customer Details
    1.Name should consists of firstname space lastname (only aphabets are allowed)
    2.Mobile number should consists of 10 digits (starts with 6,7,8,9).
    3.Aadhar number should be of 12 digits and doesnot start with (0,1).
    4.PAN number should be of length 10 characters
      first five character should be Captial Alphabets and next four characters should be digits
      and last character should be Captial letter
    5.Two cards i.e 1 debit ,1 credit will be created 
     
      Debit card_number is Aadhar number appended with  4 zero'same
      eg:if Aadhar is 583704344516 then Debitcard number is 5837043445160000   
      
      credit card_number id DebitcardNUmber-1;
      eg:if Debitcard number is 5837043445160000 then Creditcard number is 5837043445159999. 

# ended.