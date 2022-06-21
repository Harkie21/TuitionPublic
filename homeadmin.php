<div class="container d-flex justify-content-center align-items-center"
     style="min-height: 95vh">
    <div class="p-3">
        <!-- Displays a welcome message along with the name -->
        <h1 class="display-4 fs-1">Welcome <?= $_SESSION['name']?> 🃎</h1>
    </div>
</div>
<div class="card" style="width: 50%; margin: auto; padding-bottom: 10px">
    <div class="card-body text-center">
        <h5 class="card-title">
            <!-- Little card for quick logout -->
            <?= $_SESSION[('name')]
            ." <i><sup style='font-size: 60%; text-transform: lowercase'>"
            .$_SESSION[('role')]."</sup></i>" ?>
        </h5>
        <a href="logout.php" class="btn btn-dark">Logout</a>
    </div>
</div><br><br>
<?php include_once 'footer.php';?>
