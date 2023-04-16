<html>
<?php
    include "Sidebar.php";

    if(isset($_SESSION['user'])) {
        header('Location: home.php');
        return;
    }

    if(isset($_POST['submit'])){
        $cursuri = '';
        for($i=1; $i<=$_POST['nr_cursuri']; $i++){
            if(isset($_POST['check'.$i])){
                $cursuri = $cursuri.$_POST['hidden'.$i].'|';
            }
        }
        try{
            $q=$db->query('INSERT INTO `inscrieri` (`nume`, `telefon`, `email`, `cursuri`) values (?,?,?,?)', array($_POST['nume'], $_POST['telefon'], $_POST['email'], $cursuri));
        
        } catch(throwable $eroare){
            print($eroare);
        }
        
    }
?>
    <head>

    <title>Cursuri</title>
    <link rel="stylesheet" href="Home.css">
    <script type="text/javascript">
    function limitareLungime(input, length){
        var lungime=length
        if (input.value.length>lungime)
            input.value=input.value.substring(0, lungime)
    }
    function filtreazaNumere(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8){ //daca tasta apasata nu e backspace
            if (unicode<48||unicode>57) //si nu e nici numar
            return false //nu se poate apasa
        }
        return true;
    }
    function esteEmail(strMail){
        var regExpEmail = /^.+\@.+\..+$/ ;// expresia regulata pentru verificare email
        return regExpEmail.test(strMail);
    }
    function esteNumar(strNr){
        var regExpNumber = /^\d+$/; // expresia regulata pentru verificare numar
        return regExpNumber.test(strNr);
    }
    function validezaForma(){
        var frm = document.formaInscriere;
        var valid = true;
        if (frm.nume.value.length <= 0){
            alert ("Numele nu poate fi vid!");
            frm.nume.focus();
            valid = false;
        }
        if (valid && !esteNumar(frm.telefon.value)){
            alert ("Introduceti un telefon valid!");
            frm.telefon.focus();
            valid = false;
        }
        if (valid && !esteEmail(frm.email.value)){
            alert ("Introduceti o adresa de mail valida!");
            frm.email.focus();
            valid = false;
        }
        return valid;
    }
</script>
</head>

<body>
    <div class="container">
        <h2>Formular inscriere</h2>
        <form  method="POST" action="" name="formaInscriere" onsubmit="return validezaForma();">
            Name: <input type="text" name="nume" /> <br/>
            Telefon: <input type="text" name="telefon"
            onkeyup="limitareLungime(this, 10)"
            onkeypress="return filtreazaNumere(event)" /> <br/>
            E-mail: <input type="text" name="email" /><br/><br>
            Lista cursuri: <br />
            
            <?php
                $id = 1;
                try{
                    
                    $q=$db->query('SELECT * FROM curs');
                    while($q1=$q->fetch(PDO::FETCH_ASSOC)){
                        $nume_curs  =$q1['nume'];
                        $id_curs    = $q1['id'];
                        echo $nume_curs.' <input type="checkbox" name="check'.$id.'"><br>';
                        echo '<input type="hidden" name="hidden'.$id++.'" value="'.$id_curs.'">';
                    }
                    
                } catch(throwable $eroare){
                    print($eroare);
                }
                $id--;
            ?>
            <input type="hidden" name="nr_cursuri" value="<?php echo $id ?>">
            <br>
            <input type="submit" name="submit" />
        </form>

    </div>
</body>
</html>