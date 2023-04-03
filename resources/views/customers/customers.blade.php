<html>

<head>
    <title>Customers</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="header">
        <p style="margin: 0; padding: 10px; float: right; margin-right: 5%; margin-top: 15px">
            <a href="accept-product" style="margin-right: 20px">Home</a>            
            @if (Auth::guard('ordinary')->user()->type === 'customer')
                <a href="status" style="margin-right: 20px">Order Status</a>
            @else
                <a href="customers" style="margin-right: 20px">Customers</a>
            @endif
            <a href="/logout">Logout</a>
        </p>
    </div>

    <div class="w3-container orders">
        <h2>List of Orders</h2>
        <br><br>

        <ul class="w3-ul w3-card-4">
            @foreach ($customers as $customer)
            <li class="w3-bar">
                <span class="w3-bar-item w3-button w3-white w3-xlarge w3-right">{{ is_null($customer->delivery) || $customer->delivery->status ? 'Pending' : 'On The Way' }}</span>
                <img src="{{ asset('storage/'.$customer->product->file) }}" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
                <div class="w3-bar-item">
                  <span class="w3-large">{{ $customer->firstname. ' ' .$customer->lastname }}</span><br>
                  <span>{{ $customer->product->product_name }}</span>
                </div>
              </li>
            @endforeach
        </ul>
    </div>

</body>

</html>
<style>
    .header {
        background-color: rgb(224, 224, 224);
        height: 70px;
        width: 100%;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
    }

    .orders {
        width: 60%;
        margin-left: auto;
        margin-right: auto;
    }
</style>
