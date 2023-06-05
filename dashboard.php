<?php require_once('header.php'); ?>

<!-- Add necessary CSS files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .card-content li {
        font-size: 18px;
        margin-bottom: 10px;
    }
</style>

<?php
// Check if the customer is logged in or not
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // If customer is logged in, but admin made them inactive, then force logout this user.
    $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
    $statement->execute(array($_SESSION['customer']['cust_id'], 0));
    $total = $statement->rowCount();
    if ($total) {
        header('location: ' . BASE_URL . 'logout.php');
        exit;
    }
}
?>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php require_once('customer-sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card animated fadeInLeft">
                <div class="card-body">
                    <h3 class="card-title">Welcome, <?php echo $_SESSION['customer']['cust_name']; ?></h3>
                    <ul class="list-unstyled card-content">
                        <li><i class="fas fa-envelope"></i> Email: <?php echo $_SESSION['customer']['cust_email']; ?></li>
                        <li><i class="fas fa-phone"></i> Phone: <?php echo $_SESSION['customer']['cust_phone']; ?></li>
                        <li><i class="fas fa-map-marker-alt"></i> Address: <?php echo $_SESSION['customer']['cust_address']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card animated fadeInRight">
                <div class="card-body">
                    <h3 class="card-title">Account Information</h3>
                    <ul class="list-unstyled card-content">
                        <li><i class="far fa-calendar"></i> Member Since: <?php echo date('F j, Y', strtotime($_SESSION['customer']['cust_datetime'])); ?></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once('footer.php'); ?>

<!-- Add necessary JavaScript files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>