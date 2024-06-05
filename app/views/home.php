<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1><?php echo $data['message']; ?></h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <a href="/logout">Logout</a>
</body>
</html>