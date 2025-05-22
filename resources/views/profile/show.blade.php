<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
        }
        .card {
            max-width: 500px;
            margin: auto;
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 2px 2px 12px #aaa;
        }
        img {
            width: 200px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ $data['photo'] }}" alt="Profile Photo">
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Father's Name:</strong> {{ $data['father'] }}</p>
        <p><strong>Mother's Name:</strong> {{ $data['mother'] }}</p>
        <p><strong>Village:</strong> {{ $data['village'] }}</p>
        <p><strong>Post Office:</strong> {{ $data['post_office'] }}</p>
        <p><strong>Upazila:</strong> {{ $data['upazila'] }}</p>
        <p><strong>Date of Birth:</strong> {{ $data['dob'] }}</p>
        <p><strong>First Blood Donation:</strong> {{ $data['blood_donation_date'] }}</p>
        <p><strong>Blood Group:</strong> {{ $data['blood_group'] }}</p>
        <p><strong>NID:</strong> {{ $data['nid'] }}</p>
        <p><strong>TIN:</strong> {{ $data['tin'] }}</p>
        <p><strong>Phone:</strong> {{ $data['cell'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Designation:</strong> {{ $data['designation'] }}</p>
        <p><strong>Facebook:</strong> <a href="{{ $data['facebook'] }}">{{ $data['facebook'] }}</a></p>
    </div>
</body>
</html>
