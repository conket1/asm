<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $products = [
        [
            'id' => 1,
            'name' => 'Product 1',
            'price' => 19.99,
            'description' => 'This is product 1',
            'image' => 'product1.jpg',
            'category' => 'Category A',
        ],
        [
            'id' => 2,
            'name' => 'Product 2',
            'price' => 29.99,
            'description' => 'This is product 2',
            'image' => 'product2.jpg',
            'category' => 'Category B',
        ],
        [
            'id' => 3,
            'name' => 'Product 3',
            'price' => 39.99,
            'description' => 'This is product 3',
            'image' => 'product3.jpg',
            'category' => 'Category A',
        ],
    ];

    // Thêm sản phẩm mới
    function addProduct(&$products, $newProduct)
    {
        $products[] = $newProduct;
    }

    // Xóa sản phẩm
    function deleteProduct(&$products, $productId)
    {
        foreach ($products as $key => $product) {
            if ($product['id'] == $productId) {
                unset($products[$key]);
                return true;
            }
        }
        return false;
    }

    // Sửa thông tin sản phẩm
    function updateProduct(&$products, $productId, $newProductData)
    {
        foreach ($products as $key => $product) {
            if ($product['id'] == $productId) {
                $products[$key] = array_merge($product, $newProductData);
                return true;
            }
        }
        return false;
    }

    // Tìm kiếm sản phẩm theo tên
    function searchProductByName($products, $name)
    {
        $result = [];
        foreach ($products as $product) {
            if (stripos($product['name'], $name) !== false) {
                $result[] = $product;
            }
        }
        return $result;
    }

    // Tìm kiếm sản phẩm theo danh mục
    function searchProductByCategory($products, $category)
    {
        $result = [];
        foreach ($products as $product) {
            if ($product['category'] == $category) {
                $result[] = $product;
            }
        }
        return $result;
    }

    // Sắp xếp sản phẩm theo giá
    function sortProductsByPrice(&$products, $order = 'asc')
    {
        usort($products, function ($a, $b) use ($order) {
            if ($a['price'] == $b['price']) {
                return 0;
            }
            if ($order == 'asc') {
                return ($a['price'] < $b['price']) ? -1 : 1;
            } else {
                return ($a['price'] > $b['price']) ? -1 : 1;
            }
        });
    }


    // Thêm sản phẩm mới
    $newProduct = [
        'id' => 4,
        'name' => 'Product 4',
        'price' => 49.99,
        'description' => 'This is product 4',
        'image' => 'product4.jpg',
        'category' => 'Category C',
    ];
    addProduct($products, $newProduct);

    // Xóa sản phẩm
    deleteProduct($products, 2);

    // Sửa thông tin sản phẩm
    $updateProductId = 1;
    $newProductData = ['price' => 24.99];
    updateProduct($products, $updateProductId, $newProductData);

    // Tìm kiếm sản phẩm theo tên
    $searchedProductsByName = searchProductByName($products, 'Product 3');

    // Tìm kiếm sản phẩm theo danh mục
    $searchedProductsByCategory = searchProductByCategory($products, 'Category A');

    // Sắp xếp sản phẩm theo giá
    sortProductsByPrice($products, 'asc');

    // Hiển thị danh sách sản phẩm
    echo "<pre>";
    print_r($products);
    echo "</pre>";
    ?>

</body>

</html>