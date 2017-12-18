<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

    $con=new mysqli("localhost","root","","imagestored");
    if($con->connect_error)
    {
        echo $con->connect_error;
        die("sorry database connection failed");
   }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="image">
            <input type="submit" name="submit" value="save">
        </form>    
        <?php
            if(isset($_POST["submit"]))
            {
               $image=$_FILES['image']['tmp_name'];
               $image=file_get_contents($image);
               $image=base64_encode($image);
               $sql="INSERT INTO image(image) VALUES ('$image')";
               if($con->query($sql))
               {
                   echo "correct";
                   
               }
               else {
                   echo "not correct";
               }
            }
            $sql="SELECT * from image";
            $result=$con->query($sql);
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                    echo "<img width='150px' height='150px' src='data:image;base64,{$row['image']}'>";
                    echo "<br>";
                
                }
      
            }
            else
                {
                    echo "no image stored";
                 
                }
            ?>
    </body>
</html>
