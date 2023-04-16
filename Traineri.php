<html>
<?php
include "Sidebar.php";
$error = '';

if(isset($_SESSION['user']) && isset($_GET['id'])){
    try{
        $q=$db->query('SELECT * FROM `curs` WHERE `trainer_id` = ?', array($_GET['id']));
    } catch(throwable $eroare){
        print($eroare);
    }
    if(!$q->rowCount()){
        try{
            $q=$db->query('DELETE FROM `trainers` WHERE `id` = ?', array($_GET['id']));
            header('Location: Traineri.php');
        } catch(throwable $eroare){
            print($eroare);
        }
    } else {
        $error = "Acest trainer este inscris intr-un curs si nu il poti sterge!";
    }
}
?>

<head>
    <title>Traineri</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Traineri <?php if(isset($_SESSION['user'])) { echo '<a href="Traineri_add.php"><button class="green"><i class="bx bx-plus-circle"></i></button></a>';} ?></h2>
        <?php 
            if($error != '')
                echo $error;
        ?>
        <div id="tabel">
        <table>
            <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Email</th>
                    <?php if(isset($_SESSION['user'])) echo'<th>Optiuni</th>'; ?>
            </tr>
            <?php
            try{
                $linii=$db->query('SELECT * FROM trainers');
                $id = 1;
                while($linie=$linii->fetch(PDO::FETCH_ASSOC)){
                    $trainer_id=$linie['id'];
                    $nume=$linie['Nume'];
                    $email=$linie['Email'];
                    print(
                        '<tr>'.
                            '<td>'.$id++.'</td>'.
                            '<td>'.$nume.'</td>'.
                            '<td>'.$email.'</td>');
                    if(isset($_SESSION['user'])) print('<td>
                                <a href="Traineri.php?id='.$trainer_id.'"><i class="bx bx-trash"></i></a>
                            </td>');
                        print('</tr>');
                }
            } catch(throwable $eroare){
                print($eroare);
            }
            ?>
        </table>
        </div>
    </div>
</body>
</html>