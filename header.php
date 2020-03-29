<DOCTYPE! html>
<html lang="pl-PL">
    <head>
        <?php if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } ?>
        <meta charset="UTF-8">
        <title>MotoAd</title>
        <meta name="description" content="Strona poświęcona ogłoszeniom motoryzacyjnym">
        <meta name="keywords" content="Samochód, ogłoszenie, kupno, sprzedaż">
        <meta name="author" content="Tomasz Danilczuk">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/main-style.css">
    </head>
    <body>
        <section class="header">
            <div class="left">
                <a href="index.php"><img src="img/logo.png" alt="Logo - MOTOAD"></a>
            </div>
            <div class="right">
                <?php if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']) {
                    echo '<a href="konto.php"><p>moje konto</p></a>';
                    echo '<p>|</p>';
                    echo '<a href="ogloszenie.php"><p>dodaj ogloszenie</p></a>';
                    echo '<p>|</p>';
                    echo '<a href="wyloguj.php"><p>Wyloguj</p></a>';
                } 
                else {
                    echo '<a href="logowanie.php"><p>logowanie</p></a>';
                    echo '<p>|</p>';
                    echo '<a href="rejestracja.php"><p>rejestracja</p></a>'; 
                }?>

            </div>
        </section>

