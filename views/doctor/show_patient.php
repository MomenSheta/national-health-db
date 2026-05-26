<?php if (!isset($patient) || !$patient) return; ?>

<h1>Patient profile</h1>

<p>patient Name: <?php echo $patient["name"] ?></p>
<p>Patient Email: <?php echo $patient["email"] ?></p>
<p>Patient phone : <?php echo $patient["phone"] ?></p>
<p>Join Date: <?php echo $patient["created_at"] ?></p>

<h2>Medical Records</h2>
<?php
if (isset($records) && $records) {
    foreach ($records as $record) {
?>
        <td>
            <tr><?php echo $record["id"]; ?></tr>
            <tr><?php echo $record["diagnosis"]; ?></tr>
            <tr><?php echo $record["notes"]; ?></tr>
            <tr><?php echo $record["visit_date"]; ?></tr>
        </td>
<?php
    }
} else {
    echo "no records yet...";
}
?>