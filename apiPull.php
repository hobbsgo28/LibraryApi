
<head>  
    <?php include("fonts.php"); ?>   
    <link rel="stylesheet" href="style.css"> 
</head>
<?php     include("header.php"); ?>
<div class="container-main">
    <title>Library Search</title>

<?php
include("conn.php");

$endpoint_url= "https://openlibrary.org/search.json?q=purple&page=1&limit=1";
// $endpoint_url= "library.json";

$response= file_get_contents($endpoint_url);

$data = json_decode($response, true);

echo "<br>";

$bookKey= $data['docs'][0]['key'] ?? "";
$title = $data['docs'][0]['title'] ?? ""; 
$subtitle= $data['docs'][0]['subtitle'] ?? ""; 
$ebookAccess = $data['docs'][0]['ebook_access'] ?? "";
$coverEditionKey= $data['docs'][0]['cover_edition_key'] ?? "";
$coverI= $data['docs'][0]['cover_i'] ?? "";
$editionCount= $data['docs'][0]['edition_count'] ?? "";

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

//TODO:figure out boolean operations, returning 1 when true but nothing when false
$publicScanB= $data['docs'][0]['public_scan_b'];

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

$authorKeySave=json_encode($authorKey);
$authorNameSave=json_encode($authorName);
$lanSave=json_encode($lan);

// echo $lanSave;

        $query = "INSERT INTO openLibrary(bookKey, title, subtitle, ebook_access, cover_edition_key, cover_i, 
        edition_count, author_key, author_name, has_fulltext, publish_year, lan, public_scan_b) VALUES (?, ?, ?,?,?,?,?,?,?,?,?,?,?)";
        $query = $conn->prepare($query);
        if (!$query) {
    die("Prepare failed: " . $conn->error);
}
// key, title, subtitle, ebook_access, cover_edition_key, cover_i, edition_count, author_key, author_name
//  has_fulltext, publish_year, language, public_scan_b

        $query->bind_param("ssssssissiisi", $bookKey, $title, $subtitle, $ebookAccess, $coverEditionKey, $coverI, $editionCount, 
        $authorKeySave, $authorNameSave, $hasFulltext, $publishYear, $lanSave, $publicScanB);

        // $query -> execute();
if (array_key_exists('button', $_POST)) {
    if (!$query->execute()) {
        die("Execute failed: " . $query->error);
    } else {
        echo "Book saved successfully!";
    }
}

?>
<!-- 
    <form method="post">
        <input type="submit" name="button"
                class="button" value="Save this Book" />
</form> -->

</div>
<?php include("footer.php"); ?>
