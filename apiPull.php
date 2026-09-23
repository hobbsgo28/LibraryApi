
<head>  
    <?php include("fonts.php"); ?>   
    <link rel="stylesheet" href="style.css"> 
</head>
<?php     include("header.php"); ?>
<div class="container-main">
    <title>Library Search</title>

<?php
include("globals.php");
if (isset($_GET["msg"])) {
    switch ($_GET["msg"]) {
        case 2:
            echo $MSG_2;
            break;
        case 3:
            echo $MSG_3;
            break;
        default:
            echo $MSG_1;
            break;
    }
}

include("conn.php");

$checkqry = "SELECT bookKey FROM openlibrary WHERE EXISTS (SELECT bookKey FROM openlibrary WHERE bookKey=?)";
$checkqry = $conn->prepare($checkqry);


//stores the values from the search.php form
if(isset($_POST["search"])){
    $keyword = $_POST["keyword"];
    $year = $_POST["year"];


// echo $keyword.$publishYear;

$endpoint_url= "https://openlibrary.org/search.json?q=".$keyword."&first_publish_year=".$year."&page=1&limit=1";
// $endpoint_url= "library.json";

$response= file_get_contents($endpoint_url);

$data = json_decode($response, true);

echo "<br>";

//assigns the json values to a local variable 
$bookKey= $data['docs'][0]['key'] ?? "";
$title = $data['docs'][0]['title'] ?? ""; 
$subtitle= $data['docs'][0]['subtitle'] ?? ""; 
$ebookAccess = $data['docs'][0]['ebook_access'] ?? "";
$coverEditionKey= $data['docs'][0]['cover_edition_key'] ?? "";
$coverI= $data['docs'][0]['cover_i'] ?? "";
$editionCount= $data['docs'][0]['edition_count'] ?? "";

//iteriates for multiple values
for($i=0; $i < count($data['docs'][0]['author_key']); $i++) {
    $authorKey[]=$data['docs'][0]['author_key'][$i];
}

for($i=0; $i < count($data['docs'][0]['author_name']); $i++){
    $authorName[]= $data['docs'][0]['author_name'][$i] ;
}

$hasFulltext= $data['docs'][0]['has_fulltext'] ?? "-1";
$publishYear= $data['docs'][0]['first_publish_year'] ?? "-1";

for($i=0; $i < count($data['docs'][0]['language']); $i++){
    $lan[]= $data['docs'][0]['language'][$i];
}

$publicScanB= $data['docs'][0]['public_scan_b'];

//prints all the data pulled from the json file
echo $bookKey."<br>".$title."<br>".$ebookAccess."<br>".$coverEditionKey."<br>".$coverI."<br>".$editionCount."<br>"; 
for($i=0; $i < count($authorKey); $i++){
    echo $authorKey[$i]."<br>";
    echo $authorName[$i]."<br>";
}
var_export($hasFulltext);
echo "<br>".$publishYear."<br>";
for($i=0; $i < count($lan); $i++){
    echo $lan[$i]." ";
}
echo "<br>";
var_export($publicScanB);

//the variables with multiple values as a list are turned into a json data type for database entry 
$authorKeySave=json_encode($authorKey);
$authorNameSave=json_encode($authorName);
$lanSave=json_encode($lan);

//preps query for checking if book is already in the database
$checkqry->bind_param("s", $bookKey); 
$checkqry->execute();

$checkqry->bind_result($bookExists);
$checkqry->fetch();

    if(!$bookExists) { // if a book is not already in the data base it will add to db
        $query = "INSERT INTO openLibrary(bookKey, title, subtitle, ebook_access, cover_edition_key, cover_i, 
        edition_count, author_key, author_name, has_fulltext, publish_year, lan, public_scan_b) VALUES (?, ?, ?,?,?,?,?,?,?,?,?,?,?)";
        $query = $conn->prepare($query);
        if (!$query) {
    die("Prepare failed: " . $conn->error);
}

        $query->bind_param("ssssssissiisi", $bookKey, $title, $subtitle, $ebookAccess, $coverEditionKey, $coverI, $editionCount, 
        $authorKeySave, $authorNameSave, $hasFulltext, $publishYear, $lanSave, $publicScanB);

        $query -> execute();

//attempts to only add book to databse if button is pressed
// if (array_key_exists('button', $_POST)) {
//         // $query -> execute();
//     if (!$query->execute()) {
//         die("Execute failed: " . $query->error);
//     } else {
//         // header("Location: apiPull.php?msg=3");
//         echo "Book saved successfully!";
//     }
// }
    }

}
?>
    <!-- //TODO: figure out how to execute query only when button is pressed -->


    <!-- <form method="post">
        <input type="submit" name="button"
                class="button" value="Save this Book" />
</form> -->

</div>
<?php include("footer.php"); ?>
