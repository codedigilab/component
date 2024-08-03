<?php
require 'config.php';

if(isset($_GET['del'])){
  $stdid = $_GET['del'];

  $query = "DELETE FROM tb_images WHERE id={$stdid}";
  $deleteQuery = mysqli_query($conn, $query);
 
  if($deleteQuery){
    echo "Data successfully deleted";
  }
}



?>
<html>

<head> </head>

<body>
    <table border=1 cellspacing=0 cellpadding=10>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
            <td>Delete</td>
            <td>Edit</td>
        </tr>
        <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM tb_images");
      ?>
        <?php foreach ($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php $k= json_decode($row["image"]);  echo $k[2]; ?></td>
            <td style="display: flex; align-items: center; gap: 10px;">
              
                <img src="uploads/<?php $k= json_decode($row["image"]);   echo $k[2]; ?>" width=200>
                
            </td>
            <td><a href="index.php?del=<?php echo $row["id"]; ?>"> Delete</a></td>
            <td><a href="edit.php?update=<?php echo $row["id"]; ?>"> Edit</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="upload.php">Upload Image</a>
</body>

</html>