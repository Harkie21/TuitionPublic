<div class="container d-flex justify-content-center align-items-center"
     style="min-height: 80vh">
    <div class="p-3">
        <!-- Displays a welcome message with name or user -->
        <h1 class="display-4 fs-1">Welcome <?= $_SESSION['name']?> 🃋</h1>
    </div>
</div>
<div class="container d-flex justify-content-center align-items-center"
     style="min-height: 50vh">
<div class="card" style="width: 18rem;">
    <div class="card-body text-center">
        <h5 class="card-title">
            <!-- For quick logout -->
            <?= $_SESSION[('name')]
            ." <i><sup style='font-size: 60%; text-transform: lowercase'>"
            .$_SESSION[('role')]."</sup></i>" ?>
        </h5>
        <a href="logout.php" class="btn btn-dark">Logout</a>
    </div>
</div>
</div>
<?php include_once 'footer.php';?>
