<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hideout</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Popup modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="hero">
        <div class="container">
            <h1>Welcome to The Hideout</h1>
            <p>Your perfect A-frame house retreat</p>
            <a href="#booking" class="btn">Book Now</a>
        </div>
    </header>
    <section id="about" class="about">
        <div class="container">
            <h2>About The Hideout</h2>
            <p>The Hideout is a luxurious A-frame house nestled in nature, offering a serene escape from the hustle and bustle of city life. Experience comfort, style, and tranquility in our beautifully designed space.</p>
        </div>
    </section>
    <section id="gallery" class="gallery">
        <div class="container">
            <h2>Gallery</h2>
            <div class="gallery-images">
                <img src="image1.jpg" alt="A-frame house exterior">
                <img src="image2.jpg" alt="Cozy living room">
                <img src="image3.jpg" alt="Modern kitchen">
                <img src="image4.jpg" alt="Bedroom with a view">
            </div>
        </div>
    </section>
    <section id="booking" class="booking">
        <div class="container">
            <h2>Book Your Stay</h2>
            <form action="process_booking.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="checkin">Check-in Date:</label>
                <input type="date" id="checkin" name="checkin" required>
                <label for="checkout">Check-out Date:</label>
                <input type="date" id="checkout" name="checkout" required>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 The Hideout. All rights reserved.</p>
            <p>Contact us: info@thehideout.com | +123 456 7890</p>
        </div>
    </footer>

    <!-- The Modal -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('messageModal').style.display = 'none';
        }

        // Check if there is a message in the URL
        window.onload = function() {
            const params = new URLSearchParams(window.location.search);
            if (params.has('message')) {
                const message = params.get('message');
                document.getElementById('modalMessage').textContent = message;
                document.getElementById('messageModal').style.display = 'block';
            }
        };
    </script>
</body>
</html>
