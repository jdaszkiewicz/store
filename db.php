<?php
    $db = new SQLite3('users.db');

    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE,
        password TEXT
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        description TEXT,
        image TEXT,
        price REAL
    )");

    // Insert some default products
    $products = [
        [
            'name' => 'Durian',
            'description' => 'Known for its strong odor, the durian has a creamy, custard-like flesh.',
            'image' => 'https://placehold.co/600x400/png?text=Durian',
            'price' => 10.99
        ],
        [
            'name' => 'Mangosteen',
            'description' => 'The mangosteen is a sweet and tangy fruit with a juicy, white flesh.',
            'image' => 'https://placehold.co/600x400/png?text=Mangosteen',
            'price' => 15.50
        ],
        [
            'name' => 'Rambutan',
            'description' => 'The rambutan is a small, red fruit with a hairy exterior and a sweet, slightly acidic taste.',
             'image' => 'https://placehold.co/600x400/png?text=Rambutan',
             'price' => 8.75
        ],
         [
            'name' => 'Lychee',
            'description' => 'The lychee is a small, round fruit with a rough, red shell and a sweet, floral flavor.',
             'image' => 'https://placehold.co/600x400/png?text=Lychee',
             'price' => 9.20
        ],
        [
            'name' => 'Jackfruit',
            'description' => 'The jackfruit is a large, spiky fruit with a sweet, fruity flavor and a stringy texture.',
             'image' => 'https://placehold.co/600x400/png?text=Jackfruit',
             'price' => 7.00
        ],
         [
            'name' => 'Dragon Fruit',
            'description' => 'The dragon fruit has a vibrant pink skin and a mild, slightly sweet taste with small black seeds.',
             'image' => 'https://placehold.co/600x400/png?text=Dragon+Fruit',
             'price' => 12.30
        ],
    ];

    foreach ($products as $product) {
        $stmt = $db->prepare("INSERT INTO products (name, description, image, price) VALUES (:name, :description, :image, :price)");
        $stmt->bindValue(':name', $product['name'], SQLITE3_TEXT);
        $stmt->bindValue(':description', $product['description'], SQLITE3_TEXT);
        $stmt->bindValue(':image', $product['image'], SQLITE3_TEXT);
        $stmt->bindValue(':price', $product['price'], SQLITE3_FLOAT);
        $stmt->execute();
    }
?>
