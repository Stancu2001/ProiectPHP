<html>
<?php
include "Sidebar.php";

if(!isset($_SESSION['user'])) {
    header('Location: home.php');
    return;
}

if(!isset($_GET['curs_id']) && 0 < $_GET['curs_id']){
    header('Location: home.php');
    return;
} else {
    try{
        $q=$db->query('SELECT * FROM curs WHERE `id` = ?', array($_GET['curs_id']));
        if(!$q->rowCount()){
            header('Location: Cursuri.php');
            return;
        }
        
    } catch(throwable $eroare){
        print($eroare);
    }
}



if(isset($_POST['save'])){
    if(!empty($_POST['nume'])){
        $start = strtotime($_POST['start_date']);
        $stop = strtotime($_POST['stop_date']);
        try{
            $q=$db->query('UPDATE `curs` SET `nume` = ?, `trainer_id` = ?, `start_date` = ?, `stop_date` = ? WHERE `id` = ? ', array($_POST['nume'], $_POST['trainer'], $start, $stop, $_POST['curs_id']));
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
        <h2>Edit curs</h2>

        <?php
            try{
                $q=$db->query('SELECT * FROM curs WHERE `id` = ?', array($_GET['curs_id']));
                while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                    $id = $q1['id'];
                    $nume = $q1['nume'];
                    $trainer_id = $q1['trainer_id'];
                    $start_date = $q1['start_date'];
                    $stop_date = $q1['stop_date'];
                }
            } catch(throwable $eroare){
                print($eroare);
            }
            try{
                $q=$db->query('SELECT Nume FROM trainers WHERE `id` = ?', array($trainer_id));
                while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                    $nume_trainer = $q1['Nume'];
                }
            } catch(throwable $eroare){
                print($eroare);
            }
        ?>
        <form method="POST">
            <label>Nume curs</label>
            <input type="text" name="nume" value="<?php echo $nume; ?>">
            <br>
            <br>
            <label>Select Trainer</label>
            <select name="trainer">
                <?php
                    echo '<option value="'.$trainer_id.'">'.$nume_trainer.' [selected]</option>';
                    try{
                        $q=$db->query('SELECT * FROM trainers');
                        while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                            if($q1['id'] != $trainer_id)
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
            <input type="date" name="start_date" value="<?php echo date('Y-m-d', $start_date); ?>">
            <br>
            <br>
            <label>Stop date</label>
            <input type="date" name="stop_date" value="<?php echo date('Y-m-d', $stop_date); ?>">
            <br>
            <br>
            <input type="hidden" value="<?php echo $id; ?>" name="curs_id">
            <input type="submit" value="Salveaza" name="save">
        </form>
    </div>
</body>
</html>