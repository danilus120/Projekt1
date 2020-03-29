<?php //Przekierowanie na stronę główną, jesli użytkownik nie jest zalogowany header('Location: index.php');
    include('header.php');
    if(isset($_SESSION["login"]) && $_SESSION["zalogowany"] == true){

    } else {
        header('Location: index.php');
    }
?>

<div class="container">
<?php

    $login = $_SESSION['login'];

    $db = mysqli_connect("localhost","root","");
    mysqli_select_db($db, "portal");
   

    $query = "SELECT login, email, rejestracja, a FROM uzytkownicy WHERE login = '$login'";
    $result = mysqli_query($db, $query);
    echo '<div class="account">';
    while ($row = mysqli_fetch_array($result))
    {
            
        echo "<b>Nick:</b>  </br>".$row['login']."</br>";
        echo "<b>Haslo:</b> </br>***"." "."<a href='z_haslo.php'>Zmiana hasła</a></br>";
        echo "<b>Email:</b>  </br>".$row['email']." "."<a href='z_email.php'>Zmiana e-maila</a></br>";
        $timestamp = $row['rejestracja'] + 3600; //+3600 (godzina) przez strefę czasową, czas Unixowy
        echo "<b>Data rejestracji:</b> </br>";
        echo gmdate("d M Y H:i:s", $timestamp);
        echo "</br>";
        if(!empty($row['a'])){
            echo "<b>Uprawnienia:</b> </br>Administrator </br>";
        } else{
            echo "<b>Uprawnienia:</b> </br>Użytkownik </br>";
        } 
    }
    echo '</div>';

    
    
    
    $query2 = "SELECT * FROM ogloszenia WHERE id_uzytkownika = '$login'";
    $result2 = mysqli_query($db, $query2);

    echo '<div class="post">';
    echo "<h1>Twoje ogłoszenia</h1>";
    echo '<div class="single_post">';
    while ($row2 = mysqli_fetch_array($result2))
    {
        echo '<div class="single_post--left">';
        echo '<img style="height:200px; width:300px;" src="img/'.$row2['img'].'">';
        echo "</div>";
        echo '<div class="single_post--right">';
        echo "Id: ".$row2['id_ogloszenia']."</br>";
        echo "Marka: ".$row2['marka']."</br>";
        echo "Model: ".$row2['model']."</br>";
        echo "Cena: ".$row2['cena']."</br>";
        echo "Rok produkcji: ".$row2['rok_produkcji']."</br>";
        echo "Przebieg: ".$row2['przebieg']."</br>";
        echo "Rodzaj paliwa: ".$row2['rodzaj_paliwa']."</br>";
        echo "Użytkownik: ".$row2['id_uzytkownika']."</br>";
        echo "</div></br>";
        echo "</div>";
        echo '<div class="single_post">';
    }
    echo "</div>";
    echo "</div>";
    mysqli_close($db);


?>

<div class="usun">
    <form method="POST" action="konto.php">
        <b>Usuń ogłoszenie (id):</b>
        <select name="id">
            <?php
                $db = mysqli_connect("localhost","root","");
                mysqli_select_db($db, "portal");

                $query = "SELECT id_ogloszenia FROM ogloszenia WHERE id_uzytkownika = '$login'";
                $result = mysqli_query($db, $query);

                while ($row = mysqli_fetch_array($result))
                {
                    echo "<option>".$row['id_ogloszenia']."</option>";
                }
            ?>
        </select>
        </br>
        <input class="button" type="submit" value="Usuń" name="usun">
    </form>
</div>
</div>
<?php

if (isset($_POST['id']))
{   
    $id = $_POST['id'];
    $query3 = "DELETE FROM ogloszenia WHERE id_ogloszenia = '$id';";
    $result3 = mysqli_query($db, $query3);
    header("Refresh:0, url=konto.php");
}
mysqli_close($db);
?>


<?php
include('footer.php');
?>


