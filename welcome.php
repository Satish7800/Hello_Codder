
<?php
session_start();
include_once('connection.php');
if(isset($_SESSION['user_id']))
{
  $id=$_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
 <script src="jquery.js"></script>
  <style>
    .error {
  color: red;
}
  </style>
</head>
<body>
  


<!-- Modal -->
<div class="modal fade mymodal" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add New Records</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="myform" action="">
      <div class="form-group">
          <label for="">First Name</label>
          <input type="text" name="first_name" id="first_name" required class="form-control">
      </div>
      <div class="form-group">
          <label for="">Last Name</label>
          <input type="text" name="last_name" id="last_name" required class="form-control">
      </div>
      <div class="form-group">
          <label for="">Email</label>
          <input type="email" name="email" id="email" required class="form-control">
      </div>
      <div class="form-group">
          <label for="">Phone</label>
          <input type="text" name="phone" required pattern="[7-9]{1}[0-9]{9}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" id="phone" class="form-control">
      </div>
      <div class="form-group">
          <label for="">City</label>
          <input type="text" name="city" id="city" required class="form-control">
      </div>
      <div class="form-group">
          <label for="">Address</label>
          <textarea type="text" name="address" id="address" required class="form-control" col=3 row=4></textarea>
      </div>
      </form>
     
      </div>
      <div class="modal-footer">
      <span id="msg" style="padding-right:120px;color:red"></span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="savedata"  class="btn btn-primary">Save Now</button>
        
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade mymodal2" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Records</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="">
      <div class="form-group">
          <label for="">First Name</label>
          
          <input type="text" id="f_name" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="">Last Name</label>
          <input type="text" id="l_name" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="">Email</label>
          <input type="email"  id="u_email" class="form-control" required >
      </div>
      <div class="form-group">
          <label for="">Phone</label>
          <input type="text" id="u_phone" pattern="[7-9]{1}[0-9]{9}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="">City</label>
          <input type="text" id="u_city" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="">Address</label>
          <textarea type="text" id="u_address" class="form-control" required col=3 row=4></textarea>
      </div>
      </form>
     
      </div>
      <div class="modal-footer">
      <span id="msg" style="padding-right:120px;color:red"></span>
      <button type="button" onclick="getUpdateUser()" class="btn btn-primary">Update Now</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="heddenid">
      </div>
    </div>
  </div>
</div>
<script>


</script>






<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <a class="navbar-brand " style="padding-left:10px;" href="#">Crud Application</a>
  <?php
    $q="select * from users where user_id='$id'";
    $exe=mysqli_query($con,$q);
    $data=mysqli_fetch_assoc($exe);
  ?>
 <span class="mr-auto">Welcome: <b class="text-light"><?php echo $data['name'];?></b></span>
 <a  class="btn btn-dark ml-auto" href="logout.php">Sign Out</a>
</nav>


   
      <div class="container mt-5">

      <center><span id="dis" style="color:green;"></span></center>                

      <h3>Users List</h3>

      <?php 
                    if(isset($_SESSION['success']))
                    {
                    ?> 
                    <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">×</a>
                        <?php  echo $_SESSION['success']; ?>
                    </div>
                   
                    <?php  
                    unset($_SESSION['success']);
                    }
                    if(isset($_SESSION['error']))
                    {
                     
                        ?> 
                        <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">×</a>
                        <?php  echo $_SESSION['error']; ?>
                        </div>
                        <?php
                        unset($_SESSION['error']);
                    }
                    
                ?>


      
      <button type="button" class="btn btn-primary mb-2 " data-toggle="modal" data-target="#exampleModalScrollable">
      New
    </button>     
    <sapn class="dis"></span>
    
                    
                    

        <sapn class="dis"></span> 
          <div class="allData"></div>
              
              </div>
              
  

    </div>
   
</body>
</html>

<?php
}
else
{
  header('Location:sign_in.php');   
}

?>

<script>

setTimeout(function(){ $(".alert").remove() }, 3000);
setTimeout(function(){ $("#dis").remove() }, 4000);
</script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js">

<script>
$(function() {

$("#myform").validate({
  rules: {
    first_name: {
      required: true,
      minlength: 5
    },
    last_name: {
      required: true,
      minlength: 3
    },
    email: {
      required: true
    },
    phone: {
      required: true,
      number:true
    },
    city: {
      required: true
    },
    address: {
      required: true,
      minlength: 8
    }

  },
  highlight: function (element) {
                $(element).parent().addClass('error')
            },
            unhighlight: function (element) {
                $(element).parent().removeClass('error')
            },
  messages: {
    
    action: "Please provide some data"
  }
});
});
</script> -->
