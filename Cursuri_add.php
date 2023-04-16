<html>
<?php
include "Sidebar.php";

if(!isset($_SESSION['user'])) {
    header('Location: home.php');
    return;
}

if(isset($_POST['add'])){
    if(!empty($_POST['nume'])){
        $start = strtotime($_POST['start_date']);
        $stop = strtotime($_POST['stop_date']);
        try{
            $q=$db->query('INSERT INTO `curs` (`nume`, `trainer_id`, `start_date`, `stop_date`) values (?,?,?,?)', array($_POST['nume'], $_POST['trainer'], $start, $stop));
            header('Location: Cursuri.php');
        } catch(throwable $eroare){
            print($eroare);
        }
    }
    
}
?>
    <head>

    <title>Cursuri</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Adauga curs</h2>
        <form method="POST">
            <label>Nume curs</label>
            <input type="text" name="nume">
            <br>
            <br>
            <label>Select Trainer</label>
            <select name="trainer">
            <?php 
                try{
                    $q=$db->query('SELECT * FROM trainers');
                    while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="'.$q1['id'].'">'.$q1['Nume'].'</option>';   
                    }
                } catch(throwable $eroare){
                    print($eroare);
                }
            ?>
            </select>
            <br>
            <br>
            <label>Start date</label>
            <input type="date" name="start_date">
            <br>
            <br>
            <label>Stop date</label>
            <input type="date" name="stop_date">
            <br>
            <br>
            <input type="submit" value="Adauga" name="add">
        </form>
    </div>
</body>
</html>