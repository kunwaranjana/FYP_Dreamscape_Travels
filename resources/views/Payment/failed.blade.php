
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment-failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>

    {{-- @section('content')
    <div class="container text-center">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h2 class="text-danger">Payment Failed!</h2>
        <p>We were unable to process your payment. Please try again.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
    </div> --}}


    @if (session('error')) 
        <div style="color: red;   background-color: #f7f8fc;  font-weight: bold; text-align: center; padding: 3rem; margin: 10px 0; height:350px">
            {{-- We were unable to process your payment.  --}}
            {{ session('error') }} &nbsp;&nbsp;
            <a href="{{ route('home') }}">Back to Home</a>
        </div>
    @endif



</body>
</html>
