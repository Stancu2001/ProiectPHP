<html>
<?php
include "Sidebar.php";

if(!isset($_SESSION['user'])) {
    header('Location: home.php');
    return;
}

if(isset($_POST['add'])){
    if(!empty($_POST['titlu'])){
        $date = strtotime($_POST['date']);
        try{
            $q=$db->query('INSERT INTO `news` (`titlu`, `descriere`, `date`) values (?,?,?)', array($_POST['titlu'], $_POST['descriere'], time()));
            header('Location: Noutati.php');
        } catch(throwable $eroare){
            print($eroare);
        }
    }
    
}
?>
    <head>

    <title>Noutati</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Adauga stire</h2>
        <form method="POST">
            <label>Titlu</label>
            <input type="text" name="titlu">
            <br>
            <br>
            <label>Descriere</label>
            <textarea name="descriere" placeholder="Introdu o descriere" rows="4" cols="50"></textarea>
            <br>
            <br>
            <input type="submit" value="Adauga" name="add">
        </form>
    </div>
</body>
</html>