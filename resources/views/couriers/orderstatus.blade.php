<html>

<head>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Order Status</title>
</head>

<body>
    <div class="header">
        <p style="margin: 0; padding: 10px; float: right; margin-right: 5%; margin-top: 15px">
            <a href="accept-product" style="margin-right: 20px">Home</a>
            @if (Auth::guard('ordinary')->user()->type !== 'customer')
                <a href="customers" style="margin-right: 20px">Customers</a>
            @else
                <a href="status" style="margin-right: 20px">Order Status</a>
            @endif
            <a href="/logout">Logout</a>
        </p>
    </div>

    <div class="w3-container orders">
        <h2>Your Order/s</h2>
        <br><br>

        <div class="row">
            @foreach ($orders as $order)
                <div class="column">
                    @if ($order->ordinary_user_id === Auth::guard('ordinary')->user()->id)
                        <div class="card">
                            <div style="text-align: center">
                                <img src="{{ asset('storage/' . $order->product->file) }}">
                            </div>
                            <h4 style="text-align: center">{{ $order->product->product_name }}</h4>
                            <p>Original Price ($): {{ $order->product->price }}</p>
                            <p>To Pay ($): {{ $order->product->price * $order->quantity }}</p>
                            <p>Status: {{ is_null($order->delivery) ? 'Pending' : $order->delivery->status }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>

<script>
    let orders = {!! json_encode($orders->toArray()) !!};

    console.log(orders);
</script>

<style>
    img {
        height: 20%;
    }

    a {
        text-decoration: none;
    }
    .header {
        background-color: rgb(224, 224, 224);
        height: 70px;
        width: 100%;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
    }

    .orders {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }


    .column {
        float: left;
        width: 33%;
        padding: 0 10px;
    }

    /* Remove extra left and right margins, due to padding */
    .row {
        margin: 0 -5px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive columns */
    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
    }

    /* Style the counter cards */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        background-color: #f1f1f1;
    }
</style>
