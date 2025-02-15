<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Bill</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="w-100 mx-auto bg-white p-4 border">
      <!-- Restaurant Header -->
      <div class="text-center mb-4">
        <h1 class="h4 font-weight-bold mb-1">Café Modern Bites</h1>
        <p class="mb-1">1500 Main Ave</p>
        <p class="mb-1">Long Beach, CA 90712</p>
        <p class="mb-4">505-303-2993</p>
        
        <div class="border-top border-bottom py-2 mb-4">
          <p class="mb-1">{{ now()->format('m/d/Y h:i A') }}</p>
          <p class="mb-0">TERMINAL 1</p>
        </div>
      </div>

      <!-- Order Items -->
      <div class="mb-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Qty</th>
              <th scope="col">Item</th>
              <th scope="col" class="text-right">Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cartItems as $item)
            <tr>
              <td>{{ $item['quantity'] }}</td>
              <td>{{ $item['name'] }}</td>
              <td class="text-right">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Totals -->
      <div class="border-top pt-4 mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span>CART SUBTOTAL</span>
          <span>${{ number_format($subtotal, 2) }}</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>SERVICE CHARGE</span>
          <span>${{ number_format($serviceCharge, 2) }}</span>
        </div>
        <div class="d-flex justify-content-between font-weight-bold mb-4">
          <span>ORDER TOTAL</span>
          <span>${{ number_format($total, 2) }}</span>
        </div>
      </div>

      <!-- Payment Info -->
      <div class="mb-4">
        <p class="mb-2">PAYMENT TYPE: {{ $paymentMethod }}</p>
      </div>

      <!-- Signature Section -->
      <div class="mt-4">
        <div class="border-bottom mb-2"></div>
        <p class="text-center font-weight-bold mb-2">CUSTOMER SIGNATURE</p>
        <p class="text-center">
          I agree to pay the above total amount according to<br />
          the card issuer agreement.
        </p>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies (optional) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
