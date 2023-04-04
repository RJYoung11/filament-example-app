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
                <a href="to-deliver-products" style="margin-right: 20px">To Deliver Products</a>
            @endif
            <a href="/logout">Logout</a>
        </p>
    </div>

    <div class="w3-container orders">
        <h2>List of Orders</h2>
        <br><br>

        <ul class="w3-ul w3-card-4">
            @foreach ($customers as $customer)
                <li class="w3-bar {{ is_null($customer->delivery) ? 'list' : 'unallowed' }}"
                    onclick="toDeliver(JSON.parse( '{{ $customer }}'), JSON.parse ('{{ Auth::guard('ordinary')->user() }}'))">
                    <span class="w3-bar-item w3-small w3-right">Courier:
                        {{ !is_null($customer->delivery) ? $customer->delivery->courier_name : 'N/A' }}</span>
                    <img src="{{ asset('storage/' . $customer->product->file) }}" class="w3-bar-item w3-hide-small"
                        style="width:85px">
                    <div class="w3-bar-item">
                        <span class="w3-large">{{ $customer->firstname . ' ' . $customer->lastname }}</span><br>
                        <span class="w3-small">{{ $customer->product->product_name }}</span><br>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</body>

<script>
    const toDeliver = (data, courier) => {
        let deliver = {
            courier_name: courier.fullname,
            customer_id: data.id,
            product_id: data.product_id,
            courier_id: courier.id,
            status: 'Process'
        };
        let value = data.delivery === null ? confirm("Do you want to deliver this item?") : false;
        if (data.delivery === null && value) {
            axios.post('add-with-courier', deliver).then(response => {
                location.reload();
            });
        }
    }
</script>

</html>
<style>
    .header {
        background-color: rgb(224, 224, 224);
        height: 70px;
        width: 100%;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
    }

    a {
        text-decoration: none;
    }

    .orders {
        width: 60%;
        margin-left: auto;
        margin-right: auto;
    }

    .list {
        cursor: pointer;
    }

    .list:hover {
        background-color: rgb(237, 237, 237);
    }

    .unallowed {
        cursor: not-allowed;
    }
</style>
