<?php
    require_once 'templates/header.php';
?>

<div class="container">
    <div class="row">
        <div class="mt-5 col-md-12 text-center">
            <h2>Our Products</h2>
        </div>
    </div>
    <div class="row mt-4">
        <?php
        require_once 'db.php';
        require_once 'controller.php';
        $products = getProducts($db);
        foreach ($products as $row):
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <p class="card-text">Price: <?php echo number_format((float)$row['price'], 2, '.', '') . ' PLN/kg'; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
    require_once 'templates/footer.php';
?>
