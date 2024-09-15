<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HDR COLLECTION</title>
  <link rel="stylesheet" href="Home.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet" />
</head>

<body>
  <div id="maindiv">
    <div class="logo">
      <h2>HDR Collection</h2>
    </div>
    <div class="container">
      <div class="boxes">
        <?php
        include('config.php');
        // Fetch data from the database
        $sql = "SELECT name, discription, image FROM new_release_movie";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Output data for each row
          while ($row = $result->fetch_assoc()) {
            // $name = $row["name"];
            $description = $row["discription"];
            $image = $row["image"];

            // Display the data
            echo "<div class='box'>";
            echo "<img class='fixed-size' src='uploads/" . $image . "' alt='" . "' style='width:200px;height:250px;object-fit:cover;'>";
            echo "<p>" . $description . "</p>";
            echo "</div>";
          }
        } else {
          echo "No records found.";
        }
        // Close the database connection
        $conn->close();
        ?>

      </div>
    </div>
  </div>
</body>

</html>