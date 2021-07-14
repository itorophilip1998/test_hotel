 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paystack</title> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php   
$code=strval($_SERVER['QUERY_STRING']); 
$con=mysqli_connect("localhost","root","","hotel");
$check="SELECT * FROM roombook WHERE verification_code = '$code'";
$rs = mysqli_query($con,$check);   
$data=mysqli_fetch_array($rs);   
if($data) {   
   $vc=$data['Verification_code'];
   $email=$data['Email'];
   $price=$data['price'];
}
else {
    echo "<script>location.href='http://localhost/Project/Hotel/admin/reservation.php'</script>";
}
                                    
?>
<form class="row">
  <div class="col-md-6 mx-auto border  rounded-lg my-5 p-3">
  <h5 class="text-center"><u>Proceed Payment with the following Details</u> </h5> <br>
  <label for="">Email</label>
  <input id="my-input" class="form-control" type="text" value="<?php echo $email?>" readonly  >  <br>

  <label for="">Payment Reference Number</label> 
  <input id="my-input" class="form-control" type="text" value="<?php echo $vc?>" readonly  > <br>
  <small class="text-secondary">Please copy this reference number and keep it safe for payment verification</small> <br>
  <label for="">Amount</label> 
  <input id="my-input" class="form-control" type="text" value="<?php echo $price.' .00'?>" readonly  > 

  <script src="https://js.paystack.co/v1/inline.js"></script>
 
  <div class="left-center mt-3">
  <button type="button" class="btn btn-primary px-5" onclick="payWithPaystack()"> Pay </button>  </div>
<hr>
   <img  src="data:image/png;base64,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">
  </div>
</form>
<!-- place below the html form -->
<script>     
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_live_c6083e541b68da1036a3d392fee4bff452fb14c4',
      email: "<?php echo $email?>",
      Quantity: 1,
      amount: <?php echo $price?> * 100,
      currency: "NGN",
      ref: "<?php echo $vc?>", // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
        location.href='http://localhost/Project/Hotel/admin/paid.php?<?php echo $vc?>'; 
      },
      onClose: function(){ 
            location.href='http://localhost/Project/Hotel/admin/reservation.php';

      }
    });
    handler.openIframe();
  } 
</script>
 
</body>
</html>