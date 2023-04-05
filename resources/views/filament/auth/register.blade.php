<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>

<body>
    <div id="form">
        <h2>Register</h2>
        <label for="fname">Fullname</label>
        <input type="text" id="name" name="fname">
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <label for="type">Type of User</label>
        <select name="type" id="type">
            <option disabled selected></option>
            <option value="customer">Customer</option>
            <option value="courier">Courier</option>
        </select>
        <button onclick="onSubmit()">Submit</button>
        <p>or</p>
        <p>
            Already had an account? <a href="/login">Login </a>
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

        axios.post('sign-up', obj).then(response => {
            if(response.data) document.location.href = 'accept-product'
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
        border-radius: 10px;
        margin-top: 5%;
        box-shadow: 5px 8px 5px rgb(177, 177, 177, 0.5);
    }

    label {
        font-family: Arial, Helvetica, sans-serif;
    }

    input, select {
        outline: none;
        width: 96%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-bottom: 1px solid black;
        background-color: rgba(230, 230, 230, 0.1)
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
    }

    button:hover {
        background-color: #3e8e41
    }

    button:active {
        background-color: #306932;
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
        text-align: center;
    }

    @media only screen and (max-width: 900px) {
        #form {
            background-color: white;
            width: 90%;
        }
    }
</style>