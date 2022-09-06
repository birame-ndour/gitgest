<?php
session_start();
// Create connection
$con = new mysqli("localhost","root","","budget");

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
$total = 0;
$total2 = 0;
$ecart = 0 ;
$update = false;
$id=0;
$name = '';
$amount = '';

    if(isset($_POST['revenu'])){
       
        $titre = $_POST['titre'];
        $montant = $_POST['montant'];

        $query = mysqli_query($con, "INSERT INTO revenus (titre, montant) VALUE ('$titre', '$montant')"); 
        
        $_SESSION['massage'] = "revenu ajouté avec succé!";
        $_SESSION['msg_type'] = "primary";

        header("location: index.php?result=true");
        

    }
    if(isset($_POST['depense'])){
       
        $titre = $_POST['titre'];
        $montant = $_POST['montant'];

        $query = mysqli_query($con, "INSERT INTO depense (titre, montant) VALUE ('$titre', '$montant')"); 
        
        $_SESSION['massage'] = "depense ajouté avec succé!";
        $_SESSION['msg_type'] = "primary";          
                                                    
        header("location: index.php?result=true");  



    }
   


    //calculat Total Depense
    $result = mysqli_query($con, "SELECT * FROM depense");
    while($row = $result->fetch_assoc()){
        $total =$total + $row['montant'];
    }
    //calcul total revenu 

    $result = mysqli_query($con, "SELECT * FROM revenus");
    while($row = $result->fetch_assoc()){
        $total2 =$total2 + $row['montant'];
    }
 //calcul ecart
    
 if ($total2 >= $total){
      $ecart= $total2 - $total ;
            
} else {
    $ecart= $total - $total2 ;

}
    
    //delete data

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = mysqli_query($con, "DELETE FROM depense WHERE id=$id");
        $_SESSION['massage'] = "supprimé avec succé !";
        $_SESSION['msg_type'] = "erreur";

        header("location: index.php");

    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = mysqli_query($con, "SELECT * FROM depense WHERE id=$id");

      
        if( mysqli_num_rows($result) == 1){
            $row = $result->fetch_assoc();
            $name = $row['titre'];
            $amount = $row['montant'];
        }
    
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $titre = $_POST['titre'];
        $montant = $_POST['montant'];

        $query = mysqli_query($con, "UPDATE depense SET titre='$titre', montant='$montant' WHERE id='$id'");
        $_SESSION['massage'] = "supprimé avec succé";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
    }




        //delete data

        if(isset($_GET['delete'])){
            $id = $_GET['delete'];
    
            $query = mysqli_query($con, "DELETE FROM revenus WHERE id=$id");
            $_SESSION['massage'] = "supprimé avec succé !";
            $_SESSION['msg_type'] = "erreur";
    
            header("location: index.php");
    
        }
    
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $update = true;
            $result = mysqli_query($con, "SELECT * FROM revenus WHERE id=$id");
    
          
            if( mysqli_num_rows($result) == 1){
                $row = $result->fetch_assoc();
                $name = $row['titre'];
                $amount = $row['montant'];
            }
        
        }
    
        if(isset($_POST['update'])){
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $montant = $_POST['montant'];
    
            $query = mysqli_query($con, "UPDATE revenus SET titre='$titre', montant='$montant' WHERE id='$id'");
            $_SESSION['massage'] = "Revenu modifié avec succé !";
            $_SESSION['msg_type'] = "success";
            header("location: index.php");
        }
    
    

?>

