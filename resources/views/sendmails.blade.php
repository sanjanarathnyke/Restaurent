<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg" style="max-width: 500px; width: 100%;">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4">Contact Us</h2>
                
                <form action="{{ route('send.email') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="message" class="form-label">Type Message</label>
                        <textarea 
                            class="form-control" 
                            id="message" 
                            name="message" 
                            rows="4" 
                            placeholder="Enter your message"
                            required
                        ></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        Send
                    </button>
                </form>
                
              
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("emailForm").addEventListener("submit", function(event) {
            document.getElementById("sendButton").disabled = true; // Disable button to prevent multiple submissions
        });
    </script>
</body>
</html>