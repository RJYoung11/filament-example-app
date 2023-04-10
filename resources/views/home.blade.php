<html>

<head>
    <title>Select Product</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="accept-product">Home</a>
        @if (Auth::guard('ordinary')->user()->type === 'courier')
            <a href="customers">Customers</a>
            <a href="to-deliver-products">To Deliver</a>
        @else
            <a href="status">Order Status</a>
        @endif
        <a href="profile">Profile</a>
        <a href="/logout">Logout</a>
    </div>
    <div class="header">
        <p class="headerP">
            {{ Auth::guard('ordinary')->user()->fullname }}
        </p>
        <span class="navbarIcon" onclick="openNav()">&#9776; Products</span>

    </div>
    <div class="display">
        <br>
        <div class="row">
            @foreach ($products as $product)
                <div class="column">
                    <div class="card" id="{{ $product->id }}">
                        <img src="{{ asset('storage/' . $product->file) }}">
                        <p>Name: {{ $product->product_name }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Item's on Hand: {{ $product->item_on_hand }}</p><br>

                        <button onclick="clickButton({{ $product }})" class="view-button">
                            {{ Auth::guard('ordinary')->user()->type === 'customer' ? 'Add Order' : 'View Item' }}</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-4 body">
            <header class="w3-container">
                <span onclick="unselect()" class="w3-button w3-display-topright span">&times;</span>
                <h2 id="name"></h2>
            </header>
            <div class="modRow">
                <div class="w3-container modColumn" style="text-align: center;">
                    <img src="" style="height: 30%; margin: 25px; border-radius: 10px;" id="image">
                </div>
                <div class="w3-container modColumn">
                    <input placeholder="How many of this item?" type="number" id="quantity">

                    <footer class="w3-container">
                        <p id="item_on_hand"></p>
                        <p id="amount"></p>

                        <div style="float: right;">
                            @if (Auth::guard('ordinary')->user()->type === 'customer')
                                <button onclick="placeOrder(JSON.parse('{{ Auth::guard('ordinary')->user() }}'))">Place
                                    Order</button>
                            @endif
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var obj = {}
    var selectedId = ''

    const openNav = () => {
        document.getElementById("mySidenav").style.width = window.innerWidth < 1000 ? "500px" : "250px";
    }

    const closeNav = () => {
        document.getElementById("mySidenav").style.width = "0";
    }

    const clickButton = (product) => {
        document.getElementById(product.id).style.backgroundColor = '#C9E3CC'
        document.getElementById('name').innerHTML = product.product_name
        document.getElementById('amount').innerHTML = 'Amount ($): ' + product.price
        document.getElementById('item_on_hand').innerHTML = "Item's on hand: " + product.item_on_hand
        document.getElementById('id01').style.display = 'block'
        document.getElementById('image').src = "storage/" + product.file + ""

        selectedId = product
    }

    const unselect = () => {
        document.getElementById(selectedId.id).style.backgroundColor = ''
        document.getElementById('id01').style.display = 'none'
    }

    const placeOrder = (courier) => {
        let users = {!! json_encode($user->toArray()) !!};
        let quantity = document.getElementById('quantity').value;

        topass = {
            'firstname': users.fullname.split(" ")[0],
            'lastname': users.fullname.split(" ")[1],
            'email': users.email,
            'purchased_item': selectedId.product_name,
            'quantity': quantity,
            'product_id': selectedId.id,
            'ordinary_user_id': courier.id
        }

        if (quantity !== '') {
            axios.post('customers', topass).then(response => {
                location.reload();
                document.location.ref = 'accept-product'
            });
        } else {
            alert("No quantity created!");
        }
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

    input {
        outline: none;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-bottom: 1px solid black;
        background-color: rgba(255, 255, 255, 0.1)
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
    }

    button:hover {
        background-color: #3e8e41
    }

    button:active {
        background-color: #56a459;
    }


    .view-button {
        width: 100%;
        background-color: white;
        color: rgb(95, 169, 235);
        border: 1px solid rgb(95, 169, 235);
        transition: transform 0.3s;
    }

    .view-button:hover {
        background-color: rgb(173, 217, 255);
        color: white;
        border: 1px solid rgb(173, 217, 255);
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

    .modColumn {
        float: left;
        width: 50%;
        padding: 10px;
    }

    .modRow::after {
        content: "";
        display: table;
        clear: both;
    }

    @media only screen and (max-width: 1000px) {
        img {
            height: 10%;
        }

        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }

        .card {
            margin-bottom: 50px;
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
            padding-top: 25px;
        }

        .headerP {
            display: none;
            margin-bottom: 50px;
        }

        .icon {
            display: block;
            font-size: 100px;
            float: right;
            margin: 20px;
        }

        .row {
            padding-top: 0;
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
