<?php
    include_once("connect.php");
    $u_id = $_POST["dataget"];
    $getval = $_POST["x"];
    $e_pin="";
    if(isset($_POST["epin"])){
        $e_pin = $_POST["epin"];
    }
     if($getval==1){
   
        $chkuservalidity = "SELECT user_id FROM ng_userdetails WHERE BINARY user_id = '".$u_id."'";
        $resuser = $conn->query($chkuservalidity);
        if($resuser->num_rows == 0)
        {
            echo "Invalid User Id Entered";
        }   
        if($resuser->num_rows > 0)
        {
            $countuser = "SELECT count(*) FROM ng_userdetails WHERE BINARY refferal_id = '".$u_id."'";
            $countres = $conn->query($countuser);
            $rowcount = mysqli_fetch_array($countres);
            $mycheck = $rowcount[0];
            if($mycheck == 5)
            {
                echo "This user has completed 5 childs. Please select another Refferal Id";
            }   
         }
    }
    else if($getval==2){
        if($u_id == ""){
            echo "Please enter a valid userid";
        }
        else if($e_pin==""){
            echo "Please enter a valid E-Pin";
        }
        else{        
            $queryepincheck ="SELECT package_id FROM ng_epintable WHERE BINARY sponsor_id ='".$u_id."' AND epin=".$e_pin." and status = 0"; 
            $resepincheck = $conn->query($queryepincheck);   
            if($resepincheck->num_rows > 0 ){
               $rowpackid = mysqli_fetch_array($resepincheck);
               $mypack_id = $rowpackid[0];
               $sqlgetpackname = "SELECT package_name, selling_price FROM ng_productlist WHERE prod_id = '".$mypack_id."'";
               $respackname = $conn->query($sqlgetpackname);
               $pack_name=$pack_price="";
               $rowpackdetails = mysqli_fetch_array($respackname);
               $pack_name = $rowpackdetails[0];
               $pack_price = $rowpackdetails[1];
               $output =  array('acccountsuccess'=>'Congratulations You have Successfully added Reffaral code and Epin. You can now continue with filling other details. Your Product Name = '.$pack_name.' @ Rs. '.$pack_price.' Only',
               'packid'=>$mypack_id);
               echo json_encode($output);

            //    echo "Congratulations You have Successfully added Reffaral code and Epin. You can now continue with filling other details. Your Product Name = $pack_name @ Rs. $pack_price Only ";

            }
            else{
                echo "Invalid combination of Referral Id and E-Pin";
            }
         }
    }
    else if($getval==3){
        if($u_id==""){
            echo "3";
        }
        else{
            $sqlcheckuserid ="select user_id from ng_userdetails where user_id = '".$u_id."'";
            $reschkuid = $conn->query($sqlcheckuserid);
            if($reschkuid->num_rows > 0){
                echo "1";
            }
            else{
                echo "0";
            }
        }
        
    }
   
    
?>