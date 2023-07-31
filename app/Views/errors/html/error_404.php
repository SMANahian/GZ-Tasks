<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error</title>
    <style>
        body {
            padding: 10px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <?php if(session()->get('isLoggedIn')): ?>
                <li><a href="/profile/<?=esc(session()->get('id'))?>/view">Profile</a></li>
                <li><a href="/auth/logout">Logout</a></li>
            <?php else: ?>
                <li><a href="/auth/signup">Sing up</a></li>
                <li><a href="/auth/login">Log in</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div align='center'>
        <h2>404 Error: Page not found</h2>
    </div>
</body>
</html>