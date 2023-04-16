<html>
<?php
include "Sidebar.php";

if(!isset($_SESSION['user'])){
    header('Location: Home.php');
    return;
}
?>
    <head>

    <title>Inscrieri</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Participanti inscrisi</h2>
        <div id="tabel">
        <table>
            <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Telefon</th>
                    <th>E-mail</th>
                    <th>Cursuri</th>
            </tr>
            <form method="POST">
                <?php
                try{
                    $linii=$db->query('SELECT * FROM inscrieri');
                    $id=1;
                    while($linie=$linii->fetch(PDO::FETCH_ASSOC)){
                        $nume = $linie['nume'];
                        $telefon=$linie['telefon'];
                        $email=$linie['email'];
                        $cursuri=$linie['cursuri'];
                        $curs = explode("|", $cursuri);
                        $nume_cursuri = '';
                        foreach($curs as $curs1){
                            try{
                                $q=$db->query('SELECT nume FROM curs WHERE `id` = ?', array($curs1));
                                while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                                    $nume_cursuri = $nume_cursuri.$q1['nume'].'<br>';
                                }
                            } catch(throwable $eroare){
                                print($eroare);
                            }
                        }

                        print(
                            '<tr>'.
                                '<td>'.$id++.'</td>'.
                                '<td>'.$nume.'</td>'.
                                '<td>'.$telefon.'</td>'.
                                '<td>'.$email.'</td>'.
                                '<td>'.$nume_cursuri.'</td>'.
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