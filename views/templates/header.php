<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'PHP Email Auth'; ?></title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/php-email-auth/index.php">Home</a></li>
                <li><a href="/php-email-auth/index.php?action=login">Login</a></li>
                <li><a href="/php-email-auth/index.php?action=register">Register</a></li>
            </ul>
        </nav>
    </header>
    <main>
