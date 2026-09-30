<html>
    <head> 
        <?php include("fonts.php"); ?>   
        <link rel="stylesheet" href="style.css"> 
</head>

    <?php 
    // session_start();
    include("header.php");
    include("globals.php");
    ?>
<body>
    <div class="container-main">


<?php
//function to run the sql so that every if statement doesn't have the same 5 lines
    function runSQL($sql){
        include("conn.php");
        $sql = $conn->prepare($sql);
        $sql->execute();
        $sql->store_result();
        $sql->bind_result($result);
        $sql->fetch();
        return $result;
    }

if (isset($_GET['id'])){
    $book_id = $_GET["id"];
    echo $book_id."<br>";
    
}
else{
    echo "error";
}

    // echo $book_id; 

if (isset($_GET['title'])){
    $show_title = $_GET['title'];
    $sql ="select title from openlibrary where id='$book_id'";
    $title = runSQL($sql);
    echo $title."<br>";
}

if (isset($_GET['ebook'])){
    $show_ebook = $_GET['ebook'];
    $sql ="select ebook_access from openlibrary where id='$book_id'";
    $ebook = runSQL($sql);
    echo $ebook."<br>";
}

if (isset($_GET['author'])){
    $show_author = $_GET['author'];
    $sql ="select author_name from openlibrary where id='$book_id'";
    $author =runSQL($sql);
    echo str_replace(array('"'), ' ', str_replace(array('[',']'), '', $author))."<br>";
}

if (isset($_GET['year'])){
    $show_year = $_GET['year'];
    $sql ="select publish_year from openlibrary where id='$book_id'";
    $year = runSQL($sql);
    echo $year."<br>";
}

if (isset($_GET['languages'])){
    $show_languages = $_GET['languages'];
    $sql ="select lan from openlibrary where id='$book_id'";
    $languages= runSQL($sql);
    echo str_replace(array('"'), ' ', str_replace(array('[',']'), '', $languages));
}




?>

    <a class="button" href="createjson.php?id=<?=$book_id ?>">Create JSON File</a>
<!-- 
    <form action="createjson.php">
        Book ID: <input type="int" name="id" value=<?php $book_id?> required >
        Title: <input type="checkbox" name='title' value="title"> 
        EBookAccess: <input type="checkbox" name='ebook' value="Ebook"> 
        Author(s): <input type="checkbox" name='author' value="author"> 
        Publish Year: <input type="checkbox" name='year' value="year"> 
        Languages: <input type="checkbox" name='languages' value="languages"> 
    <input type="Submit" value="Create JSON File" name="json">

</form> -->