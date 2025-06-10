<?php
if (!isset($_GET['book_id'])) {
  header("Location: index.php");
  exit;
}

$book_id = $_GET['book_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Demo Payment</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body {
      background-color: #f6f6f2;
      margin: 0;
      font-family: 'Poppins', sans-serif;
    }

    form {
      width: 400px;
      background-color: rgba(255, 255, 255, 0.13);
      backdrop-filter: blur(10px);
      padding: 30px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #333;
    }

    form * {
      font-family: 'Poppins', sans-serif;
      font-size: 16px;
      border: none;
      outline: none;
      box-sizing: border-box;
    }

    input[type="text"], input[type="radio"] {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.25);
      box-shadow: inset 2px 2px 5px rgba(0,0,0,0.05);
      color: #333;
    }

    input[type="radio"] {
      width: auto;
      margin-right: 10px;
    }

    label.radio-label {
      display: inline-block;
      margin-right: 20px;
      cursor: pointer;
    }

    .payment-section {
      display: none;
    }

    .visible {
      display: block;
    }

    button {
      margin-top: 30px;
      padding: 12px;
      width: 100%;
      border-radius: 8px;
      background-color: #14B8A6;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #0D9488;
    }

    h3 {
      text-align: center;
    }
  </style>

  <script>
    function showSection(method) {
      document.getElementById('card-fields').classList.remove('visible');
      document.getElementById('upi-fields').classList.remove('visible');
      if (method === 'card') {
        document.getElementById('card-fields').classList.add('visible');
      } else if (method === 'upi') {
        document.getElementById('upi-fields').classList.add('visible');
      }
    }

    window.onload = function () {
      const radios = document.querySelectorAll('input[name="payment_method"]');
      radios.forEach(radio => {
        radio.addEventListener('change', () => showSection(radio.value));
      });
    };
  </script>
</head>
<body>

<form method="POST">
  <h3>Demo Payment</h3>

  <label class="radio-label">
    <input type="radio" name="payment_method" value="card" required> Card
  </label>
  <label class="radio-label">
    <input type="radio" name="payment_method" value="upi"> UPI
  </label>

  <!-- Card Payment Fields -->
  <div id="card-fields" class="payment-section">
    <label>Name on Card</label>
    <input type="text" name="card_name" placeholder="John Doe">

    <label>Card Number</label>
    <input type="text" name="card_number" placeholder="0000 0000 0000 0000">

    <label>Expiry</label>
    <input type="text" name="expiry" placeholder="MM/YY">

    <label>CVV</label>
    <input type="text" name="cvv" placeholder="123">
  </div>

  <!-- UPI Payment Field -->
  <div id="upi-fields" class="payment-section">
    <label>UPI ID</label>
    <input type="text" name="upi_id" placeholder="example@upi">
  </div>

  <button type="submit" name="pay">Pay ₹199.00 Now</button>
</form>

<?php
if (isset($_POST['pay'])) {
  // Optional: Check selected payment method for further validation
  $method = $_POST['payment_method'] ?? '';
  // For demo, just redirect
  header("Location: download.php?book_id=" . urlencode($book_id));
  exit;
}
?>

</body>
</html>
