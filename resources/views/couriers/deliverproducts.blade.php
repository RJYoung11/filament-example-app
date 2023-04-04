<html>

<head>
    <title>To Deliver Products</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">
        <p class="headerP">
            <a href="accept-product" style="margin-right: 20px">Home</a>

            @if (Auth::guard('ordinary')->user()->type === 'courier')
                <a href="customers" style="margin-right: 20px">Customers</a>
                <a href="to-deliver-products" style="margin-right: 20px">To Deliver Products</a>
            @else
                <a href="status" style="margin-right: 20px">Order Status</a>
            @endif
            <a href="/logout">Logout</a>
        </p>

        <i class="fa fa-bars icon"></i>
    </div>

</body>

</html>

<style>
    .header {
        background-color: rgb(224, 224, 224);
        height: 70px;
        width: 100%;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
        position: fixed;
        top: 0;
    }

    .headerP {
        margin: 0;
        padding: 10px;
        float: right;
        margin-right: 5%;
        margin-top: 15px
    }

    .icon {
        display: none;
    }

    @media only screen and (max-width: 1000px) {
        .icon {
            display: block;
            font-size: 100px;
            float: right;
            margin: 20px;
        }
    }
</style>
