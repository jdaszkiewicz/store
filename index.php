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
        $fruits = [
            [
                'name' => 'Durian',
                'description' => 'Known for its strong odor, the durian has a creamy, custard-like flesh.',
                'image' => 'https://placehold.co/600x400/png?text=Durian',
                'price' => '10.99/kg'
            ],
            [
                'name' => 'Mangosteen',
                'description' => 'The mangosteen is a sweet and tangy fruit with a juicy, white flesh.',
                'image' => 'https://placehold.co/600x400/png?text=Mangosteen',
                'price' => '15.50/kg'
            ],
            [
                'name' => 'Rambutan',
                'description' => 'The rambutan is a small, red fruit with a hairy exterior and a sweet, slightly acidic taste.',
                 'image' => 'https://placehold.co/600x400/png?text=Rambutan',
                 'price' => '8.75/kg'
            ],
             [
                'name' => 'Lychee',
                'description' => 'The lychee is a small, round fruit with a rough, red shell and a sweet, floral flavor.',
                 'image' => 'https://placehold.co/600x400/png?text=Lychee',
                 'price' => '9.20/kg'
            ],
            [
                'name' => 'Jackfruit',
                'description' => 'The jackfruit is a large, spiky fruit with a sweet, fruity flavor and a stringy texture.',
                 'image' => 'https://placehold.co/600x400/png?text=Jackfruit',
                 'price' => '7.00/kg'
            ],
             [
                'name' => 'Dragon Fruit',
                'description' => 'The dragon fruit has a vibrant pink skin and a mild, slightly sweet taste with small black seeds.',
                 'image' => 'https://placehold.co/600x400/png?text=Dragon+Fruit',
                 'price' => '12.30/kg'
            ],
        ];

        foreach ($fruits as $fruit):
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $fruit['image']; ?>" class="card-img-top" alt="<?php echo $fruit['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fruit['name']; ?></h5>
                        <p class="card-text"><?php echo $fruit['description']; ?></p>
                        <p class="card-text">Price: <?php 
                        $priceParts = explode('/', $fruit['price']);
                        $price = number_format((float)$priceParts[0], 2, '.', '');
                        $unit = isset($priceParts[1]) ? '/'.$priceParts[1] : '';
                        echo $price . ' PLN ' . $unit;
                        ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
    require_once 'templates/footer.php';
?>
