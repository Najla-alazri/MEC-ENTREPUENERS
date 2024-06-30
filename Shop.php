
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="shop.css">
    <title></title>
</head><?php
session_start();
include("db2.php");

$query = "SELECT * FROM products";
$result = $con2->query($query);

?>
<body>
    <nav class="navbar">
        <div class="nav">
            <a href="HTMLPage1.php"><img src="img/image (2).png" class="brand-logo" alt=""></a>

            <div class="nav-items">
                <div class="search">
                    <input type="text" class="search-box" placeholder="search brand, product">
                    <button class="search-btn">search</button>
                </div>
                <a href="login.php">
        <img src="img/user1.png">
                <a href="cart.php"><img src="img/cart1.png" alt=""></a>
                 
                <a id="logout-link" href="logout.php" style="display: none;">Logout</a>
                  <script>
                    document.querySelector('.search-btn').addEventListener('click', function () {
                        const searchValue = document.querySelector('.search-box').value.toLowerCase().trim();

                        const pageMapping = {
                            'clothes': 'clothes.html',
                            'accessorie': 'accessorie.html',
                            'footwear': 'footwear.html',
                            'computers': 'computers.html',
                            'tablets': 'tablets.html',
                            'smartphones': 'smartphones.html',
                            'fast food': 'fastfood.html',
                            'drinks': 'drinks.html',
                            'sweets': 'sweets.html'
                        };

                        if (pageMapping[searchValue]) {
                            window.location.href = pageMapping[searchValue];
                        } else {
                            alert('No matching page found');
                        }
                    });

                    function setCookie(name, value, days) {
                        const date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        const expires = "expires=" + date.toUTCString();
                        document.cookie = name + "=" + value + ";" + expires + ";path=/";
                    }

                    function getCookie(name) {
                        const cname = name + "=";
                        const decodedCookie = decodeURIComponent(document.cookie);
                        const ca = decodedCookie.split(';');
                        for (let i = 0; i < ca.length; i++) {
                            let c = ca[i];
                            while (c.charAt(0) == ' ') {
                                c = c.substring(1);
                            }
                            if (c.indexOf(cname) == 0) {
                                return c.substring(cname.length, c.length);
                            }
                        }
                        return "";
                    }

                    function checkLogin() {
                        const isLoggedIn = getCookie("loggedIn");
                        return isLoggedIn === "true";
                    }

                    function saveCartItem(category, brand, image, price) {
                        const cartItems = JSON.parse(getCookie('cartItems') || '[]');
                        cartItems.push({ category, brand, image, price });
                        setCookie('cartItems', JSON.stringify(cartItems), 7);
                    }

                    function loadCartItems() {
                        const cartItems = JSON.parse(getCookie('cartItems') || '[]');
                        if (cartItems) {
                            cartItems.forEach(item => {
                                addToCart(item.category, item.brand, item.image, item.price, true);
                            });
                            setCookie('cartItems', '', -1); 
                        }
                    }

                    function addToCart(category, brand, image, price, fromStorage = false) {
                        if (!checkLogin() && !fromStorage) {
                            saveCartItem(category, brand, image, price);
                            alert('Please log in to add items to your cart.');
                            window.location.href = 'login.php';
                            return;
                        }

                        const cart = JSON.parse(getCookie('cart') || '[]');
                        cart.push({ category, brand, image, price });
                        setCookie('cart', JSON.stringify(cart), 7);
                        console.log('Item added to cart:', category, brand, image, price);
                        alert('Item added to cart');
                    }

                    window.addEventListener('load', function() {
                        loadCartItems();
                        if (checkLogin()) {
                            document.getElementById('logout-link').style.display = 'inline';
                        }
                    });
                </script>

        </div>
    </nav>
    <ul class="links-container">

        <li class="link-item"><a href="clothes.html" class="link">clothes</a></li>
        <li class="link-item"><a href="accessorie.html" class="link">accessorie</a></li>
        <li class="link-item"><a href="#" class="link" title="Coming Soon">footwear</a></li>
        <li class="link-item"><a href="#" class="link" title="Coming Soon">computers</a></li>
        <li class="link-item"><a href="#" class="link" title="Coming Soon">tablets</a></li>
        <li class="link-item"><a href="#" class="link" title="Coming Soon">smartphones</a></li>
        <li class="link-item"><a href="#" class="link" title="Coming Soon">Fast food</a></li>
        <li class="link-item"><a href="#" class="link" title="Coming Soon">Drinks</a></li>
        <li class="link-item"><a href="#" class="link" title="Coming Soon">Sweets</a></li>


    </ul>

    <div class="slider-wrapper">
        <div class="slider">
            <div class="slide" id="slide-1">
                <img src="img/Fashion & Apparel.jpeg" alt="Fashion and apparel">
                <p class="caption">Explore the latest fashion trends</p>
            </div>
            <div class="slide" id="slide-2">
                <img src="img/food.jpg" alt="Delicious food">
                <p class="caption">Enjoy a variety of delicious dishes</p>
            </div>

            <div class="slide" id="slide-3">
                <img src="img/Electronics & Gadgets.jpg" alt="Electronics and gadgets">
                <p class="caption">Discover cutting-edge electronics</p>
            </div>
            <div class="slider-nav">
                <a href="#slide-1"></a>
                <a href="#slide-2"></a>
                <a href="#slide-3"></a>
            </div>
        </div>
    </div>
    <section class="product">

        <h2 class="product-category">Unexpected deals</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
        <div class="product-container">
            <div class="product-card">
                <div class="product-image">

                    <span class="discount-tag">52% off</span>
                    <a href="productdetail.html" class="product-link">
                        <img src="img/b.jpeg" class="product-thumb" alt="">
                    </a>
                    <button class="card-btn" onclick="addToCart('Unexpected deals', 'brand', 'img/b.jpeg', 5.04)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 5.04</span><span class="actual-price">OM 10.50</span>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">

                    <span class="discount-tag">25% off</span>

                    <img src="img/a.jpg" class="product-thumb" alt="">

                    <button class="card-btn" onclick="addToCart('Unexpected deals', 'brand', 'img/a.jpg', 29.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 29.00</span><span class="actual-price">OM 39.00</span>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">34% off</span>
                    <img src="img/s.jpeg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Unexpected deals', 'brand', 'img/s.jpeg', 11.50)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 11.50</span><span class="actual-price">OM 7.60</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">30% off</span>
                    <img src="img/f.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Unexpected deals', 'brand', 'img/f.jpg', 3.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 3.00</span><span class="actual-price">OM 2.10</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">20% off</span>
                    <img src="img/j.jpeg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Unexpected deals', 'brand', 'img/j.jpeg', 6.80)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 6.80</span><span class="actual-price">OM 8.50</span>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">20% off</span>
                    <img src="img/ss.jpeg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Unexpected deals', 'brand', 'img/ss.jpeg', 6.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 6.00</span><span class="actual-price">OM 7.50</span>
                </div>
            </div>



        </div>
    </section>

    <section class="product">
        <h2 class="product-category">Abbaya</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
        <div class="product-container">

            <div class="product-card">
                <div class="product-image">

                    <img src="img/1.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Abbya', 'brand', 'img/1.jpg', 29.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 29.00</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">25% off</span>
                    <img src="img/a.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Abbya', 'brand', 'img/a.jpg', 29.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 29.00</span><span class="actual-price">OM 39.00</span>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">

                    <img src="img/2.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Abbya', 'brand', 'img/2.jpg', 28.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 28.00</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">

                    <img src="img/3.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Abbya', 'brand', 'img/3.jpg', 34.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 34.00</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">

                    <img src="img/4.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Abbya', 'brand', 'img/4.jpg', 32.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 32.00</span>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">

                    <img src="img/5.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('Abbya', 'brand', 'img/5.jpg', 38.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 38.00</span>
                </div>
            </div>



        </div>
    </section>
    <section class="product">
        <h2 class="product-category">shoes</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
        <div class="product-container">

            <div class="product-card">
                <div class="product-image">

                    <img src="img/s1.jpeg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('shoes', 'brand', 'img/s1.jpeg', 9.35)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 9.35</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">

                    <img src="img/s2.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('shoes', 'brand', 'img/s2.jpg', 8.50)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 8.50</span>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">

                    <img src="img/s3.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('shoes', 'brand', 'img/s3.jpg', 6.50)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 6.50</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">

                    <img src="img/s4.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('shoes', 'brand', 'img/s4.jpeg', 11.50)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 11.50</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">20% off</span>
                    <img src="img/ss.jpeg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('shoes', 'brand', 'img/ss.jpeg', 6.00)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 6.00</span><span class="actual-price">OM 7.50</span>
                </div>
            </div>


            <div class="product-card">
                <div class="product-image">

                    <img src="img/s5.jpg" class="product-thumb" alt="">
                    <button class="card-btn" onclick="addToCart('shoes', 'brand', 'img/s5.jpg', 9.50)">Add to Cart</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">OM 9.50</span>
                </div>
            </div>



        </div>
    </section>

    <footer>
        <div class="footer-content">
            <p>
                Discover a Wide Range of Products
            </p>

            <div class="footer-ul-container">
                <ul class="category">
                    <li class="category-title">Fashion & Apparel</li>
                    <li><a href="#" class="footer-link">clothes</a></li>
                    <li><a href="#" class="footer-link">accessories</a></li>
                    <li><a href="#" class="footer-link">footwear</a></li>
                </ul>
                <ul class="category">
                    <li class="category-title"> Electronics & Gadgets</li>
                    <li><a href="#" class="footer-link">computers</a></li>
                    <li><a href="#" class="footer-link">tablets</a></li>
                    <li><a href="#" class="footer-link">smartphones</a></li>
                    <li><a href="#" class="footer-link"> other smart devices</a></li>
                </ul>
                <ul class="category">
                    <li class="category-title"> Food</li>
                    <li><a href="#" class="footer-link">Fast food</a></li>
                    <li><a href="#" class="footer-link">Drinks</a></li>
                    <li><a href="#" class="footer-link">Sweets</a></li>
                    <li><a href="#" class="footer-link"> Snacks</a></li>
                </ul>
            </div>
        </div>
        <p class="footer-title">about company</p>
        <p class="info">


            Welcome to MEC entrepreneurs, the premier e-commerce platform tailored exclusively for MEC coolege students and their entrepreneurial ventures. MEC entrepreneurs is a unique online marketplace that consolidates all student-run businesses under one digital roof, providing a streamlined and supportive environment for young entrepreneurs to thrive.
            <br />
            our mission is to empower MEC college students by giving them a dedicated space to showcase their products and services. We aim to simplify the complexities of running a business while in school, allowing students to focus on innovation and growth. Our platform fosters a community of like-minded individuals, facilitating networking, collaboration, and mutual support.

            <br /><br />
            Why Choose MEC entrepreneurs?
            <br />
            - Convenience: With all student businesses aggregated on one platform, customers can easily discover and support student entrepreneurs.<br />
            - Visibility: UniMarket provides a prominent platform for students to gain visibility and reach a wider audience beyond their university.<br />
            - Growth Opportunities: Our platform offers various tools and analytics to help businesses grow and improve their operations.<br />
            - Community Engagement: By joining MEC entrepreneurs, students become part of a vibrant community that encourages collaboration and innovation.<br />
            <br />

            Join MEC entrepreneurs Today!
            <br />
            Whether you're a student entrepreneur looking to start your own business or a supporter eager to discover unique products and services, MEC Entrepreneurs is the place for you. Join us today and be a part of a dynamic community that's shaping the future of student entrepreneurship.


        </p>

        <p class="info">support emails - help@gmail.com, customersupport@gmail.com</p>
        <p class="info">telephone - 180 00 00 001, 180 00 00 002</p>
        <div class="footer-social-container">
            <div>
                <a href="condition.html" class="social-link">terms & services</a>
                <a href="privacy.html" class="social-link">privacy Notice</a>
            </div>
            <div>
                <a href="#" class="social-link">instagram</a>
                <a href="#" class="social-link">facebook</a>
                <a href="#" class="social-link">twitter</a>
            </div>
        </div>
        <p class="footer-credit">© 2024 MEC Entrepreneurs. All rights reserved.</p>


    </footer>

    <script src="js/Script1.js"></script>

    <script src="js/product.js"></script>
  
</body>
</html>