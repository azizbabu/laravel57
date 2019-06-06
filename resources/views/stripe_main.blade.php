<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel 5 - Stripe Payment Gateway Integration Example</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <style>
    .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
  </style>
</head>
<body>
  <div class="container">
        <h1>Laravel 5 - Stripe Payment Gateway Integration Example </h1>
      
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <div class="row display-tr">
                            <div class="panel-title display-td">Payment Details</div>
                            <div class="display-td">
                                <img src="http://i76.imgup.net/accepted_c22e0.png" alt="Stripe image" class="img-responsive pull-right">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" data-dismiss="alert" aria-label="close" class="close">x</a>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    <form action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf

                        <div class="form-group">
                            <label for="Card Number" class="control-label">Name on Card</label>
                            <input type="text" autocomplete='off' class='form-control' size='4'>
                        </div>

                        <div class="form-group card required">
                            <label for="" class="control-label">Card Number</label>
                            <input type="text" autocomplete='off' class='form-control card-number' size='20'>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group cvc required">
                                    <label for="" class="control-label">CVC</label>
                                    <input type="text" name="" id="" class="form-control card-cvc" placeholder="ex.311" size="4">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group expiration required">
                                    <label for="" class="control-label">Expiration Month</label>
                                    <input type="text" name="" id="" class="form-control card-expiry-month" placeholder="MM" size="2">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="control-label">Expiration Year</label>
                                <input type="text" name="" id="" class="form-control card-expiry-year" placeholder="YYYY" size="4">
                            </div>
                        </div>

                        <div class="form-group error hide">
                            <div class="alert alert-danger">Please correct the errors and try again</div>
                        </div>

                        <div class="form-group"><button class="btn btn-primary">Pay now (100$)</button></div>
                    </form>
                </div>
            </div>
        </div>
  </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script type="text/javascript">
    $(function() {
    
        var $form         = $(".require-validation");
    
      $('form.require-validation').bind('submit', function(e) {
    
        var $form         = $(".require-validation"),
    
            inputSelector = ['input[type=email]', 'input[type=password]',
    
                             'input[type=text]', 'input[type=file]',
    
                             'textarea'].join(', '),
    
            $inputs       = $form.find('.required').find(inputSelector),
    
            $errorMessage = $form.find('div.error'),
    
            valid         = true;
    
            $errorMessage.addClass('hide');
    
     
    
            $('.has-error').removeClass('has-error');
    
        $inputs.each(function(i, el) {
    
          var $input = $(el);
    
          if ($input.val() === '') {
    
            $input.parent().addClass('has-error');
    
            $errorMessage.removeClass('hide');
    
            e.preventDefault();
    
          }
    
        });
    
      
    
        if (!$form.data('cc-on-file')) {
    
          e.preventDefault();
    
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
    
          Stripe.createToken({
    
            number: $('.card-number').val(),
    
            cvc: $('.card-cvc').val(),
    
            exp_month: $('.card-expiry-month').val(),
    
            exp_year: $('.card-expiry-year').val()
    
          }, stripeResponseHandler);
    
        }
    
      
    
      });
    
      
    
      function stripeResponseHandler(status, response) {
    
            if (response.error) {
    
                $('.error')
    
                    .removeClass('hide')
    
                    .find('.alert')
    
                    .text(response.error.message);
    
            } else {
    
                // token contains id, last4, and card type
    
                var token = response['id'];
    
                // insert the token into the form so it gets submitted to the server
    
                $form.find('input[type=text]').empty();
    
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
    
                $form.get(0).submit();
    
            }
    
        }
    
      
    
    });
    
</script>


</body>
</html>