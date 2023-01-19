<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
        <div id="form">
            <h1>Login</h1>
            <input placeholder="Email" type="text" id="email">
            <input placeholder="Pasword" type="password" id="password">
            <button onclick="onSubmit()">Submit</button>
        </div>
</body>
</html>
<script>
    var obj = {}

    const onSubmit = () => {
        var divElem = document.getElementById("form");
        var inputElements = divElem.querySelectorAll("input, select, checkbox, textarea");

        inputElements.forEach(element => {
            obj[element.id] = element.value
        });
        console.log(obj)

        axios.post('sign-in', obj).then(response => {
            if(response.data) document.location.href = 'accept-product'
        })
    }
</script>