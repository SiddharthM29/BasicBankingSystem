<?php
  include 'connection.php';
 if(isset($_POST['submit']))
 {
 $from =$_GET['val'];
 $to = $_POST['to'];
 $amount = $_POST['amount'];
 
 $sqlfrom="SELECT * FROM customer where ID=$from";
 $result1=mysqli_query($con,$sqlfrom);
 $sql1=mysqli_fetch_assoc($result1);

 $sqlto="SELECT * from customer where ID=$to";
 $result2=mysqli_query($con,$sqlto);
 $sql2=mysqli_fetch_assoc($result2);

 if(($amount)<0) //checking if negative amount is entered 
 {
     echo '<script type="text/javascript">';
     echo 'alert("Negative amount cannot be transfered")';
     echo '</script>';
 }

else  if($amount > $sql1['CurrentBalance']) //checing if the amount entered to send is greater than Balance
    {
      echo '<scriopt type="text/javascript">';
      echo 'alert(""You have insufficient balance to do this transactuon")';
      echo '</script>';
    }
  else if($amount==0) //checking if amount entered is 0
  {
      echo '<script type="text/javascript">';
      echo 'alert("0 amount cannot be transfered ")';
      echo '</script>';
  }
  else{
      $newbalance=$sql1['CurrentBalance']-$amount;  //subtracting amount to be sent from sender's account Balance
      $updatesender="UPDATE customer set CurrentBalance=$newbalance where ID=$from";
      mysqli_query($con,$updatesender);


      $newbalance=$sql2['CurrentBalance']+$amount; //Adding the received amount to receivers Balance
      $updatereceiver="UPDATE customer set CurrentBalance=$newbalance where ID=$to";
      mysqli_query($con,$updatereceiver);

       //Inserting the transaction in transactions table
      $sender=$sql1['Name'];
      $receiver=$sql2['Name'];
      $insert="INSERT INTO `transaction` (`sender`, `receiver`, `Amount`, `Time`) VALUES ( '$sender', '$receiver', '$amount', CURRENT_TIMESTAMP);";
      $sql3=mysqli_query($con,$insert);

      if($sql3){
              echo "<script> alert('Transaction Successful');
             window.location='viewcustomer.php';
             </script>";

      }
      $newbalance=0;
      $amount=0;    

  }

}
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <style>  
      *{
        box-sizing: border-box;
      }

           table{
    width: 90%;
    height: 30%;
    border:steelblue;
    border-width: 3px;
}
th{
    background-color:steelblue;
    color: white;
}
tr{
    background-color: honeydew;
}

  section{
         border-style: solid;
            border-width: 2px;
            margin-left: 20%;
            margin-top:5%;
           width: 50%;
           height: 70%;
          padding: 25px;
          background-color: ivory;
          font-size: 20px;
}
  }
  section h2{
    text-align: center;
  }
  .form{
      width:80%;
  }
  .btn{
    background-color: forestgreen;
    color: white;
    width:30%;
    padding:5px;
    font-size: 20px;
}
  }
  
  

    </style>
  </head>
  <body>
      <section>
          <center> <h2> Transfer Money </h2></center>
     <form method="post"class="transaction" name="transaction"><br>
      <label> From </label>
      <table allign="center" border="1" >
          <tr>
              <th> Account Number </th>
              <th> Name </th>
              <th> Balance </th>
          </tr> 
          <?php
          include 'connection.php';
            $value=$_GET['val'];  
           $sql="SELECT * FROM customer where ID=$value";
           $result=mysqli_query($con,$sql); 
           if(!$result)
           {
               echo "error: ".$sql."<br> ".mysqli_error($con);
           }
          $row=$result->fetch_assoc();
 
     ?>
<tr>     
<td> <?php echo $row["AccountNumber"];?>
<td><?php echo $row["Name"];?>
<td> <?php echo $row["CurrentBalance"];?>
<?php

?>
 </table> <br> 
 <label> To </label> <br>
 <select name="to" id="customers" class="form" required>
     <option value=""disabled selected>choose</option>
     <?php 
         include 'connection.php';
         $id=$_GET["val"];
         $sql = "SELECT * FROM customer where ID!=$id";
         $result=mysqli_query($con,$sql);
         if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {

     ?>
         <option class="table" value="<?php echo $rows['ID'];?>" >
                AccountNumber <?php echo $rows['AccountNumber'];?>
                (<?php echo $rows['Name'] ;?> )
           
            </option>
            <?php 
                } 
            ?>

 </select>  <br> <br>
 <label> Enter Amount in Rupees </label> <br>
 <input type="number" id="amount" name="amount" class="form"><br> <br>
  <center><button type="submit"name="submit" class="btn">Send</button> </center>
</form>
</section> <br> <br>
<button  style="border-radius: 8px;
    padding: 8px;
    font-size: 15px;
    width: 4%;
    background-color:darkmagenta;"><a style="color:white;text-Decoration:none;"href="viewcustomer.php">Back</a> </button>
</body>
</html>





















