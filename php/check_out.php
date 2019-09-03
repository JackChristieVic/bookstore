<?php 
session_start();
include_once ("header.php");
include_once ("Stripe_Config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="..css/check_out.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  
  <title>Pay Page</title>
</head>
<body>
  <div class="container">
    <h2 class="my-4 text-center">Payment Transaction Page</h2>
    <p>Total Amount Due: <span class="price" style="color:red"><b><?php echo "$" . $_POST['total_cost'] / 100; ?></b></span></p>
    <p style="text-align: left; font-size: 15px; color: grey;">Use the test card number: 4242 4242 4242 4242</p>
    <form action="Stripe.php" method="POST" id="payment-form">
      <div class="form-row">
      
      
       <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Richard">
       <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" value="Bucket">
       <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" value="fake-email@gmail.com">
       <input type="text" name="address" class="form-control mb-3  StripeElement StripeElement--empty" value="Some St. Victoria BC Canada">
       <input type="text" name="phone" class="form-control mb-3 StripeElement StripeElement--empty" value="1(250) 999-9999">
       <input type="hidden" name="total_cost"  value="<?php echo $_POST['total_cost']; ?>">
        <div id="card-element" class="form-control">
          

        <div id="card-element" class="form-control">
          
         
        </div>
        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
      </div>
      <BR />
      <BR />
      <input type="submit" class="btn btn-primary" value="Pay Now">
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      
        // Create a Stripe client.
        var stripe = Stripe('pk_test_TWuJh9ZsG8lBrimqsEqI2VQg');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: 'blue',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: 'red',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }

  </script>
  </div>
</body>
</html>
<?php include_once ("footer.php");?>