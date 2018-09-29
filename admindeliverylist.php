<?php
$user="";
if(!session_start()){
  session_start();
}
if(isset($_SESSION["admin"])){
  include_once("adminheader.php");
 }
 else{
    die("Please login to continue");
  }
 ?>
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h3 class="text-primary" style="text-align:center;"></h3>
      
    <ol class="breadcrumb">
        <li><a href="adminindex.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Delivery List</li>
      </ol>
    </section>

    <section style="margin:0 20px;"> 
          <div class="box">
            <div class="box-header" style="text-align:center;">
              <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
              <h3 class="text-primary"><b>Product Delivery List</b></h3>
          </form>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="deliverytab" class="table table-bordered table-hover">
                <thead>
                <tr class="text-white bg-teal">
                  <th rowspan="2">Sr No</th>
                  <th rowspan="2">User Id</th>
                  <th rowspan="2">Customer Name</th>
                  <th rowspan="2">Product Name</th>
                  <th rowspan="2">Price</th>                 
                  <th colspan="2">Status</th>
                </tr>
                <tr>
                    <th class="text-white bg-green">Delivered</th>
                    <th class="text-white bg-maroon">Not delivered</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sqlgetdelstat = "SELECT delt.cust_id AS uid, CONCAT(userdetail.f_name,' ' ,userdetail.m_name,' ',userdetail.l_name) AS 'FullName', prodlist.product_name AS 'ProductName', prodlist.selling_price AS 'Price', delt.status as Status FROM ng_deliverytable as delt INNER JOIN ng_userdetails as userdetail ON delt.cust_id=userdetail.user_id INNER JOIN ng_productlist AS prodlist ON delt.pack_id=prodlist.prod_id";
                $resdelstat = $conn->query($sqlgetdelstat);
                $isdelivered = false;
                $radioname="";
                if($resdelstat->num_rows > 0){
                    $i=1;
                    while($rowdelstat = mysqli_fetch_assoc($resdelstat)){
                        $isdelivered = $rowdelstat["Status"];
                        $radioname = $rowdelstat["uid"];
                        echo "<tr><td>$i</td>
                        <td>".$rowdelstat["uid"]."</td>
                        <td>".$rowdelstat["FullName"]."</td>
                        <td>".$rowdelstat["ProductName"]."</td>
                        <td>".$rowdelstat["Price"]."</td>
                        <td><input type='radio' id='yes' name='$radioname'/></td>
                        <td><input type='radio' id='no' name='$radioname' checked/></td>
                        </tr>";
                        $i++;
                    }
                }
                ?>
              </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  


<!-- Main content Ends here -->
<?php include_once("footer.php"); ?>

