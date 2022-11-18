<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <form action="login" method="POST">
        <h1>
            <center>Login</center>
        </h1>
        <input placeholder="Username" type="text">
        <input placeholder="Password" type="password">
        <button>Submit</button>
    </form>
</body>

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

    form {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        width: 30%;
        margin-left: auto;
        margin-right: auto;
    }
</style>
