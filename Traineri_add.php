<html>
<?php
include "Sidebar.php";

if(!isset($_SESSION['user'])) {
    header('Location: home.php');
    return;
}

if(isset($_POST['add'])){
    if(!empty($_POST['nume'])){
        $date = strtotime($_POST['date']);
        try{
            $q=$db->query('INSERT INTO `trainers` (`NUme`, `Email`) values (?,?)', array($_POST['nume'], $_POST['email']));
            header('Location: Traineri.php');
        } catch(throwable $eroare){
            print($eroare);
        }
    }
    
}
?>
    <head>

    <title>Traineri</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Adauga trainer</h2>
        <form method="POST">
            <label>Nume</label>
            <input type="text" name="nume">
            <br>
            <br>
            <label>Email</label>
            <input type="email" name="email">
            <br>
            <br>
            <input type="submit" value="Adauga" name="add">
        </form>
    </div>
</body>
</html>