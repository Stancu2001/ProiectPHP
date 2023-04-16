<html>
<?php
include "Sidebar.php";

if(isset($_SESSION['user']) && isset($_GET['curs_id'])){
    try{
        $q=$db->query('DELETE FROM `curs` WHERE `id` = ?', array($_GET['curs_id']));
        header('Location: Cursuri.php');
    } catch(throwable $eroare){
        print($eroare);
    }
}
?>
    <head>

    <title>Cursuri</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Cursuri <?php if(isset($_SESSION['user'])) { echo '<a href="cursuri_add.php"><button class="green"><i class="bx bx-plus-circle"></i></button></a>';} ?></h2>
        <div id="tabel">
        <table>
            <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Trainer</th>
                    <th>Data inceput</th>
                    <th>Data terminare</th>
                    <?php if(isset($_SESSION['user'])) echo'<th>Optiuni</th>'; ?>
            </tr>
            <form method="POST">
                <?php
                try{
                    $linii=$db->query('SELECT * FROM curs');
                    $id=1;
                    while($linie=$linii->fetch(PDO::FETCH_ASSOC)){
                        $nume=$linie['nume'];
                        $trainer_id=$linie['trainer_id'];
                        $start_date=$linie['start_date'];
                        $stop_date=$linie['stop_date'];
                        $curs_id = $linie['id'];
                        try{
                            $q=$db->query('SELECT Nume FROM trainers WHERE `id` = ?', array($trainer_id));
                            while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                                $nume_trainer = $q1['Nume'];
                            }
                        } catch(throwable $eroare){
                            print($eroare);
                        }
                        print(
                            '<tr>'.
                                '<td>'.$id++.'</td>'.
                                '<td>'.$nume.'</td>'.
                                '<td>'.$nume_trainer.'</td>'.
                                '<td>'.date('d/m/Y',$start_date).'</td>'.
                                '<td>'.date('d/m/Y',$stop_date).'</td>');
                        if(isset($_SESSION['user'])) print('<td>
                                <a href="Cursuri_edit.php?curs_id='.$curs_id.'"><i class="bx bx-edit"></i></a>
                                <a href="Cursuri.php?curs_id='.$curs_id.'"><i class="bx bx-trash"></i></a>
                            </td>');
                        print('</tr>');
                    }
                } catch(throwable $eroare){
                    print($eroare);
                }
                ?>
            </form>
        </table>
        </div>
    </div>
</body>
</html>