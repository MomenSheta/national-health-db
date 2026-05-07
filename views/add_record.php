<h2>Create Medical Record</h2>

<form action="#" method="POST">
    <label for="patientId">Patient ID:</label>
    <input type="text" name="patientId" required>

    <br/>
    
    <label for="diagnosis">Diagnosis:</label>
    <textarea name="diagnosis" required></textarea>
    
    <br/>
    
    <label for="notes">Notes:</label>
    <textarea name="notes"></textarea>
    
    <br/>
    
    <label for="visitDate">Visit Date:</label>
    <input type="date" name="visitDate" required>
    
    <br/>

    <button type="submit">Create Record</button>
</form>
