<?php
    $db = new SQLite3('users.db');

    $userTableCheckQuery = "SELECT name FROM sqlite_master WHERE type='table' AND name='users'";
    $userTableCheckResult = $db->query($userTableCheckQuery);
    $userTableExists = $userTableCheckResult->fetchArray();

    if (!$userTableExists) {
        $db->exec("CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE,
            password TEXT
        )");
    }

    $productTableCheckQuery = "SELECT name FROM sqlite_master WHERE type='table' AND name='products'";
    $productTableCheckResult = $db->query($productTableCheckQuery);
    $productTableExists = $productTableCheckResult->fetchArray();

    if (!$productTableExists) {
        $db->exec("CREATE TABLE products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            description TEXT,
            image TEXT,
            price REAL,
            premium INTEGER DEFAULT 0
        )");

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
        [
            'name' => 'Buddha\'s Hand',
            'description' => 'A fragrant citrus fruit with finger-like sections.',
            'image' => 'https://placehold.co/600x400/png?text=Buddhas+Hand',
            'price' => 25.00,
            'premium' => 1
        ],
        [
            'name' => 'Yuzu',
            'description' => 'A Japanese citrus fruit with a tart and aromatic flavor.',
            'image' => 'https://placehold.co/600x400/png?text=Yuzu',
            'price' => 30.00,
            'premium' => 1
        ]
        ];

        foreach ($products as $product) {
            $stmt = $db->prepare("INSERT INTO products (name, description, image, price, premium) VALUES (:name, :description, :image, :price, :premium)");
            $stmt->bindValue(':name', $product['name'], SQLITE3_TEXT);
            $stmt->bindValue(':description', $product['description'], SQLITE3_TEXT);
            $stmt->bindValue(':image', $product['image'], SQLITE3_TEXT);
            $stmt->bindValue(':price', $product['price'], SQLITE3_FLOAT);
            $stmt->bindValue(':premium', isset($product['premium']) ? $product['premium'] : 0, SQLITE3_INTEGER);
            $stmt->execute();
        }
    }
?>
