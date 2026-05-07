<?php if (!isset($record) || !$record) return; ?>


<h1>record details</h1>

<p>patient Name: <?php echo $record["patient_id"] ?></p>
<p>Patient ID : <?php echo $record["patient_id"] ?></p>
<p>Visit Date: <?php echo $record["visit_date"] ?></p>
<p>Diagnosis : <?php echo $record["diagnosis"] ?></p>
<p>notes : <?php echo $record["notes"] ?></p>
<p>doctor : <?php echo $record["doctor_id"] ?></p>

<h2>prescriptions</h2>

<?php
if (isset($prescriptions) && $prescriptions) {
    foreach ($prescriptions as $prescription) {
?>
        <td>
            <tr><?php echo $prescription["medication_name"]; ?></tr>
            <tr><?php echo $prescription["dosage"]; ?></tr>
            <tr><?php echo $prescription["instructions"]; ?></tr>
            <tr><?php echo $prescription["prescribed_at"]; ?></tr>
        </td>
<?php
    }
} else {
    echo "no prescriptions yet...";
}
?>


<?php
if ($_SESSION["role"] == "doctor") {
?>

    <form action="./delete" method="post">
        <button type="submit">delete</button>
    </form>

<?php
}
?>