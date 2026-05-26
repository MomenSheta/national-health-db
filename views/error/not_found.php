<!DOCTYPE html>
<html lang="en">

<?php
$title = "Error 404";
include "inc/head.inc.php"
?>

<body>

    <main class="flex h-screen">
        <div class="flex flex-col items-center justify-center gap-2 m-auto w-1/4 h-full">
            <img src="./assets/images/404-Error.svg" class="w-full" alt="">
            <a href="<?= fixed_path("/") ?>" class="btn info w-fit">Back Home</a>
        </div>
    </main>
        
</body>

</html>