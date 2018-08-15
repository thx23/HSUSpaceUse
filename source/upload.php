<?php
    session_start();
    require_once('./config.php');
	//Get's username from the login and greets the user to the homepage
	//Also add instructions for new users to help navigate the page.
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title> SpaceUse Floor Creator </title>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/layout.css" type="text/css" >
    <link rel="stylesheet" href="styles/format.css" type="text/css" >
</head>
<body>
    <header>
        <img class="logo" src="images/hsu-wm.svg">
        <h1>SpaceUse</h1>

    <?php
        if (array_key_exists("username", $_SESSION)){
            ?>
            <h3 class="log-state"> Logged In: <?= $_SESSION["username"]?> </h3>
            <?php
        }
    ?>

        <?php
            if (!array_key_exists("username", $_SESSION)){
                ?>
                <p class="invalid-login"> Please first <a href="index.php">login</a> before accessing the app</p>
                <?php
            }
            
            else{
                 ?>
                <nav>
                    <p class="nav"><a href="home.php">Home</a></p>
                    <p class="nav"><a href="data-collection.php">Data Collection</a></p>
                    <p class="nav"><a href="query-select.php">Query Report</a></p>
                    <p class="nav"><a href="editor.php">Layout Creator</a></p>
                    <p class="nav selected"><a href="create-floor.php">Floor Creator</a></p>
                    <p class="nav"><a href="logout.php">Logout</a></p>
                </nav>
    </header>
    <main>
        <?php
            //This is the path where the picture will be stored
            $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/LibraryApp/library_app/source/images/";
            //This is the path that will be uploaded to the DB
            //This is needs to be different because we use the short path to upload the picture to the maps
            $db_dir = "images/";
            $imageFilePath = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $pathForDB = $db_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($imageFilePath,PATHINFO_EXTENSION));
           
            // Check if file already exists
            if (file_exists($imageFilePath)) {
                $uploadOk = 0;
            ?>  
                <p> Sorry, file already exists. Please try again.</p>
                <button class="floor_creator_button" onclick="window.location.href='create-floor.php'"> Return </button>
            <?php
            }

            // Allow certain file formats
            if($imageFileType != "svg"  ) {
                echo "Sorry, only SVG images are allowed. ";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk != 0) {

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $imageFilePath)) {
                    $floor_name = $_POST["floorName"];
                    $floor_num = $_POST["floorNum"];
                    $_SESSION["path"] = $pathForDB;
                    $_SESSION["floor_num"] = $floor_num;
                    $_SESSION["floor_name"] = $floor_name;
                    
                    //setup connection to DB
                    $dbh = new PDO($dbhost, $dbh_insert_user, $dbh_insert_pw);

                    $dbh->beginTransaction();
                    $insert_image_stmt = $dbh->prepare('INSERT INTO floor_images (name, path, floor_num) 
                                                        VALUES (:floor_name, :pathForDB, :floor_num)');
                    $insert_image_stmt->bindParam(':floor_name', $floor_name, PDO::PARAM_STR);
                    $insert_image_stmt->bindParam(':floor_num', $floor_num, PDO::PARAM_INT);
                    $insert_image_stmt->bindParam(':pathForDB', $pathForDB, PDO::PARAM_STR);

                    $insert_image_stmt->execute();
                    $dbh->commit();
                    
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
                    ?>
                    <button class="floor_creator_button" onclick="window.location.href='create-area.php'"> Create Areas </button>
                    <?php
                } 
            }
        ?>
    </main>
                <?php
                }
            ?>
    <footer>
        <p>Designed by HSU Library Web App team. &copy; Humboldt State University</p>
    </footer>
</body>
</html>