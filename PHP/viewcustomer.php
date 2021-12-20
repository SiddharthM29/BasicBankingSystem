<?php
 include 'connection.php';
$sql= "SELECT * FROM customer";
$result= mysqli_query($con , $sql);
$count=0;
?>
  
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      
      <link  rel="stylesheet" href="viewcustomer.css"> 
  </head>
  <body>
      <header>
      <h1> Customers</h1>
</header>
      <section  class="data">
      <table allign="center"   cellpadding="5px" cellspacing="0px" border="1" >
          <tr>
              <th> Account Number </th>
              <th> Name </th>
              <th> Email Id </th>
              <th> phone nuumber </th>
              <th> Balance  </th>
              <th> operation </th>
          </tr> 
          <?php
            if(mysqli_num_rows($result)>0)
            {
                while($row=$result->fetch_assoc())
                {
             ?>       
               <tr>
                       <td> <?php echo $row["AccountNumber"]; ?> 
                       <td> <?php echo $row["Name"]; ?>
                       <td> <?php echo $row["EmailId"]; ?>
                        <td> <?php echo $row["phoneNumber"]; ?> 
                        <td> <?php echo $row["CurrentBalance"];?> 
                        <td> <button class="transfer" > <a class="text"href="transfer.php?val= <?php  echo $row['ID']; ?>  "  >transfer</a> <?php ?> </button> 
                </tr>
                <?php   
                    }
            }
            ?>
            </table>
        </section>  <br> <br>
            <button id="back"> <a class="text"href="index.php">Back </a> </button>
             
  </body>
  </html>


