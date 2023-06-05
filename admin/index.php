<?php require_once('header.php'); ?>

<section class="content-header">
    <h1>Dashboard</h1>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_top_category");
$statement->execute();
$total_top_category = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_mid_category");
$statement->execute();
$total_mid_category = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_end_category");
$statement->execute();
$total_end_category = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_product");
$statement->execute();
$total_product = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status=?");
$statement->execute(array('Completed'));
$total_order_completed = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE shipping_status=?");
$statement->execute(array('Completed'));
$total_shipping_completed = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status=?");
$statement->execute(array('Pending'));
$total_order_pending = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status=? AND shipping_status=?");
$statement->execute(array('Completed', 'Pending'));
$total_order_complete_shipping_pending = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_status=?");
$statement->execute(array('1'));
$total_cust_active = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_status=?");
$statement->execute(array('0'));
$total_cust_inactive = $statement->rowCount();
?>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-top-category">
                <div class="card-body">
                    <h4 class="card-title">Top Categories</h4>
                    <h2 class="card-value" id="top-category-value"><?php echo $total_top_category; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-mid-category">
                <div class="card-body">
                    <h4 class="card-title">Mid Categories</h4>
                    <h2 class="card-value" id="mid-category-value"><?php echo $total_mid_category; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-end-category">
                <div class="card-body">
                    <h4 class="card-title">End Categories</h4>
                    <h2 class="card-value" id="end-category-value"><?php echo $total_end_category; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-product">
                <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <h2 class="card-value" id="product-value"><?php echo $total_product; ?></h2>
                </div>
            </div>
        </div>
    </div>
<br><br>
    <div class="row">
        <div class="col-md-3">
            
                <div class="card-body">
                    <h4 class="card-title">Order Chart</h4>
                    <canvas id="order-chart"></canvas>
                </div>
            
        </div>
        <div class="col-md-3">
            
                <div class="card-body">
                    <h4 class="card-title">Shipping Chart</h4>
                    <canvas id="shipping-chart"></canvas>
                </div>
            
        </div>
		<div class="col-md-3">
            
                <div class="card-body">
                    <h4 class="card-title">Customer Chart</h4>
                    <canvas id="customer-chart"></canvas>
                </div>
            
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>

<style>
    .card {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.02);
    }

    .card .card-body {
        padding: 20px;
    }

    .card .card-title {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .card .card-value {
        font-size: 36px;
        font-weight: bold;
        color: #333;
    }

    .card-top-category {
        background-color: #FF6384;
    }

    .card-mid-category {
        background-color: #36A2EB;
    }

    .card-end-category {
        background-color: #FFCE56;
    }

    .card-product {
        background-color: #4BC0C0;
    }

    .card-order {
        background-color: #36a2eb;
    }

    .card-shipping {
        background-color: #4bc0c0;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Update card values
    document.getElementById('top-category-value').textContent = <?php echo $total_top_category; ?>;
    document.getElementById('mid-category-value').textContent = <?php echo $total_mid_category; ?>;
    document.getElementById('end-category-value').textContent = <?php echo $total_end_category; ?>;
    document.getElementById('product-value').textContent = <?php echo $total_product; ?>;

    // Order Chart
    var orderData = {
        labels: ['Completed', 'Pending'],
        datasets: [{
            data: [<?php echo $total_order_completed; ?>, <?php echo $total_order_pending; ?>],
            backgroundColor: ['#36a2eb', '#ff6384']
        }]
    };

    var orderChartOptions = {
        responsive: true,
        legend: {
            display: false
        }
    };

    var orderChart = new Chart(document.getElementById('order-chart'), {
        type: 'doughnut',
        data: orderData,
        options: orderChartOptions
    });

    // Shipping Chart
    var shippingData = {
        labels: ['Completed', 'Pending'],
        datasets: [{
            data: [<?php echo $total_shipping_completed; ?>, <?php echo $total_order_complete_shipping_pending; ?>],
            backgroundColor: ['#4bc0c0', '#ffcd56']
        }]
    };

    var shippingChartOptions = {
        responsive: true,
        legend: {
            display: false
        }
    };

    var shippingChart = new Chart(document.getElementById('shipping-chart'), {
        type: 'doughnut',
        data: shippingData,
        options: shippingChartOptions
    });

	// Customer Active Or Inactive
    var customerData = {
        labels: ['Active', 'Inactive'],
        datasets: [{
            data: [<?php echo $total_cust_active; ?>, <?php echo $total_cust_inactive; ?>],
            backgroundColor: ['#4bc0c0', '#ffcd56']
        }]
    };

    var customerChartOptions = {
        responsive: true,
        legend: {
            display: false
        }
    };

    var customerChart = new Chart(document.getElementById('customer-chart'), {
        type: 'doughnut',
        data: customerData,
        options: customerChartOptions
    });

</script>
