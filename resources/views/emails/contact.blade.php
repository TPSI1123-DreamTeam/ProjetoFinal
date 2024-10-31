<!-- Email’s body. Customize this view to display the contact form submission data -->

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <p>Name: {{ $details['name'] }}</p>
    <p>Email: {{ $details['email'] }}</p>
    <p>Message: {{ $details['message'] }}</p>
</body>
</html>
