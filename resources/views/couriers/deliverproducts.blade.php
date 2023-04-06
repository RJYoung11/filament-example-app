<html>

<head>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>To Deliver Products</title>
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="accept-product" style="margin-right: 20px">Home</a>
        @if (Auth::guard('ordinary')->user()->type === 'courier')
            <a href="customers" style="margin-right: 20px">Customers</a>
            <a href="to-deliver-products" style="margin-right: 20px">To Deliver</a>
        @else
            <a href="status" style="margin-right: 20px">Order Status</a>
        @endif
        <a href="/logout">Logout</a>
    </div>

    <div class="header">
        <span class="navbarIcon" onclick="openNav()">&#9776; </span>
        <p class="headerP">
            {{ Auth::guard('ordinary')->user()->fullname }}
        </p>
    </div>

    <div class="w3-container orders">
        <h2>To Deliver Products</h2>
        <br>

        <div class="row">
            <div style="text-align: center">
                @if (count($delivery) < 1)
                    <img src="{{ asset('storage/empty.png') }}"
                        style="height: 65%;" />
                @endif
            </div>
            @foreach ($delivery as $deliver)
                <div class="column">
                    <div class="card">
                        <div style="text-align: center">
                            <img src="{{ asset('storage/' . $deliver->product->file) }}">
                        </div>
                        <h2 style="text-align: center">{{ $deliver->product->product_name }}</h2>
                        <p>Customer's Name: {{ $deliver->customer->firstname . ' ' . $deliver->customer->lastname }}
                        </p>
                        <p>To Pay ($): {{ $deliver->product->price * $deliver->customer->quantity }}</p>
                        @if ($deliver->status === 'Process')
                            <button onclick="changeStatusDeliverToday(JSON.parse( '{{ $deliver }}'))">On the
                                Way</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>

<script>
    let delivery = {!! json_encode($delivery->toArray()) !!};

    console.log(delivery);

    const openNav = () => {
        document.getElementById("mySidenav").style.width = window.innerWidth < 1000 ? "500px" : "250px";
    }

    const closeNav = () => {
        document.getElementById("mySidenav").style.width = "0";
    }

    const changeStatusDeliverToday = (record) => {
        let data = {
            id: record.id,
            status: 'On the way'
        }
        axios.post('update-status', data).then(response => {
            console.log(response);
            location.reload();
        });
    }
</script>

<style scoped>
    img {
        height: 20%;
    }

    a {
        text-decoration: none;
    }

    a:not(.closebtn) {
        width: 250px;
    }

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    input {
        outline: none;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-bottom: 1px solid black;
        background-color: rgba(225, 225, 225, 0.3)
    }

    .column {
        float: left;
        width: 33%;
        padding: 0 10px;
        margin-bottom: 20px;
    }

    .row {
        margin: 0 -5px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .card:hover {
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
    }

    .display {
        margin: 10%;
        margin-top: 5%;
    }

    .body {
        padding: 20px;
    }

    button {
        padding: 10px;
        border-radius: 5px;
        outline: none;
        cursor: pointer;
        color: #fff;
        background-color: #4CAF50;
        border: none;
        width: 100%;
    }

    button:hover {
        background-color: #3e8e41
    }


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

    .orders {
        padding-top: 5%;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    .navbarIcon {
        font-size: 30px;
        cursor: pointer;
        margin: 20px;
    }

    @media only screen and (max-width: 1000px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 50px;
        }

        img {
            height: 10%;
        }

        .orders {
            width: 100%;
            margin: 0;
            padding-top: 10%;
        }

        .card {
            width: 100%;
        }

        .body {
            height: 50%;
            width: 100%;
        }

        .display {
            padding: 5px;
            margin: 15px;
        }

        h2 {
            font-size: 80px;
            margin-bottom: 20px;
            padding: 30px;
            text-align: center;
        }

        input {
            font-size: 60px;
        }

        p {
            font-size: 40px;
        }

        .span {
            font-size: 40px;
        }

        button {
            font-size: 40px;
            padding: 20px;
        }

        .header {
            height: 6%;
        }

        .headerP {
            display: none
        }

        .icon {
            display: block;
            font-size: 100px;
            float: right;
            margin: 20px;
        }

        .navbarIcon {
            font-size: 50px;
            margin-left: 30px;
        }

        .sidenav a {
            font-size: 50px;
            padding-bottom: 5%;
            padding-top: 5%;
        }

        .sidenav a:not(.closebtn) {
            width: 400px;
        }
    }
</style>
