<?php

$error = '';
$posted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['name']) && strlen($_POST['name']) > 0) {
        $posted = true;
        $name = htmlentities($_POST['name']);
    } else {
        $error = 'Ohne deinen Namen geht es hier nicht weiter ...';
    }
}

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Symfony from Scratch</title>

    <link rel="stylesheet" href="/css/pure.css">
    <link rel="stylesheet" href="/css/medium-grid.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="layout pure-g">
        <div class="sidebar pure-u-1 pure-u-med-1-4">
            <div class="header">
                <h1>Symfony from Scratch</h1>
            </div>
        </div>
        <div class="content pure-u-1 pure-u-med-3-4">
            <div class="header">
                <h2>Symfony sagt Hallo</h2>
                <hr>
            </div>
            <section>
            <?php if (!$posted): ?>
                <form class="pure-form" method="post">
                    <label for="name">Wer bist du?</label>
                    <input id="name" name="name" type="text" placeholder="Dein Vorname" autofocus>
                    <button type="submit" class="pure-button pure-button-primary">Sag es uns</button>
                </form>
                <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>
            <?php else: ?>
                <div class="welcome">Herzlich Willkommen, <span class="break-on-sm">liebe/r <?= $name ?>!</span></div>
            <?php endif; ?>
            </section>
        </div>
    </div>
</body>
</html>
