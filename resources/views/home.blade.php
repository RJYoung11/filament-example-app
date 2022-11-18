<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <div id="myDiv">
        <input placeholder="First Name" type="text" id="firstname">
        <input placeholder="Last Name" type="text" id="lastname">
        <input placeholder="Email" type="text" id="email">
        <input placeholder="Quantity" type="number" id="quantity">
        <select id="product_id">
            <option selected>Select A Product</option>
        </select>
        <button onclick="clickButton()">Click Button Accept</button>
    </div>

</body>

<script>
    var obj = {}
    var values = []
    var selectBox = document.getElementById('product_id');
    var customerId = '';

    const clickButton = () => {
        var divElem = document.getElementById("myDiv");
        var inputElements = divElem.querySelectorAll("input, select, checkbox, textarea");
        inputElements.forEach((element, index) => {
            obj[element.id] = element.value
        });
        obj['purchased_item'] = values[obj['product_id']]

        axios.post('/api/customers', obj).then(response => {
            console.log(response);
            customerId = response.data.id;

            document.getElementById('myDiv').style.display = 'none'
            location.href = 'confirmation?customer_id=' + customerId

        })
    }

    function getAllProducts() {
        axios.get('/api/products').then(response => {

            for (var i = 0, l = response.data.length; i < l; i++) {
                var option = response.data[i];
                selectBox.options.add(new Option(option.product_name, i));

                values.push(option.product_name)
            }
        })
    }

    getAllProducts();
</script>

</html>
<style>
    input,
    select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        outline: none
    }

    button {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    #myDiv {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>
