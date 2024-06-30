<?php
session_start();
include("db2.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $image = $_FILES['image']['name'];
    $target_dir = "myfile/"; // Changed target directory to 'myfile'
    $target_file = $target_dir . basename($image);

    // Check for file upload errors
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Prepare the SQL statement
            $stmt = $con2->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssss", $product_name, $description, $price, $target_file);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "<script type='text/javascript'>alert('Product added successfully');</script>";
                    echo "<script type='text/javascript'>window.location.href = 'Shop.php';</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Failed to add product');</script>";
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "<script type='text/javascript'>alert('Failed to prepare statement');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Failed to upload image');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Image upload error');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Owner Page</title>
    <style>
        body {
            display: block;
            padding: 0 10vw;
        }

        input, textarea {
            font-weight: 500;
        }

        input:not(input[type="checkbox"]) {
            width: 100%;
        }

        textarea {
            width: 100%;
            height: 270px;
            resize: none;
            padding: 10px 20px;
        }

        .product-info {
            width: 100%;
            height: 500px;
            display: grid;
            grid-template-columns: .75fr 1.25fr;
            grid-template-rows: repeat(2, 1fr);
            grid-gap: 20px;
            margin-bottom: 20px;
        }

        .product-image {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            background-size: cover;
            border-radius: 10px;
            grid-row: span 2;
            text-shadow: 0 0 10px #fff;
        }

        .text {
            text-transform: capitalize;
            color: #383838;
            font-size: 20px;
            font-weight: 500;
        }

        .upload-image-sec, .select-sizes {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        .text img {
            height: 20px;
            margin-right: 10px;
        }

        .upload-catalouge {
            width: 100%;
            margin: 20px 0;
            display: grid;
            grid-template-columns: repeat(4, 100px);
            grid-gap: 10px;
        }

        .upload-image {
            width: 100%;
            height: 100px;
            background: #f5f5f5;
            cursor: pointer;
            background-size: cover;
        }

        .upload-image:hover {
            background: rgba(0, 0, 0, 0.2);
            background-size: cover;
        }

        .sizes {
            margin-top: 30px;
        }

        .size-checkbox {
            -webkit-appearance: none;
            width: 100px;
            height: 40px;
            border-radius: 5px;
            border: 1px solid #383838;
            cursor: pointer;
            margin-bottom: 10px;
            margin-right: 10px;
            position: relative;
            color: #383838;
        }

        .size-checkbox::after {
            content: attr(value);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 16px;
            text-transform: uppercase;
        }

        .size-checkbox:checked {
            background: #383838;
            color: #fff;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .product-price {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .product-price input {
            margin: 0;
        }

        .buttons {
            margin: 20px 0 50px;
        }

        .btn {
            padding: 10px 30px;
            text-transform: capitalize;
            color: #fff;
            background: #383838;
            border-radius: 5px;
            border: none;
            outline: none;
            margin-right: 10px;
            cursor: pointer;
        }

        #save-btn {
            background: #a9a9a9;
        }
    </style>
</head>
<body>
    <h1>Business Owner Dashboard</h1>
    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="product name" required>
            <input type="text" name="description" placeholder="short line about the product" required>
            <textarea name="description" placeholder="detail description" required></textarea>
            <div class="product-info">
                <div class="product-image"><p class="text">product image</p></div>
                <div class="upload-image-sec">
                    <p class="text"><img src="img/camera.png" alt="">upload image</p>
                    <div class="upload-catalouge">
                        <input type="file" name="image" class="fileupload" id="first-file-upload-btn" required>
                        <label for="first-file-upload-btn" class="upload-image"></label>
                    </div>
                </div>
                <div class="select-sizes">
                    <p class="text">size available</p>
                    <div class="sizes">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" id="xs" value="xs">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" id="s" value="s">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" id="m" value="m">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" id="l" value="l">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" id="xl" value="xl">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" id="xxl" value="xxl">
                        <input type="checkbox" name="sizes[]" class="size-checkbox" id="xxxl" value="xxxl">
                    </div>
                </div>
            </div>
            <div class="product-price">
                <input type="number" name="price" id="actual-price" placeholder="actual price" required>
                <input type="number" name="discount" id="discount" placeholder="discount percentage">
                <input type="number" name="sell_price" id="sell-price" placeholder="selling price">
            </div>
            <input type="number" name="stock" min="20" id="stock" placeholder="item in stocks (minimum 20)">
            <textarea name="tags" id="tags" placeholder="Enter categories here, for example - Men, Jeans, Blue Jeans, Rough jeans (you should add men or women at start)"></textarea>
            <input type="checkbox" name="tac" class="checkbox" id="tac" checked>
            <label for="tac">clothing take 30% from your total sell</label>
            <div class="buttons">
                <button type="submit" class="btn" id="add-btn">add product</button>
                <button type="button" class="btn" id="save-btn">save draft</button>
            </div>
        </form>
    </div>
</body>
</html>

