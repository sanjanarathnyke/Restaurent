<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Bill</title>
  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="w-100 mx-auto bg-white p-4 border">
      <!-- Restaurant Header -->
      <div class="text-center mb-4">
        <h1 class="h4 font-weight-bold mb-1">Seaside Sushi House</h1>
        <p class="mb-1">1500 Main Ave</p>
        <p class="mb-1">Long Beach, CA 90712</p>
        <p class="mb-4">505-303-2993</p>
        
        <div class="border-top border-bottom py-2 mb-4">
          <p class="mb-1">09/09/2020 06:45 AM</p>
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
            <tr>
              <td>1</td>
              <td>Rainbow Roll</td>
              <td class="text-right">$15.95</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Spider Rolls</td>
              <td class="text-right">$14.95</td>
            </tr>
            <tr>
              <td>1</td>
              <td>750mL Hakutsuru</td>
              <td class="text-right">$39.95</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Totals -->
      <div class="border-top pt-4 mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span>CART SUBTOTAL</span>
          <span>$70.85</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>SERVICE CHARGE</span>
          <span>$50</span>
        </div>
        <div class="d-flex justify-content-between font-weight-bold mb-4">
          <span>ORDER TOTAL</span>
          <span>$76.16</span>
        </div>
      </div>

      <!-- Payment Info -->
      <div class="mb-4">
        <p class="mb-2">PAYMENT TYPE: VISA Card</p>
        <p class="mb-1">APP#: 11278860</p>
        <p class="mb-1">REF#: 18623058</p>
        <p class="mb-0">REC#: 0018</p>
      </div>

      <!-- Tip and Total Section -->
      <div class="mb-4">
        <div class="d-flex justify-content-between mb-2">
          <span>TIP</span>
          <div class="border-bottom w-50"></div>
        </div>
        <div class="d-flex justify-content-between">
          <span>TOTAL</span>
          <div class="border-bottom w-50"></div>
        </div>
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
  <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  
</body>
</html>