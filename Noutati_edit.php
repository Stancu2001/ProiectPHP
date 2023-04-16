<html>
<?php
include "Sidebar.php";

if(!isset($_SESSION['user'])) {
    header('Location: home.php');
    return;
}

if(!isset($_GET['id']) && 0 < $_GET['id']){
    header('Location: home.php');
    return;
} else {
    try{
        $q=$db->query('SELECT * FROM news WHERE `id` = ?', array($_GET['id']));
        if(!$q->rowCount()){
            header('Location: Noutati.php');
            return;
        }
        
    } catch(throwable $eroare){
        print($eroare);
    }
}



if(isset($_POST['save'])){
    if(!empty($_POST['titlu'])){
        try{
            $q=$db->query('UPDATE `news` SET `titlu` = ?, `descriere` = ?, `date` = ? WHERE `id` = ? ', array($_POST['titlu'], $_POST['descriere'], time(), $_POST['id']));
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
        <h2>Edit noutati</h2>

        <?php
            try{
                $q=$db->query('SELECT * FROM news WHERE `id` = ?', array($_GET['id']));
                while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                    $id = $q1['id'];
                    $titlu = $q1['titlu'];
                    $descriere = $q1['descriere'];
                }
            } catch(throwable $eroare){
                print($eroare);
            }
        ?>
        <form method="POST">
            <label>Titlu</label>
            <input type="text" name="titlu" value="<?php echo $titlu; ?>">
            <br>
            <br>
            <label>Descriere</label>
            <textarea name="descriere" rows="4" cols="50"><?php echo $descriere; ?></textarea>
            <br>
            <br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Salveaza" name="save">
        </form>
    </div>
</body>
</html>