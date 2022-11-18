<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Item Confirmation</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>

<body>
    <div id="isAccepted">
        <p>Product was added successfully, Click buttons for response</p>
        <button onclick="checkIfItemIsOnWay()">Show delivery status</button>
        <button onclick="itemArrived()">Click this button if you're has already arrived!</button>
    </div>
</body>

</html>

<script>
    var urlParams = new URLSearchParams(window.location.search).get('customer_id')

    function checkIfItemIsOnWay() {
        axios.get('api/customers/status/' + urlParams).then(status => {
            !status.data ? alert('Your request is on the process!') : alert('Request is ' + status.data.status)
        })
    }

    function itemArrived() {

        let rate = prompt("Please rate your rider from 1-10");
        console.log(rate)
        // axios.put('/api/customers/status/' + urlParams).then((response) => {
        //     alert('You have successfully received your ordered item!');
        // })
    }
</script>

<style>
    #isAccepted {
        margin-left: auto;
        margin-right: auto;
    }

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
</style>
