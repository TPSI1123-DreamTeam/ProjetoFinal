<!-- Email’s body. Customize this view to display the contact form submission data -->

<!DOCTYPE html>
<html>
<head>
    <title>Invitation Form Submission</title>
</head>
<body>
    <p>Title: {{ $details['title'] }}</p>
    <p>Body: {{ $details['body'] }}</p>
    <img src="{{ $message->embed($details['image']) }}">
    <p>Date: {{ $details['date'] }}</p>
    <p>Place: {{ $details['place'] }}</p>
</body>
</html>
