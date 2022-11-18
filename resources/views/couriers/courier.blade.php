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
    <div class="confirmation">
        <select id="user">
            <option disabled selected>Select your user</option>
            @foreach ($courier as $key => $arr)
                <option value="{{ $arr->courier_name }}"> {{ $arr->courier_name }}
                </option>
            @endforeach
        </select><br><br>
        <button class="button" onclick="submitSelectedUser()">Click when you're on the way</button>
    </div>
</body>

</html>
<script>
    var selectedUser = ''
    var e = document.getElementById("user");

    function onChange() {
        var value = e.value;
        var text = e.options[e.selectedIndex].text;
        selectedUser = value;
    }
    e.onchange = onChange;


    function submitSelectedUser() {
        axios.get('update-status/' + selectedUser).then((response) => {
            alert('Courier is on the way to deliver!');
        })
    }
</script>
<style>
    select {
        width: 100%;
        padding: 5px;
    }

    option {
        margin: 10px;
    }

    .confirmation {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
    }

    .button {
        display: inline-block;
        padding: 15px 25px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #4CAF50;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
        width: 100%
    }

    .button:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
</style>
