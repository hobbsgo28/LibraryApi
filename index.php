<!-- <!DOCTYPE html> -->
<html lang="en">
    <head> 
      <?php include("fonts.php"); ?>   

      <link rel="stylesheet" href="style.css"> </head>
<!-- <head> -->
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Webservice</title>


    <?php 
    session_start();
    include("header.php");

    ?>
<div class="container-main">

<?php 
include("globals.php");
  if (isset($_GET["msg"])) {
    switch ($_GET["msg"]) {
      case 14:
        echo $MSG_14;
        break;
        // case 3:
        //     echo $MSG_3;
        //     break;
      default:
        echo $MSG_1;
        break;
    }
}

?>
</div>

<body>




</body>
</html>
<?php include("footer.php"); ?>
