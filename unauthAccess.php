<?php

$currentPage = basename($_SERVER["PHP_SELF"]);

 if ($currentPage == "globals.php"){
  header("Location: index.php?msg=14");
}
 if ($currentPage == "header.php"){
  header("Location: index.php?msg=14");
}
 if ($currentPage == "footer.php"){
  header("Location: index.php?msg=14");
}
 if ($currentPage == "connection.php"){
  header("Location: index.php?msg=14");
}
 if ($currentPage == "unauthAccess.php"){
  header("Location: index.php?msg=14");
}
//  if ($currentPage == "style.css"){
//   header("Location: index.php?msg=14");
// }

?>
