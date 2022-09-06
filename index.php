<?php require_once 'process.php'; ?>
<?php $con = new mysqli("localhost","root","","budget"); ?>
<?php  if(isset($_SESSION['message'])): ?>


<?php endif ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

    <div class="header" >
    <h1> GESTION DE BUDGET </h1>
    <br>
    </div>
    <br><br><br>
    <div class="container">
        <div class="container-budget">
            <div id="montant-revenu" class="numberrev">
                <small>SOLDE</small>
                <div class="montant-container">
                    <span id="expense"></span>
                    <p id="symbol-revenu"><?php echo $ecart;?>CFA</p>
                    
                </div>
            </div>
            <div id="montant-disponible" class="numberbls">
                <small>DEPENSE</small>
                <div class="montant-container">
                    <span id="balance"></span>
                    <p id="symbol-solde"> <?php echo $total;?> CFA</p>
                    
                </div>
            </div>
            <div id="montant-depense" class="numberdps">
                <small>REVENU</small>
                <div class="montant-container">
                    <span id="income"></span>
                    <p id="symbol-depense"> <?php echo $total2;?>CFA</p>
                    </div>
                  </div>
                
            </div>
            </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
                <hr><br>
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="budgetTitle">titre</label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" name="titre" class="form-control" id="budgetTitle" placeholder=" Titre" required autocomplete="off"  value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount">montant</label>
                        <input type="text" name="montant" class="form-control" id="amount" placeholder="budget" width="10px" required  value="<?php echo $amount; ?>">
                    </div>
                    <div class="butt" >
                    <?php if($update == true): ?>
                    <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                    <?php else: ?>
                        <button type="submit" name="revenu" class="btn btn-secondary btn-block">Revenu</button>
                    <button type="submit" name="depense" class="btn btn-primary btn-block">Depense</button>
                    <?php endif; ?>
                    
                    </div>
                </form>
            </div>
            </div>
            
            <div class="col-md-8">
                <hr>
                <br><br>

                <?php 

                    if(isset($_SESSION['massage'])){
                        echo    "<div class='alert alert-{$_SESSION['msg_type']} alert-dismissible fade show ' role='alert'>
                                    <strong> {$_SESSION['massage']} </storng>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                ";
                    }

                ?>
                <h2>historique des depenses</h2>

                <?php 
                    
                    $result = mysqli_query($con, "SELECT * FROM depense");
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>titre</th>
                                <th>montant</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['titre']; ?></td>
                                <td>  <?php echo $row['montant']; ?></td>
                                <td>
                                    
                                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-success">edit</a>
                                    <a href="process.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                            

                        <?php endwhile ?>
                    </table>
                    <br>

                    <h3>historique des revenus</h3>

                <?php 
                    
                    $result = mysqli_query($con, "SELECT * FROM revenus");
                ?>
                <div class="row justify-content-center">
                    <div class="rev" >
                <table class="table">
                        <thead>
                            <tr>
                                <th>titre</th>
                                <th>montant</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        </div>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['titre']; ?></td>
                                <td>  <?php echo $row['montant']; ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-success">edit</a>
                                    <a href="process.php?delete=<?php echo $row['id']; ?>"  class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                            

                        <?php endwhile ?>
                    </table>
                    
                    <br>
                    
                    
                    
                    
                </div>
            </div>
        </div>
   

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
</body>
</html>