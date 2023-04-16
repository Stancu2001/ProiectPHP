<html>
<?php
include "Sidebar.php";
?>
    <head>

    <title>Calendar</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Calendar</h2>
        <div id="tabel">
        <table>
            <tr>
                    <th>ID</th>
                    <th>Nume curs</th>
                    <th>Trainer</th>
                    <th>Perioada</th>
            </tr>
            <form method="POST">
                <?php
                try{
                    $linii=$db->query('SELECT * FROM curs ORDER BY `start_date` ASC');
                    $id=1;
                    while($linie=$linii->fetch(PDO::FETCH_ASSOC)){
                        $nume_curs  =$linie['nume'];
                        $start_date =$linie['start_date'];
                        $stop_date  =$linie['stop_date'];
                        $trainer_id =$linie['trainer_id'];
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
                                '<td>'.$nume_curs.'</td>'.
                                '<td>'.$nume_trainer.'</td>'.
                                '<td>'.date('d/m/Y',$start_date).' - '.date('d/m/Y',$stop_date).'</td>'.
                            '</tr>'
                        );
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