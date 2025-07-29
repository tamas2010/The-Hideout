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
            background-color: rgba(0,0,0,0.5); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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
        .modal-content h2 {
            margin: 0;
            padding: 0;
            font-size: 24px;
            color: #333;
        }
        .modal-content p {
            font-size: 18px;
            color: #666;
        }
        .modal-content .user-data {
            margin: 20px 0;
        }
        .modal-content .user-data p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <header class="hero">
        <div class="container">
            <h1>Welcome to The Hideout</h1>
            <p>Your perfect A-frame house retreat</p>
            <a href="#checkAvailability" class="btn">Check Availability</a>
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
    <section id="checkAvailability" class="check-availability">
        <div class="container">
            <h2>Check Availability</h2>
            <form id="availabilityForm">
                <label for="checkin">Check-in Date:</label>
                <input type="date" id="checkin" name="checkin" required>
                <label for="checkout">Check-out Date:</label>
                <input type="date" id="checkout" name="checkout" required>
                <button type="button" class="btn" onclick="checkAvailability()">Check Availability</button>
            </form>
            <p id="availabilityMessage"></p>
        </div>
    </section>
    <section id="booking" class="booking">
        <div class="container">
            <h2>Book Your Stay</h2>
            <form id="bookingForm" action="process_booking.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="checkin">Check-in Date:</label>
                <input type="date" id="bookingCheckin" name="checkin" required readonly>
                <label for="checkout">Check-out Date:</label>
                <input type="date" id="bookingCheckout" name="checkout" required readonly>
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
            <div id="modalMessage"></div>
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
                const bookingId = params.get('order_number');
                const name = params.get('name');
                const email = params.get('email');
                const checkin = params.get('checkin');
                const checkout = params.get('checkout');
                const modalMessage = document.getElementById('modalMessage');

                modalMessage.innerHTML = `
                    <h2>${message}</h2>
                    <div class="user-data">
                        <p><strong>Booking Order Number:</strong> ${bookingId}</p>
                        <p><strong>Name:</strong> ${name}</p>
                        <p><strong>Email:</strong> ${email}</p>
                        <p><strong>Check-in Date:</strong> ${checkin}</p>
                        <p><strong>Check-out Date:</strong> ${checkout}</p>
                    </div>
                `;

                document.getElementById('messageModal').style.display = 'block';
            }
        };

        function checkAvailability() {
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            
            if (checkin && checkout) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'check_availability.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        document.getElementById('availabilityMessage').textContent = response.message;
                        if (response.available) {
                            document.getElementById('bookingForm').style.display = 'block';
                            document.getElementById('bookingCheckin').value = checkin;
                            document.getElementById('bookingCheckout').value = checkout;
                        } else {
                            document.getElementById('bookingForm').style.display = 'none';
                        }
                    }
                };
                xhr.send('checkin=' + encodeURIComponent(checkin) + '&checkout=' + encodeURIComponent(checkout));
            } else {
                document.getElementById('availabilityMessage').textContent = 'Please select both check-in and check-out dates.';
            }
        }
    </script>
</body>
</html>
