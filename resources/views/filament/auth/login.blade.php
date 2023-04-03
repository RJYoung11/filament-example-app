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
        <h2>Login</h2>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <br><br>
        <button onclick="onSubmit()">Submit</button>
        <br><br>
        <p>
            No account yet? <a href="/register">Register</a>
        </p>
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

        axios.post('sign-in', obj).then(response => {
            console.log(response)
            if (response.data) document.location.href = 'accept-product'
        })
    }
</script>

<style scoped>
    #form {
        background-color: rgba(205, 205, 205, 0.3);
        width: 25%;
        padding: 20px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 10px
    }

    label {
        font-family: Arial, Helvetica, sans-serif;
    }

    input {
        outline: none;
        width: 96%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-bottom: 1px solid black;
        background-color: rgba(225, 225, 225, 0.3)
    }

    button {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        outline: none;
        display: inline-block;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        color: #fff;
        background-color: #4CAF50;
        border: none;
        box-shadow: 0 9px #999;
    }

    button:hover {
        background-color: #3e8e41
    }

    button:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }

    h2 {
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 40px;
        font-weight: 100;
    }

    p {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
        margin-left: 60%;
    }

    @media only screen and (max-width: 900px) {
        #form {
            width: 85%;
        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 50%
        }
    }
</style>
