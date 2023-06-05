<style>
    .user-sidebar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .card {
        flex: 0 0 calc(16% - 1px);
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card a {
        text-decoration: none;
        color: #333;
        font-size: 14px;
    }

    .card a:hover {
        color: #666;
    }
</style>

<div class="user-sidebar">
    <div class="card">
        <a href="dashboard.php">Dashboard</a>
    </div>
    <div class="card">
        <a href="customer-profile-update.php">Update Profile</a>
    </div>
    <div class="card">
        <a href="customer-billing-shipping-update.php">Shipping Address</a>
    </div>
    <div class="card">
        <a href="customer-password-update.php">Update Password</a>
    </div>
    <div class="card">
        <a href="customer-order.php">Your Orders</a>
    </div>
    <div class="card">
        <a href="logout.php">Logout</a>
    </div>
</div>
