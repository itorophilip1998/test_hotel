<?php   
$code=strval($_SERVER['QUERY_STRING']); 
$con=mysqli_connect("localhost","root","","hotel");
$check="SELECT * FROM roombook WHERE verification_code = '$code'";
$rs = mysqli_query($con,$check);   
$data=mysqli_fetch_array($rs);   
if($data) {    
     $update="UPDATE `roombook` SET `status`='Paid' WHERE `Verification_code`='$code'"; 
   $result=mysqli_query($con,$update);
   if($result){
     echo "<script>location.href='http://localhost/Project/Hotel/admin/reservation.php'</script>";  
   }
   echo "<script>location.href='http://localhost/Project/Hotel/admin/reservation.php'</script>";  
 
}
else {
    echo "<script>location.href='http://localhost/Project/Hotel/admin/reservation.php'</script>";
}
                                
?>