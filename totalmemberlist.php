<?php
$user="";
if(!session_start()){
  session_start();
}
if(isset($_SESSION["username"]))
{ 
   $user=$_SESSION["username"];
   include_once("header2.php");
}
 else if(isset($_SESSION["admin"])){
  include_once("header.php");
 }
 ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>
 <!-- Main content -->
    <section style="margin:0 20px;"> 
          <div class="box">
            <div class="box-header" style="text-align:center;">
              <form class="form-inline" action="/action_page.php">
              <h3 class="text-primary"><b>Total Member List</b></h3>
              <h4 style="color:teal"><b>Filter By ID:</b>
              <i class="fa fa-th-large" arial-hidden="true"></i>
            </h4> 
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Search">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
              <button type="button" class="btn btn-primary" style="margin-left:20px;">Show</button>
             </form>
        </div>
        </div>
    </section>
   
    <section class="content">   
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover bg-primary">
                <thead>
                <tr class="text-white">
                  <th>User ID</th>
                  <th>Login</th>
                  <th>DOJ</th>
                  <th>Name</th>
                  <th>Sponser</th>
                  <th>City</th>
                  <th>Product</th>
                  <th>Mobile</th>
                  <th>Earnings</th>
                  <th>Status</th>
                </tr>
                </thead>
                
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

