<?php if (!isset($patients) || !$patients) return; ?>

<ul>
    <?php
    foreach ($patients as  $patient) {
        echo "<li> (" . $patient["id"] . ") patient: " . $patient['name'] . ", " . $patient['email'] . ", " . $patient["phone"] . "</li>";
    }
    ?>
</ul>