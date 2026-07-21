<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>

    <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Phone:</strong> {{ $contactMessage->phone }}</p>
    <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>

    <h3>Message:</h3>
    <p>{{ $contactMessage->message }}</p>

    <p><small>Submitted on: {{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}</small></p>
</body>
</html>
