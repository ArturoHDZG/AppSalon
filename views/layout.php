<!DOCTYPE html>
<html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Barbershop App Demo Website">
    <meta name="author" content="Arturo Hernández">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@arturo_hdzg">
    <meta name="twitter:creator" content="@arturo_hdzg">
    <meta name="twitter:title" content="AppSalon">
    <meta name="twitter:description" content="Barbershop App Demo Website">
    <meta name="twitter:image" content="https://Preview.jpg"> <!-- TODO -->
    <meta property="og:title" content="AppSalon">
    <meta property="og:description" content="Barbershop App Demo Website">
    <meta property="og:image" content="https://Preview.jpg"> <!-- TODO -->
    <meta property="og:url" content="https://"> <!-- TODO -->
    <meta property="og:type" content="website">
    <meta name="keywords" content="Barbershop App Demo Website">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="/favicon/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
    <title>AppSalon</title>
  </head>

  <body>

    <div class="container-app">
      <div class="image"></div>
      <div class="app">
        <?php echo $content; ?>
      </div>
    </div>

    <?php echo $script ?? ''; ?>

  </body>

</html>
