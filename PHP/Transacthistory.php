<?php
 include 'connect.php'
 
$sql= "SELECT * FROM transaction";
$result= mysqli_query($con , $sql);
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
      <h1> Transactions</h1>
</header>
      <section>
      <table allign="center"   cellpadding="5px" border="1" >
          <tr>
              <th> Transaction Id </th>
              <th> Sender </th>
              <th> Receiver </th>
              <th> Amount </th>
              <th> Time  </th>
          </tr> 
          <?php
            if(mysqli_num_rows($result)>0)
            {
                while($row=$result->fetch_assoc())
                {
             ?>       
               <tr>
                       <td> <?php echo $row["id"]; ?> 
                       <td> <?php echo $row["sender"]; ?>
                       <td> <?php echo $row["receiver"]; ?>
                        <td> <?php echo $row["Amount"]; ?> 
                        <td> <?php echo $row["Time"];?> 
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


