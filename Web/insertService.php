<?php
/**
 * Created by PhpStorm.
 * User: Mamdouh El Nakeeb
 * Date: 4/13/17
 * Time: 4:35 PM
 */

$flag = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {

    require ("secure/access.php");
    require ("secure/DrNourConn.php");
    if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['advantages']) && !empty($_POST['video'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $advantages = $_POST['advantages'];
        $video = $_POST['video'];

        $servicesFolder = "gallery/services/";
        $photoName=$_FILES["name"][ "name" ];
    	move_uploaded_file($_FILES["name"]["tmp_name"], "$servicesFolder".$_FILES["name"]["name"]);


        $access = new access(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $access->connect();
        $result = $access->insertService($title, $content, $advantages, $photoName, $video);

        $access->disconnect();

        if($result){
            $flag = "Service Added Successfully";
        }
    }
    else{
        $flag = "Missing Fields!";
    }

}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="DrNour | Add Service">
    <meta name="author" content="">

    <title>DrNour | Add Service</title>

    <!-- Icon -->
    <link rel="shortcut icon" href="img/nour-logo-new.png" >

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


</head>

<body>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

</br>
<div class="container">

    <div class="row">
        <div class="col-s4" align="center">
            <img src="img/nour-logo-new.png" width="50%"/>
            <h3 class="text-center"><?php echo $flag; ?></h3>
        </div>
    </div>

    <h3 class="text-center">Add Service</h3>

    <!-- Service Form -->
    <div class="row">
        <form role="form" name="form1" id="form1" method="post" enctype="multipart/form-data" action="" class="col-s12" accept-charset="utf-8">

            <div class="row">
                <div class="input-field col s12">
                    <input id="title" name="title" type="text" class="validate" required>
                    <label for="title">Service Title</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="content" name="content" class="materialize-textarea" required></textarea>
                    <label for="content">Content</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="advantages" name="advantages" class="materialize-textarea" required></textarea>
                    <label for="content">Advantages</label>
                </div>
            </div>

            <div class="row">
                <div class="file-field input-field">
                    <div class="btn red darken-4">
                        <span>Photo</span>
                        <input type="file" name="name" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="video" name="video" type="text" class="validate" required>
                    <label for="video">Video Code</label>
                </div>
            </div>

            <br>
            <div align="center" class="row">
                <button class="btn waves-effect waves-light red darken-4" type="submit" name="submit">Add Service
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light light-blue accent-4" type="reset">Reset</button>
            </div>

    </div>

    </form>
</div>

</div>

</body>

</html>