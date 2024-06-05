<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile of <?php echo htmlspecialchars($data['user']['username']); ?></h1>
    <p>User ID: <?php echo htmlspecialchars($data['user']['id']); ?></p>
    <p>Username: <?php echo htmlspecialchars($data['user']['username']); ?></p>
    <p>Created at: <?php echo htmlspecialchars($data['user']['created_at']); ?></p>
</body>
</html>