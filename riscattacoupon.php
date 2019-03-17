<?php
try {
    session_start();
    $configs = include('include/config.php');
    //conn contains the connection object
    $conn = new PDO("mysql:host=$configs->servername;dbname=$configs->dbname", $configs->username, $configs->password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST["couponid"])) {
        $stmt = $conn->prepare("SELECT * FROM Coupon WHERE Id=:coupon");
        $stmt->bindParam(':coupon', $_POST["couponid"]);
        $stmt->execute();
        $ris = $stmt->fetchAll(PDO::FETCH_BOTH);
        if(empty($ris)) {
            //il coupon con quell'id non esiste
            header("Location: lost.php");
        }
        else
        {
            //il coupon esiste devo controllare che non sia stato già riscattato
            $stmt2 = $conn->prepare("SELECT * FROM Riscatto WHERE Coupon=:coupon AND Utente=:username");
            $stmt2->bindParam(':coupon', $_POST["couponid"]);
            $stmt2->bindParam(':username',$_SESSION['username']);
            $stmt2->execute();
            $ris2 = $stmt2->fetchAll(PDO::FETCH_BOTH);
            if(!empty($ris2)) {
                //il coupon è già stato riscattato
                header("Location: lost.php");
            }
            else{
                //il coupon non è ancora stato riscattato controllo che la reputazione sia sufficente al riscatto, per non esserlo deve essere stato cambiato l'html da tool inspect
                $stmt3 = $conn->prepare("SELECT Reputazione, Soglia FROM Utente JOIN Coupon WHERE Coupon.Id=:coupon AND Username=:username");
                $stmt3->bindParam(':coupon', $_POST["couponid"]);
                $stmt3->bindParam(':username',$_SESSION['username']);
                $stmt3->execute();
                $ris3= $stmt3->fetchAll(PDO::FETCH_BOTH);
                if($ris3[0]["Reputazione"]>=$ris3[0]["Soglia"])
                {
                    //la reputazione è sufficiente riscatto il coupon
                    $query= $conn->prepare("INSERT INTO Riscatto (Coupon, Utente, Codice) VALUES (:coupon, :username, :codice)");
                    //generating the redeem code
                    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $i=0;
                    $code='';
                    while ($i < 3) {
                        $tmp = substr(str_shuffle($chars), 0, 4);
                        $code = $code.$tmp."-";
                        $i++;
                    }
                    $tmp = substr(str_shuffle($chars), 0, 4);
                    $code = $code.$tmp;
                    $query->bindParam(':username',$_SESSION['username']);
                    $query->bindParam(':coupon', $_POST["couponid"]);
                    $query->bindParam(':codice', $code);
                    $query->execute();
                    header("Location: miei_coupon.php");
                }
                else {
                    //non c'è abbastanza reputazione
                    header("Location: lost.php");
                }

            }
        }
    }
    else {
        header("Location: lost.php");
    }

}
catch(PDOException $e)
{
    header("Location: lost.php");
}
