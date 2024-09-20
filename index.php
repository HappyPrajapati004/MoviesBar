<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDR COLLECTION</title>
    <link rel="stylesheet" href="Movies.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>

<body style="background-color:blueviolet;">
    <div id="maindiv">
        <div class="logo">
            <h2>HDR COllection</h2>
            <div class="navbar">
                <ul>
                    <li><a href="Bollywood.html">Bollywood Movie</a></li>
                    <li><a href="Hollywood.html">Hollywood Movies</a></li>
                    <li><a href="South.html">South Movies</a></li>
                    <li><a href="gujrati.html">Gujrati Movies</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
        <div class="contain">
            <h1>HDR <span>COLLECTION</span></h1><br>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam accusamus at quia voluptatum soluta
                sapiente nesciunt, repudiandae dolorem non quae! Dicta aliquid maiores repudiandae atque quae nihil
                nulla suscipit ratione! </p><br>
                <button onclick="menupage()">Go to Movies</button>
        </div>
    </div>
</body>
<script>
    function menupage(){
    window.location.href = 'Home.php'
}
</script>
</html>