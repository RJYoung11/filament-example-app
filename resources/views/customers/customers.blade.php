<html>

<head>
    <title>Customers</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
        <a href="profile">Profile</a>
        <a href="/logout">Logout</a>
    </div>
    <div class="header">
        <span class="navbarIcon" onclick="openNav()">&#9776; Customers</span>
        <p class="headerP">
            {{ Auth::guard('ordinary')->user()->fullname }}
        </p>
    </div>

    <div class="display">
        <br>

        <div style="padding-bottom: 10px;">
            <select class="select-option" onchange="onFilter(this)" id="selected">
                <option value="all">All</option>
                <option value="without">Without Courier</option>
                <option value="with">With Courier</option>
            </select>
        </div>
        <div class="row">
            @foreach ($customers as $customer)
                <div class="column">
                    @if (!is_null($customer))
                        <div class="card" id="{{ $customer->id }}">
                            <img src="{{ asset('storage/' . $customer->product->file) }}">
                            <p>Buyer: {{ $customer->firstname . ' ' . $customer->lastname }}</p>
                            <p>To Pay: {{ $customer->quantity * $customer->product->price }}</p>
                            <p>Courier:
                                <b>{{ !is_null($customer->delivery) ? $customer->delivery->courier_name : 'N/A' }}
                                </b>
                            </p>
                            <br>
                            <br>

                            <button class="{{ is_null($customer->delivery) ? 'list' : 'unallowed' }}"
                                style="margin-bottom: 10px;" {{ !is_null($customer->delivery) ? 'disabled' : '' }}
                                onclick="toDeliver(JSON.parse( '{{ $customer }}'), JSON.parse ('{{ Auth::guard('ordinary')->user() }}'))">
                                {{ !is_null($customer->delivery) && $customer->delivery->status === 'Package Arrived' ? 'Successfully Delivered' : 'Deliver' }}</button>
                            {{-- @if ($customer->delivery->status === 'Package Arrived')
                            <button style="background-color: white; color: red; border: 1px solid red;">Remove</button>
                        @endif --}}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</body>

<script>
    let customers = {!! json_encode($customers->toArray()) !!};
    let params = new URLSearchParams(window.location.search).get('filter');

    console.log(customers);
    document.getElementById('selected').value = params != null ? params : 'all';
    const openNav = () => {
        document.getElementById("mySidenav").style.width = window.innerWidth < 1000 ? "500px" : "250px";
    }

    const closeNav = () => {
        document.getElementById("mySidenav").style.width = "0";
    }
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

    const onFilter = (value) => {
        window.location.href = '?filter=' + value.value
    }
</script>

</html>
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

    .navbarIcon {
        font-size: 30px;
        cursor: pointer;
        margin: 20px;
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
        float: right;
    }

    .select-option {
        padding: 5px; 
        padding-right: 10px;
        outline: none; 
        width: 20%; 
        border-radius: 50px;
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
        text-align: center;
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

    button:active {
        background-color: #56a459;
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

    .unallowed:disabled {
        cursor: not-allowed;
        background-color: white;
        color: grey;
    }

    .list {
        cursor: pointer;
    }

    @media only screen and (max-width: 1000px) {
        .select-option {
            width: 100%;
            font-size: 40px;
            padding: 20px;
        }
        img {
            height: 10%;
        }

        .card {
            margin-bottom: 50px;
        }

        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }

        .body {
            height: 50%;
            width: 100%;
        }

        .display {
            padding: 5px;
            margin: 15px;
            padding-top: 15%;
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
            margin-top: 5px;
            margin-bottom: 5px;
            text-align: left;
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
