<form method="POST" action="{{ url('login/google/dob') }}">
    @csrf  <!-- CSRF Token -->
    <label for="date_of_birth">Enter your Date of Birth</label>
    <input type="date" name="date_of_birth" id="date_of_birth" required>
    <button type="submit">Submit</button>
</form>
