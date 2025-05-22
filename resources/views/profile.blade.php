<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 20px auto;
        }
        .profile-info {
            text-align: left;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Profile Information</h2>
        
        <img src="{{ $profileData['imageUrl'] }}" class="profile-image" alt="Profile Photo">
        
        <div class="profile-info">
            <p>Name: {{ $profileData['name'] }}</p>
            <p>Father's Name: {{ $profileData['father'] }}</p>
            <!-- Add all other profile fields here -->
        </div>
    </div>
</body>
</html>