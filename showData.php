<html>
    <head> 
        <?php include("fonts.php"); ?>   
        <link rel="stylesheet" href="style.css"> 
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php 
    session_start();
    include("header.php");
    ?>
<body>
    <div class="container-main">

<!-- 
<div class="container">
  <div class="column-wing">
</div>

  <div class="column-1"> -->
<!-- 
  <div class="container">
  <div class="column-2"> -->
<!-- <h1> Saved Books </h1> -->

<?php 
// include("globals.php");
include("conn.php");

// if (isset($_GET["msg"])) {
//     switch ($_GET["msg"]) {
//         case 4:
//             echo $MSG_4;
//             break;
//         case 6:
//             echo $MSG_6;
//             break;
//         case 8:
//             echo $MSG_8;
//             break;
//         case 12:
//             echo $MSG_12;
//             break;
//         default:
//             echo $MSG_1;
//             break;
//     }
// }
?>

<?php
    // BookKey, title, subtitle, ebook_access, cover_edition_key, edition_count, author_key, author_name
//  has_fulltext, publish_year, language
$dataqry = "SELECT ID, bookKey, title, subtitle, ebook_access, cover_edition_key, 
        edition_count, author_key, author_name, has_fulltext, publish_year, lan FROM openLibrary";
$dataqry = $conn->prepare($dataqry);
        
// } else { // no access
//     header("Location: index.php?msg=14");
// }
$dataqry->execute();
$dataqry->store_result();

$dataqry->bind_result($id, $bookKey, $title, $subtitle, $ebookAccess, $coverEditionKey, $editionCount, 
        $authorKey, $authorName, $hasFulltext, $publishYear, $lan);
?>
<table> 
    <tr>

    <!-- // BookKey, title, subtitle, ebook_access, cover_edition_key, edition_count, author_key, author_name
//  has_fulltext, publish_year, language
//values not shown: cover_i, public_scan_b -->
        <th>ID</th>
        <!-- <th>Book Key</th> -->
        <th>Title</th>
        <!-- <th>Subtitle</th> -->
        <th>Ebook Access</th>
        <!-- <th>Cover Edition Key</th> -->
        <th>Edition Count</th>
        <!-- <th>Author Key(s)</th> -->
        <th>Author Name(s)</th>
        <!-- <th>Has Fulltext</th> -->
        <th>Publish Year</th>
        <!-- <th>Language(s)</th> -->

    </tr>
<?php
    
        
    while ($dataqry->fetch()) {
?>
        <tr> 
            <!-- $id, $bookKey, $title, $subtitle, $ebookAccess, $coverEditionKey, $editionCount, 
        $authorKeySave, $authorNameSave, $hasFulltext, $publishYear, $lanSave -->
            <td> <?php echo $id ?> </td>
            <!-- <td> <?php echo $bookKey  ?> </td> -->
            <td> <?php echo $title  ?> </td>
            <!-- <td> <?php echo $subtitle ?> </td> -->
            <td> <?php echo $ebookAccess ?> </td>
            <!-- <td> <?php echo $coverEditionKey ?> </td> -->
            <td> <?php echo $editionCount ?> </td>
            <!-- <td> <?php echo $authorKey ?> </td> -->
            <td> <?php echo $authorName ?> </td>
            <!-- <td> <?php echo $hasFulltext ?> </td> -->
            <td> <?php echo $publishYear ?> </td>
            <!-- <td> <?php echo $lan ?> </td> -->



            <!-- <td> <form style="all: unset;" action="updateInfo.php?userId=<?=$userId?>" method="post">
                <button type="submit" name="updateInfo" value="<?= $userId ?>" >Update Information</button> </form> </td>
            <td> <form style="all: unset;" action="removeAcct.php?userId=<?=$userId?>" method="post">
                <button type="submit" name="removeAcct" value="<?= $userId ?>" >Delete Account</button> </form> </td> -->
        </tr>

        
<?php   

        }
?>      </table>
<!-- </div>

  <div class="column-wing">

</div> -->

</div>
<!-- </div> -->

</body>
</html>
<?php    include("footer.php"); ?>

