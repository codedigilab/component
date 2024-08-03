<?php
require 'config.php';


if(isset($_GET['update'])){
    $stdid = $_GET['update'];
  
  
  
    

    // $query = "DELETE FROM tb_images WHERE id={$stdid}";
    // $deleteQuery = mysqli_query($conn, $query);
   
    // if($deleteQuery){
    //   echo "Data successfully deleted";
    // }
  }
  


?>

<form method="post" action="" enctype="multipart/form-data" class="d-flex justify-content-around">
    <?php
              if(isset($_GET['update'])){ //if click on update button
                $stdid = $_GET['update']; //geting update id from search query
                $query = "SELECT * FROM tb_images WHERE id={$stdid}";
                $getData = mysqli_query($conn, $query); //getting data based on query

                while($rx=mysqli_fetch_assoc($getData)){ //keep data rx variable afte fetch
                  $stdid = $rx['id'];
                  $name = $rx['name'];

                  if(isset($_POST['update-btn'])){
                    $name = $_POST['name'];
                    $totalFiles = count($_FILES['fileImg']['name']);
                    $filesArray = array();
                  
                    for($i = 0; $i < $totalFiles; $i++){
                      $imageName = $_FILES["fileImg"]["name"][$i];
                      $tmpName = $_FILES["fileImg"]["tmp_name"][$i];
                  
                      $imageExtension = explode('.', $imageName);
                      $imageExtension = strtolower(end($imageExtension));
                  
                      $newImageName = uniqid() . '.' . $imageExtension;
                  
                      move_uploaded_file($tmpName, 'uploads/' . $newImageName);
                      $filesArray[] = $newImageName;
                    }
                  
                    $filesArray = json_encode($filesArray);

                   if(!empty($name) && !empty($filesArray)){
                    $query = "UPDATE tb_images SET name='$name', image='$filesArray' WHERE id=$stdid";
                    $updateQuery = mysqli_query($conn, $query);
                     if($updateQuery){
                       echo "Data Updated successful";
                     }
                   }
  
                  }
               
            ?>
    <input class="form-control me-3" type="text" name="name" value="<?php echo $name ?>">
    <input type="file" name="fileImg[]" accept=".jpg, .jpeg, .png" required multiple>
    <input class="btn btn-primary" type="submit" value="Update" name="update-btn">
    <?php 
                } //closing previous php while/if backet
              } ?>


</form>