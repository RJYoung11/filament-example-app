<html>

<head>
    <title>Select Product</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="display">
        <div class="row">
            @foreach ($products as $product)
                <div class="column">
                    <div class="card" onclick="clickButton({{ $product }})" id="{{ $product->id }}">
                        <img style="height: 20%;" src="{{ asset('storage/' . $product->file) }}">
                        <p>Name: {{ $product->product_name }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Item's on Hand: {{ $product->item_on_hand }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-animate-top w3-card-4">
            <header class="w3-container">
                <span onclick="unselect()" class="w3-button w3-display-topright">&times;</span>
                <h2 id="name"></h2>
            </header>
            <div class="w3-container">
                <input placeholder="How many of this item?" type="number">
            </div>

            <footer class="w3-container">
                <p id="amount"></p>
              </footer>
        </div>
    </div>
</body>

<script>
    var obj = {}
    var selectedId = ''
    var selectBox = document.getElementById('product_id');

    const clickButton = (product) => {
        document.getElementById(product.id).style.backgroundColor = '#C9E3CC'
        document.getElementById('name').innerHTML = product.product_name
        document.getElementById('amount').innerHTML = 'Amount: ' + product.price
        document.getElementById('id01').style.display = 'block'
    }

    const unselect = () => {
        document.getElementById(selectedId).style.backgroundColor = ''
        document.getElementById('id01').style.display = 'none'        
    }
</script>

</html>
<style>
    input {
        width: 90%;
        padding: 5px;
        outline: none;

    }
    .column {
        float: left;
        width: 31%;
        padding: 0 10px;
    }

    .row {
        margin: 0 -5px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
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
    }
</style>
