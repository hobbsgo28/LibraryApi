<?php

include("conn.php");


if (isset($_GET['id'])){
    $book_id = $_GET['id'];
    echo $book_id."<br>";
}
else{
    echo "error";
}

//pulls the relevant data from the db
$dataqry = "SELECT bookKey, title, subtitle, ebook_access, cover_edition_key, cover_i, edition_count, 
            author_key, author_name, has_fulltext, publish_year, lan, public_scan_b FROM openLibrary where ID=$book_id";
echo $dataqry;


$dataqry = $conn->prepare($dataqry);


if (!$dataqry) {
    die("Prepare failed: " . $conn->error);
}
// } else { // no access
//     header("Location: index.php?msg=14");
// }
$dataqry->execute();
$dataqry->store_result();

//binds the relevant data to local variables
$dataqry->bind_result($bookKey, $title, $subtitle, $ebookAccess, $coverEditionKey, $coverI, $editionCount, 
        $authorKey, $authorName, $hasFulltext, $publishYear, $lan, $publicScanB);
$dataqry->fetch();
// echo $bookKey;
//creates a array of the data, creating data pairs with the json values and the 
$data = [
    "book_key" => $bookKey,
    "title" => $title,
    "subtitle" => $subtitle,
    "ebook_access" => $ebookAccess,
    "cover_edition_key" => $coverEditionKey,
    "cover_i" => $coverI,
    "edition_count" => $editionCount,
    "author_key" => $authorKey,
    "author_name" => $authorName,
    "has_fulltext" => $hasFulltext,
    "publish_year" => $publishYear,
    "lan" => $lan,
    "public_scan_b" => $publicScanB
];

// print_r($data);
$jsonData= json_encode($data, JSON_PRETTY_PRINT);

// echo $jsonData;
$filename = str_replace(" ", "_", $title).".json";
// echo $filename;
$filepath = "json_files/".$filename;
echo $filepath;

file_put_contents($filepath, $jsonData, FILE_USE_INCLUDE_PATH);

header("Location: showData.php?msg=4");
?>

