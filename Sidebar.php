<html>
<?php
    date_default_timezone_set('Europe/Bucharest');
    include "db.php";
    session_start();
?>
    <head>
        <link rel="stylesheet" href="Sidebar.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="Home.css">
    </head>
    <body >
        <div class="sidebar">
            <ul >
                <?php if(isset($_SESSION['user'])){
                    echo '<li>
                    <a href="Adminpanel.php">
                        <i class="bx bx-shield"></i>
                        <span >Adminpanel</span>
                    </a>
                </li>';
                }
                ?>
                <li>
                    <a href="Home.php">
                        <i class='bx bx-home-alt-2'></i>
                        <span >Home</span>
                    </a>
                </li>
                <li>
                    <a href="Cursuri.php">
                        <i class='bx bxs-book'></i>
                        <span>Cursuri</span>
                    </a>
                </li>
                
                <?php if(!isset($_SESSION['user'])){
                    echo '<li>
                    <a href="Inscriere.php">
                        <i class="bx bxs-plus-circle"></i>
                        <span class="yellow_simple">Inscriere</span>
                    </a>
                </li>';
                }
                ?>

                <li>
                    <a href="Traineri.php">
                        <i class='bx bx-user-pin'></i>
                        <span >Traineri</span>
                    </a>
                </li>
                <li>
                    <a href="Organizatori.php">
                        <i class='bx bxs-user-pin'></i>
                        <span >Organizatori</span>
                    </a>
                </li>
                <li>
                    <a href="Noutati.php">
                        <i class='bx bx-news'></i>
                        <span >Noutati
                        </span>
                    </a>
                </li>
                <li>
                    <a href="Calendar.php" >
                        <i class='bx bxs-calendar'></i>
                        <span >Calendar
                        </span>
                    </a>
                </li>
                <li>
                    <a href="Contact.php" >
                        <i class='bx bxs-contact'></i>
                        <span >Contact
                        </span>
                    </a>
                </li>
                <li id="login">
                    <?php 
                        if(isset($_SESSION['user'])){
                            try{
                                $q=$db->query("SELECT * FROM `utilizatori` where `id` = ?", array($_SESSION['user']));
                                while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                                    $username = $q1['nume'];
                                }  
                            } catch(throwable $eroare){
                                print($eroare);
                            }
                            echo '
                                <a href="Logout.php">
                                <i class="bx bx-log-in"></i>
                                <span >Log Out
                                </span>
                            </a>';
                        } else 
                            echo '<a href="Login.php">
                            <i class="bx bx-log-in"></i>
                            <span >Log In
                            </span>
                        </a>';
                    ?>
                    
                </li>
            </ul>
        </div>
</body>
</html>
