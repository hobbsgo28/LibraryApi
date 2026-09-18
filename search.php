
<head>  
    <?php include("fonts.php"); ?>   
    <link rel="stylesheet" href="style.css"> 
</head>
<?php     include("header.php"); ?>
<div class="container-main">
    <title>Library Search</title>


    <form action="apiPull.php" method="POST"> 
    Keyword: <input type="text" name="keyword" id="keyword" > <br>
    Publish Year: <input type="int" name="year" id="year" > <br>
    <!-- Email Address: <input type="email" name="emailAddr" placeholder="johnsmith@email.com" id="emailAddr" required > <br> -->
    <!-- Password: <input type="password" name="pass" placeholder="abcABC123!@#" id="pass" -->
    <!-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$" required > <br> -->
    <input type="submit" name="search">


</form>
<!-- 
    <form>
        <input type="text" id="firstName" required>

</form> -->

    </div>
<?php include("footer.php"); ?>
