<h2>Add New User</h2>

<form action="#" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <br />

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <br />

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <br />

    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="admin">Admin</option>
        <option value="doctor">Doctor</option>
        <option value="patient">Patient</option>
    </select>

    <br />

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone">

    <br />

    <button type="submit">Create User</button>
</form>