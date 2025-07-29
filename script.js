document.getElementById('booking-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting the default way

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;

    // Here, you would typically send this data to a server
    // For demonstration, we'll just log it to the console and show a confirmation message

    console.log('Booking Details:', {
        name: name,
        email: email,
        checkin: checkin,
        checkout: checkout
    });

    // Display a confirmation message
    document.getElementById('confirmation-message').textContent = `Thank you, ${name}. Your booking from ${checkin} to ${checkout} has been received. We'll contact you shortly at ${email}.`;
    document.getElementById('booking-form').reset(); // Clear the form
});
