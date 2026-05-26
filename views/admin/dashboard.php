<?php if (!isset($usersList) || !$usersList) return; ?>

<ul>
    <?php
    foreach ($usersList as $user) {
        echo "<li> (" . $user["id"] . ") user [" . $user["role"] . "]: " . $user['name'] . ", " . $user['email'] . "</li>";
    }
    ?>
</ul>