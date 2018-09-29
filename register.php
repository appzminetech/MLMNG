<!DOCTYPE html>
<?php 
include_once("connect.php");

//inserting data
$user_id=$doj=$package_scheme= $refferal_id=$e_pin=$mail_id=$password=
$f_name=$m_name=$l_name= $dob=$country=$state=$city =$area=$landmark=$pincode=$contact_no=
$aadhar_number=$pan_number=$nominee_name=$nominee_relationship_name=
$bank_name=$branch_name=$ifsc_code=$account_no=$order_id="";

if(isset($_GET["parent"])){
  $user_id=$_GET["parent"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
  $package_scheme= test_input($_POST["package_scheme"]);
  $refferal_id= test_input($_POST["refferal_id"]);
  $e_pin= test_input($_POST["e_pin"]);
  $mail_id = test_input($_POST["email_id"]);
  $password= test_input($_POST["password"]);
  $f_name= test_input($_POST["first_name"]);
  $m_name = test_input($_POST["middle_name"]);
  $l_name= test_input($_POST["last_name"]);
  $dob= test_input($_POST["dob"]);
  $country = test_input($_POST["country"]);
  $state= test_input($_POST["state"]);
  $city = test_input($_POST["city"]);
  $area=test_input($_POST["area"]);
  $landmark=test_input($_POST["landmark"]);
  $pincode= test_input($_POST["pincode"]);
  $mobile_no= test_input($_POST["mobile_no"]);
  $aadhar_number = test_input($_POST["aadhar_number"]);
  $pan_number= test_input($_POST["pan_number"]);
  $nominee_name = test_input($_POST["nominee_name"]);
  $nominee_relationship_name= test_input($_POST["nominee_relationship_name"]);
  $bank_name= test_input($_POST["bank_name"]);
  $branch_name= test_input($_POST["bank_branch"]);
  $ifsc_code= test_input($_POST["ifsc_code"]);
  $account_no= test_input($_POST["account_no"]);
  $user_id = test_input($_POST["user_id"]);

  $order_id = getOrderId(10);
          
            //Writting insert query               
              $sqlpro = "CALL create_member(".check_null($user_id).",".check_null($package_scheme).", ".check_null($refferal_id).",".check_int($e_pin).",".check_null($mail_id).", ".check_null($password).", ".check_null($f_name).",".check_null($m_name).", ".check_null($l_name).", ".check_null($dob).", ".check_null($country).", ".check_null($state).", ".check_null($city).", ".check_null($area).", ".check_null($landmark).", ".check_int($pincode).",".check_int($mobile_no).",".check_int($aadhar_number).", ".check_null($pan_number).", ".check_null($nominee_name).", ".check_null($nominee_relationship_name).", ".check_null($bank_name).", ".check_null($branch_name).", ".check_null($ifsc_code).",".check_int($account_no).", ".check_null($order_id).")";
              if (mysqli_query($conn,$sqlpro) === TRUE)
              {
                session_start();
                $_SESSION["username"] = $user_id;
                $to=$from=$subject=$body="";
                $to= $mail_id;
                $from="From:info@nationalgroups.in";
                $subject="National Groups Welcome Message";
                $body="HI!!!!! \n Greetings from National Group.  Welcome User".$f_name." ".$m_name." ".$l_name.".  We have sucessfully created 
                your National Group Account with this mail Id. Following are the credentials of your account. 
                User Id : ".$user_id." and Password : ".$password.". Please don't share it with anyone.";
                mail($to,$subject,$body,$from);
                echo "<script>alert('Mail sent sucessfully ');</script>";
                echo "<script>alert('Added Member Sucessfully');</script>";

                // $ch = curl_init();
                // $username = $f_name." ".$m_name." ".$l_name;
                // $apiUrl = "https://2factor.in/API/R1/?module=TRANS_SMS&apikey=72d6b6bc-ac24-11e8-a895-0200cd936042&to=".$mobile_no."&from=NGROUP&templatename=Welcome_Letter&var1=".$username."&var2=".$user_id."&var3=".$password;
                // curl_setopt($ch, CURLOPT_URL, $apiUrl);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                // curl_exec($ch);
                // curl_close($ch);
                
                header("location:userindex.php");
                                
              }
              else {
                echo "Error: " . $sqlpro . "<br>" . $conn->error;
            }
      }

      function getOrderId($len){
        $orderid = "";
      
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for($i=0;$i<$len;$i++){
           $orderid.=substr($chars,rand(0,strlen($chars)),1);
        }
        /*$sqlorderid = "select count(*) from ng_invoice where order_id='".$orderid."'";
        $resinvoidid = $conn->query($sqlorderid);
        
        if($resinvoidid->num_rows == 0){
          return $orderid;
        }
        else{
          getOrderId(10);
        }*/
        return $orderid;
}

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function check_null($para){
    $str = "";
    if($para == ""){
        return "NULL";
    }
    else{
        $str = "'$para'";
        return $str;
    }
}
function check_int($para){
  $str = "";
  if($para == ""){
      return 0;
  }
  else{       
      return $para;
  }
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NGS Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="http://nationalgroups.in/"><b>National Groups</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form  method="POST" name="myForm" onsubmit="return validateForm()" >
               <label style="color:red;" ><mark>Note:</mark> Fields Marked with * Mark are Mandatory.</label>
     <h4>Joining Details:</h4>
     <input type="hidden" id="package_scheme" name="package_scheme" value=""/>
      <div class="form-group has-feedback">
       
        <span class="fa fa-odnoklassniki-square form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control text-bold" placeholder="Refferal ID"
        onfocus= "check_Usereligibility(this.value)" onkeyup="check_Usereligibility(this.value)" name="refferal_id" id="refferal_id" value="<?php echo $user_id; ?>" autofocus required>
        <span class="fa fa-id-badge form-control-feedback"></span>
        <p id="notice" class=""></p>
      </div>     

      <div class="form-group has-feedback">
        <input type="text"  onkeyup="check_UsereEpinValidity(this.value)"
         class="form-control text-bold" placeholder="E-pin" name="e_pin" id="e_pin" disabled required >
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <p id="notice1" class=""></p>
      </div>
      
      <div class="form-group has-feedback">
        <input type="text"  onkeyup="checkuserId(this.value)" class="form-control text-bold" 
        placeholder="Enter Unique UserId" name="user_id" id="user_id" required disabled >
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <p id="notice3" class=""></p>
      </div>

      <script>
        
        function check_Usereligibility(value){

           //alert("onfocusout "+ value);
            $.ajax({
                url : 'checkuser.php', 
                type : 'POST', 
                data : { dataget : value, x : 1, epin: null},
                success : function(result){    
                  if(result == "Invalid User Id Entered" || result == "This user has completed 5 childs. Please select another Refferal Id"){
                    $('#notice').addClass("alert alert-danger");        
                    $('#notice').html(result);
                    $('#e_pin').attr('disabled',true);
                   
                  }
                  else{
                    $('#notice').removeClass("alert alert-danger");  
                    $('#notice').html("");
                    $('#e_pin').attr('disabled',false);
                  }
                }
            });
            // alert("REached end of function.... ");
        }
        function check_UsereEpinValidity(value){
          // alert("onfocusout "+ userid);
          var packid = document.getElementById("package_scheme");
          var userid = document.getElementById("refferal_id").value;
            $.ajax({
                url : 'checkuser.php', 
                type : 'POST', 
                data : { dataget : userid, x : 2, epin : value},
               
                success : function(result){    
                  if(result == "Invalid combination of Referral Id and E-Pin" || result=="Please enter a valid userid" || result == "Please enter a valid E-Pin" ){
                    $('#notice1').removeClass("alert alert-success");  
                    $('#notice1').addClass("alert alert-danger");        
                    $('#notice1').html(result);
                    $('#user_id').attr('disabled',true);
                   
                  }
                  else{
                    $('#notice1').removeClass("alert alert-danger");  
                    $('#notice1').addClass("alert alert-success");    
                    var obj = JSON.parse(result);
                    $('#notice1').html(obj.acccountsuccess);
                    packid.value = obj.packid;
                    $('#user_id').attr('disabled',false);
                  }                 
                }
            });
            // alert("REached end of function.... ");
        }

        function checkuserId(value){
             $.ajax({
                url : 'checkuser.php', 
                type : 'POST', 
                data : { dataget : value, x : 3, epin : null},
               
                success : function(result){    
                  if(result == "1"){
                    $('#notice3').removeClass("alert alert-success");  
                    $('#notice3').addClass("alert alert-danger");        
                    $('#notice3').html("This userId is not available. Please select another userId..");
                    disableall();
                  }
                  else if(result=="3"){
                    $('#notice3').removeClass("alert alert-success");  
                    $('#notice3').addClass("alert alert-danger");        
                    $('#notice3').html("Please enter userId. It should not be blank");
                    disableall();
                  }
                  else{
                    $('#notice3').removeClass("alert alert-danger");  
                    $('#notice3').html("");
                    enableall();
                  }                 
                }
            });

        }
        
        function enableall(){        
        var x = document.getElementById("mydiv").getElementsByTagName("INPUT");
        var y = document.getElementById("mydiv").getElementsByTagName("TEXTAREA");
        var z = document.getElementById("mydiv").getElementsByTagName("SELECT");
        var i;
        for(i=0; i < x.length; i++){
            x[i].disabled = false;
        }  
        for(i=0; i<y.length; i++){
            y[i].disabled = false;
        }
        for(i=0; i<z.length; i++){
            z[i].disabled = false;
        }
        document.getElementById("e_pin").readOnly = true;
        document.getElementById("refferal_id").readOnly = true;
    }
    function disableall(){        
        var x = document.getElementById("mydiv").getElementsByTagName("INPUT");
        var y = document.getElementById("mydiv").getElementsByTagName("TEXTAREA");
        var z = document.getElementById("mydiv").getElementsByTagName("SELECT");
        var i;
        for(i=0; i < x.length; i++){
            x[i].disabled = true;
        }  
        for(i=0; i<y.length; i++){
            y[i].disabled = true;
        }
        for(i=0; i<z.length; i++){
            z[i].disabled = true;
        }
        
    }
      </script>
<div  id="mydiv">
    <h4>Login Details:</h4>
      
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Email Id" id="email_id" name="email_id" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="password" class="form-control text-bold" placeholder="Password" name="password" id="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="password" class="form-control text-bold" placeholder=" Confirm Password" name="confirm_password" id="confirm_password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
    
    <h4>Personal Details:</h4>
    <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="First Name" name="first_name" id="first_name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Middle Name" name="middle_name" id="middle_name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Last Name" name="last_name" id="last_name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled placeholder="Date Of Birth" type="text" class="form-control text-bold" onfocus="(this.type='date')" 
        onblur="(this.type='text')" id="dob" name="dob"  min="1979-12-31" max="<?php echo date('Y-m-d'); ?>" required/>
        <span class="fa fa-calendar form-control-feedback"></span>
      </div> 
      <div class="form-group has-feedback">
      <input type="text" disabled class="form-control text-bold" name="country" value="India" required/>
      <!-- <select  class="form-control text-bold" name="country"  required> -->
        <?php
      // $sql = "select distinct country_name from ng_country_states"; 
      //  $result = $conn->query($sql);        
      //  if ($result->num_rows>0){         
      //   while($row = $result->fetch_assoc()){                
      //     echo "<option>". $row["country_name"]."</option>";
      //   } 
      // }            
    ?>
    <!-- </select> -->
    <span class="fa fa-globe  form-control-feedback"></span>
    </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="State" id="state" name="state" required >
        <span class="fa fa-flag form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="City" id="city" name="city" required >
        <span class="fa fa-home form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Area" name="area" id="area" required>
        <span class=" fa fa-area-chart form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Landmark" name="landmark" id="landmark" required>
        <span class="fa fa-language form-control-feedback"></span>
      </div>
     
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="PinCode" id="pincode" name="pincode" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Mobile Number" name="mobile_no" id="mobile_no" required>
        <span class="fa fa-phone-square form-control-feedback"></span>
      </div>
     
      <h4>Nominee Details:</h4>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Nominee Name" id="nominee_name" name="nominee_name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select disabled type="text" class="form-control text-bold" placeholder="Nominee Relationship Name" name="nominee_relationship_name" id="nominee_relationship_name" required>
            <option>Mother</option>
             <option>Father</option>
             <option>Brother</option>
             <option>Sister</option>
            <option>Husband</option>
            <option>Wife</option>
            <option>Son</option>
            <option>Daughter</option>
            </select>
        <span class="fa fa-user-plus form-control-feedback"></span>
      </div>      
     
      <h4>Bank Details <span style="color:red;font-size:11px;">(Optional):</span> </h4>
      
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Bank Name" name="bank_name" id="bank_name" >
        <span class="fa fa-university form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Bank Branch" name="bank_branch" id="bank_branch" >
        <span class="fa fa-address-card form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="IFSC Code" name="ifsc_code" name="ifsc_code" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Account Number" name="account_no" id="account_no" >
        <span class="fa fa-unlock-alt form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="Aadhaar Number" id="aadhar_number" name="aadhar_number">
        <span class="fa fa-bookmark-o form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input disabled type="text" class="form-control text-bold" placeholder="PAN No" id="pan_number" name="pan_number" >
        <span class="fa fa-columns  form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        <input disabled type="button" name="submit" class="btn btn-info" value="Register" data-toggle="modal" data-target="#modal-info2">
        </div>
        <!-- /.col -->
        
                      
          <!-- Modal Class Code-->
          <div class="modal modal-info fade" id="modal-info2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Terms & Conditions</h4>
              </div>
              <div class="modal-body">
              <label  for="id"><ol><li>5% TDS Charge.</li><li>10% Admin Charge</li><li>If PAN Card is not entered 15% admin Charge.</li><li>Invoice will be auto generated Settings->Invoice Menu</li>
              <li>5% Repurchase Amount.</li></ol></label>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-outline" id="submit" value="I am ready with above Terms & Conditions. Register Me Now."/>
              </div>
            </div>
           </div>
          </div>
          <!-- Modal Class Code Ends-->
      </div>
    </form>
    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
  </div>
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>


  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
  
  function validateForm()
  {
    var epin = document.getElementById("e_pin").value;
    var email= document.getElementById("email_id").value;
    var password = document.getElementById("password").value;
    var confirm_password= document.getElementById("confirm_password").value;
    var aadhar_no =  document.getElementById("aadhar_number").value;
    var pan_no =  document.getElementById("pan_number").value;
    var account_no =  document.getElementById("account_no").value;
    var nominee_name = document.getElementById("nominee_name").value;
    var mobno = document.getElementById("mobile_no").value;
    var nominee_relationship_name= document.getElementById("nominee_relationship_name").value;
    var fname = document.getElementById("first_name").value;
    var mname = document.getElementById("middle_name").value;
    var lname = document.getElementById("last_name").value;

    var regexppass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}/;
    var regexpmob = /^[0-9]{10}/;
    //var empattern =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var empattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var regexpepin = /^[0-9]{6}(\s*,*,\s*[0-9]{6})*/;
    var regexpname = /^[A-z]+$/;
    var regexpaadhar = /^[0-9]{10,12}$/;
   
    

    if(!regexpepin.test(epin))
    {
      alert("Only 6 digits numbers are allowed for Epin.");
      return false;
    }
    else if(!empattern.test(email)){
     alert("Email pattern is not valid ");
     return false;
   }  
   else if(!regexppass.test(password))
    {
      alert("Password must contain. 1. At least 8, but no more than 32 characters.\n 2. At least one UPPERCASE letter.\n 3.At least one lowercase letter.\n 4. At least one special character,. Do not use < >& or \n 4.At least one number.");
      return false;
    }
    else if(password != confirm_password)
    {
       alert(" password does not match ");
       return false;
   }  
    else if(!regexpmob.test(mobno))
    {
      alert("Invalid mobile number.");
      return false;
    }
    else if(!regexpaadhar.test(aadhar_no))
    {
        if(aadhar_no != ""){
      alert("only 12 digits number are allowed for Aadhar.");
      return false;
            
        }
    }
    /*else if(!regexpname.test(fname)||!regexpname.test(mname)||!regexpname.test(lname)||!regexpname.test(nominee_name)||!regexpname.test(nominee_relationship_name))
    {
      alert("only characters are allowed for Name,Nominee Name And Nominee Relationship."+fname+mname+lname+nominee_name+nominee_relationship_name);
      return false;
    }*/
   
    
}
</script>
</body>
</html>