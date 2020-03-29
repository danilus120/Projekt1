<?php //Przekierowanie na stronę główną, jesli użytkownik nie jest zalogowany header('Location: index.php');
    include('header.php');
    if(isset($_SESSION["login"]) && $_SESSION["zalogowany"] == true){

    } else {
        header('Location: index.php');
    }
?>
<div class="o_container">
<form method="POST" action="ogloszenie.php" enctype="multipart/form-data">
    <b>Marka:</b> <input type="text" name="marka"><br>
    <b>Model:</b> <input type="text" name="model"><br>
    <b>Cena:</b> <input type="number" name="cena"><br>
    <b>Rok produkcji:</b> <input type="number" name="rok"><br>
    <b>Przebieg:</b> <input type="text" name="przebieg"><br>
    <select name="rodzaj">
        <option>Benzyna</option>
        <option>Diesel</option>
        <option>Benzyna+LPG</option>
    </select>
    <b>Zdjęcie:</b> <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input class="button" type="submit" value="dodaj" name="dodaj">
</form>
</div>
<?php

if (isset($_POST['dodaj']))
{
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        } else {
            echo "<p>Wystapił błąd wczytywania pliku</p>";
        }
    }




    $db = mysqli_connect("localhost","root","");
    mysqli_select_db($db, "portal");

    if(isset($_SESSION["login"])){
        $id = $_SESSION["login"];
    }else{
        echo "Aby dodać ogłoszenie, zaloguj się lub zarejestruj!";
        include("footer.php");
        exit;
    }

    $img = $_FILES["fileToUpload"]["name"];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $rok = $_POST['rok'];
    $przebieg = $_POST['przebieg'];
    $rodzaj = $_POST['rodzaj'];

    if($marka and $model and $cena and $rok and $przebieg and $rodzaj){
        $query = "INSERT INTO ogloszenia (id_uzytkownika, marka, model, cena, rok_produkcji, przebieg, rodzaj_paliwa, img) VALUES ('".$id."', '".$marka."', '".$model."', '".$cena."', '".$rok."', '".$przebieg."', '".$rodzaj."', '".$img."')";
        $result = mysqli_query($db, $query);
    
        if($result) {
            echo '<div class="alert">';
            echo "<p>Ogłoszenie zostało dodane</p>";
            echo '</div>';
        }
    }else echo "Wypełnij wszystkie rubryki!";
   
    mysqli_close($db);

}

?>


<?php
    include('footer.php');
?>

