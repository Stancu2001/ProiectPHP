<html>
<?php
include "Sidebar.php";

if(isset($_SESSION['user']) && isset($_GET['id'])){
    try{
        $q=$db->query('DELETE FROM `news` WHERE `id` = ?', array($_GET['id']));
        header('Location: Noutati.php');
    } catch(throwable $eroare){
        print($eroare);
    }
}
?>
    <head>

    <title>Noutati</title>
    <link rel="stylesheet" href="Home.css">
</head>

<body>
    <div class="container">
        <h2>Noutati <?php if(isset($_SESSION['user'])) { echo '<a href="Noutati_add.php"><button class="green"><i class="bx bx-plus-circle"></i></button></a>';} ?></h2>
        <div id="tabel">
        <table>
            <tr>
                    <th>ID</th>
                    <th>Titlu</th>
                    <th>Descriere</th>
                    <th>Postat pe</th>
                    <?php if(isset($_SESSION['user'])) echo'<th>Optiuni</th>'; ?>
            </tr>
            <form method="POST">
                <?php
                try{
                    $linii=$db->query('SELECT * FROM news');
                    $id=1;
                    while($linie=$linii->fetch(PDO::FETCH_ASSOC)){
                        $new_id = $linie['id'];
                        $titlu=$linie['titlu'];
                        $descriere=$linie['descriere'];
                        $date=$linie['date'];
                        
                        print(
                            '<tr>'.
                                '<td>'.$id++.'</td>'.
                                '<td>'.$titlu.'</td>'.
                                '<td>'.$descriere.'</td>'.
                                '<td>'.date('d/m/Y h:i',$date).'</td>');
                        if(isset($_SESSION['user'])) print('<td>
                                <a href="Noutati_edit.php?id='.$new_id.'"><i class="bx bx-edit"></i></a>
                                <a href="Noutati.php?id='.$new_id.'"><i class="bx bx-trash"></i></a>
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