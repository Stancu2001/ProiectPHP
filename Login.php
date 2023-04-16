<?php
    include "Sidebar.php";
    
    if(isset($_SESSION['user'])){
        header("Location: Home.php");
    }
?>
    <title>Home</title>
<html>
<body>


    <div class="container">
        <h1>Login</h1>
        <?php
        if(isset($_POST['login'])){
            if(empty($_POST['password']) || empty($_POST['name']))
            echo 'Ai lasat campuri libere';
            else try{
                $q=$db->query("SELECT * FROM `utilizatori` where `nume` = ? AND `parola` = ?", array($_POST['name'], $_POST['password']));
                if($q->rowCount()){
                while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                    $_SESSION['user'] = $q1['id'];
                    header('Location: Home.php');
                }} else {
                    echo 'Nume sau parola sunt gresite';
                }
            } catch(throwable $eroare){
                print($eroare);
            }
        }
        ?>
        <div class="">
            <form method="POST">
                <label>Username</label>
                <input type="text" name="name">
                <br>
                <br>
                <label>Parola</label>
                <input type="password" name="password">
                <br>
                <br>
                <input type="submit" value="Login" name="login">
            </form>
        </div>
        
    </div>
</body>
</html>