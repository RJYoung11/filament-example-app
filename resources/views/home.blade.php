<html>

<head>
    <title>Select Product</title>
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
            @else
                <a href="status" style="margin-right: 20px">Order Status</a>
            @endif
            <a href="/logout">Logout</a>
        </p>

        <i class="fa fa-bars icon"></i>
    </div>
    <div class="display">
        <div class="row">
            @foreach ($products as $product)
                <div class="column">
                    <div class="card" onclick="clickButton({{ $product }})" id="{{ $product->id }}">
                        <img src="{{ asset('storage/' . $product->file) }}">
                        <p>Name: {{ $product->product_name }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Item's on Hand: {{ $product->item_on_hand }}</p>
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
            <div class="w3-container">
                <input placeholder="How many of this item?" type="number" id="quantity">
            </div>

            <footer class="w3-container">
                <p id="item_on_hand"></p>
                <p id="amount"></p>

                <div style="float: right;">
                    @if (Auth::guard('ordinary')->user()->type === 'customer')
                        <button onclick="placeOrder()">Place Order</button>
                    @endif
                </div>
            </footer>
        </div>
    </div>
</body>

<script>
    var obj = {}
    var selectedId = ''

    const clickButton = (product) => {
        document.getElementById(product.id).style.backgroundColor = '#C9E3CC'
        document.getElementById('name').innerHTML = product.product_name
        document.getElementById('amount').innerHTML = 'Amount: ' + product.price
        document.getElementById('item_on_hand').innerHTML = "Item's on hand: " + product.item_on_hand
        document.getElementById('id01').style.display = 'block'

        selectedId = product
    }

    const unselect = () => {
        document.getElementById(selectedId.id).style.backgroundColor = ''
        document.getElementById('id01').style.display = 'none'
    }

    const placeOrder = () => {
        let users = {!! json_encode($user->toArray()) !!};
        let quantity = document.getElementById('quantity').value;

        topass = {
            'firstname': users.fullname.split(" ")[0],
            'lastname': users.fullname.split(" ")[1],
            'email': users.email,
            'purchased_item': selectedId.product_name,
            'quantity': quantity,
            'product_id': selectedId.id
        }
        axios.post('customers', topass).then(response => {
            console.log(response);
            document.location.ref = 'accept-product'
        });
    }
</script>

</html>
<style scoped>
    img {
        height: 20%;
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
        padding-top: 10%;
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

        .row {
            padding-top: 15%;
        }
    }
</style>
