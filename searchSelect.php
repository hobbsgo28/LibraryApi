<html>
    <head> 
        <?php include("fonts.php"); ?>   
        <link rel="stylesheet" href="style.css"> 
</head>

    <?php 
    // session_start();
    include("header.php");
    ?>
<body>
    <div class="container-main">
    <form action="showSelect.php">
        Book ID: <input type="int" name="id" required >
        Title: <input type="checkbox" name='title' value="title"> 
        EBookAccess: <input type="checkbox" name='ebook' value="Ebook"> 
        Author(s): <input type="checkbox" name='author' value="author"> 
        Publish Year: <input type="checkbox" name='year' value="year"> 
        Languages: <input type="checkbox" name='languages' value="languages"> 
    <input type="submit" name="search">

</form>

</div>
</body>
</html>