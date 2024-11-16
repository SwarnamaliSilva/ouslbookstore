<?php

session_start();

session_unset();

session_destroy();


?>
<script>

alert("You have successfully logged out.");
window.location.href = "cusLogin.php";
</script>
