<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="upload.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

  <div class="fcontainer">
    <div class="form-container">
      <p class="title">Upload Home Page Detail</p>
      <form class="form" action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
          <label for="username">Movie Name</label>
          <input
            type="text"
            name="name"
            id="username"
            placeholder=""
            required />
        </div>
        <br>
        <div class="input-gp">
          <label for="indus">Select Movie Type</label>
          <div class="select-box">
          <select name="indus" id="indus" >
            <option value="bollywood">Bollywood Movie</option>
            <option value="hollywood">Hollywood Movie</option>
            <option value="south">South Movie</option>
            <option value="gujrati">Gujrati Movie</option>
          </select>
          </div>
        </div>
        <br>
        <div class="input-group">
          <div class="img-box">
          <input id="file" type="file" name="image" accept="image/*" />
          <label for="file">
            <span class="material-symbols-outlined">
              add_a_photo
            </span>Select image</label>
            <span id="file-name">No file selected</span>
          </div>
        </div>
        <br>
        <div class="input-group">
          <label for="password">Discription</label>
          <input
            type="text"
            name="text"
            required
            id="password"
            placeholder=""></l>
        </div>
        <br>
        <button class="sign" type="submit">Upload</button>
      </form>
    </div>
    <?php
    // Include your database connection
    include('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve form data
      $name = $_POST['name'];            // Movie name
      $description = $_POST['text'];     // Description
      $indus = $_POST['indus'];          // Movie type (for dynamic table selection)

      // Handle image upload
      $targetDir = "uploads/";                            // Directory to save the image
      $imageName = basename($_FILES["image"]["name"]);     // Image file name
      $targetFilePath = $targetDir . $imageName;           // Full path to save the file
      $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));  // File extension

      // Allowed file types
      $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

      // Check if the file type is allowed
      if (in_array($imageFileType, $allowedTypes)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
          // Start a transaction to ensure both inserts are successful
          $conn->begin_transaction();

          try {
            // Insert into the 'new_release_movie' table
            $sql1 = "INSERT INTO new_release_movie (name, discription, image) 
                         VALUES ('$name', '$description', '$imageName')";

            if ($conn->query($sql1) === TRUE) {

              // Dynamically insert into the selected table (e.g., 'bollywood', 'hollywood', etc.)
              $sql2 = "INSERT INTO $indus (name, description, image) 
                             VALUES ('$name', '$description', '$imageName')";

              if ($conn->query($sql2) === TRUE) {
                // Commit the transaction if both inserts succeed
                $conn->commit();
                echo "<script type='text/javascript'>alert('Data uploaded successfully into both tables!');
                   window.location.href = 'Upload.php';
                   </script>";
              } else {
                // Rollback if the second insert fails
                $conn->rollback();
                echo "<script type='text/javascript'>alert('Error inserting into $indus table: '. $conn->error');</script>";
              }
            } else {
              // Rollback if the first insert fails
              $conn->rollback();
              echo "<script type='text/javascript'>alert('Error inserting into new_release_movie: ' . $conn->error');</script>";
            }
          } catch (Exception $e) {
            // Rollback transaction if an exception occurs
            $conn->rollback();
            echo "Transaction failed: " . $e->getMessage();
          }
        } else {
          echo "Sorry, there was an error uploading your image.";
        }
      } else {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
      }
    }

    // Close the database connection
    $conn->close();
    ?>

  </div>
  <script>
    document.getElementById("file").addEventListener("change", function() {
  var fileName = this.files[0].name;
  document.getElementById("file-name").textContent = fileName;
});

  </script>
</body>

</html>