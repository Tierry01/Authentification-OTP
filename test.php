<?php
// Setting a cookie
$nom = "Thoma";
setcookie("test", $nom);

// Verifying whether a cookie is set or not
if(isset($_COOKIE["test"])){
    echo "Hi " . $_COOKIE["test"];
    unset($_COOKIE["test"]);
    echo "Hello " . $_COOKIE["test"];
} else{
    echo "Not set!";
}
?>