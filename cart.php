<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="shop.css">
    <link rel="stylesheet" href="cart.css">
    <title></title>
</head>
<body>

    <nav class="navbar">
        <div class="nav">
            <a href="HTMLPage1.php"><img src="img/image (2).png" class="brand-logo" alt=""></a>

            <div class="nav-items">
                <div class="search">
                    <input type="text" class="search-box" placeholder="search brand, product">
                    <button class="search-btn">search</button>
                </div>
                <a href="login.php"><img src="img/user1.png" alt=""></a>
                <a href="cart.php"><img src="img/cart1.png" alt=""></a>
               
            </div>

        </div>
  </nav>

    <header>
        <h1>Your Cart</h1>
        <a href="Shop.php">Back to Shop</a>
    </header>
    <section class="cart-items" id="cartItems">

        <div class="cart-item" data-price="10.00">

        </div>
    </section>

    <div class="cart-summary">
        <a href="checkout.php" class="checkout-link">
            <button class="checkout-btn">Checkout</button>
        </a>
        <div id="cart"></div>
        <div id="total"></div>
    </div>

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
    <script src="js/cart.js"></script>

</body>
</html>
