<html>

<head>
    <title>Profile</title>
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
        <span class="navbarIcon" onclick="openNav()">&#9776; Profile</span>
    </div>

    <div class="profile-card" id="profile">

        <h1>User Profile</h1>
        <br>
        <div class="input-box">
            <span class="prefix">Fullname</span>
            <input id="fullname" type="text" value="{{ $user->fullname }}">
        </div>
        <div class="input-box">
            <span class="prefix">Email</span>
            <input id="email" type="email" value="{{ $user->email }}">
        </div>
        <div class="input-box">
            <span class="prefix">Current Password</span>
            <input id="curpass" type="password">
        </div>
        <p class="note">Note: If you want to change the password, current password is required.</p>
        <div class="input-box">
            <span class="prefix">New Password</span>
            <input id="newpass" type="password">
        </div>
        <div class="input-box">
            <span class="prefix">Confirm Password</span>
            <input id="conpass" type="password">
        </div>
        <button onclick="onUpdate()">Update Profile</button>
        <br>
        <br>
    </div>

</body>

<script>
    var obj = {}
    var selectedId = ''

    // let user = {!! json_encode($user->toArray()) !!};

    // console.log(user);

    const openNav = () => {
        document.getElementById("mySidenav").style.width = window.innerWidth < 1000 ? "500px" : "250px";
    }

    const closeNav = () => {
        document.getElementById("mySidenav").style.width = "0";
    }

    const onUpdate = () => {
        var divElem = document.getElementById('profile');
        var inputElements = divElem.querySelectorAll("input, select, checkbox, textarea");

        inputElements.forEach((element) => {
            obj[element.id] = element.value
        });

        if (obj.curpass !== '') {
            if (obj.newpass === '') {
                alert('Password field/s are empty.');
            } else {
                obj.newpass === obj.conpass ? axios.post('update-profile', obj).then(response => {
                    console.log(response);
                    // location.reload();
                }) : alert("Passwords didn't match");
            }
        } else {
            alert("Update profile need's the current password");
        }
    }
</script>

</html>
<style scoped>
    h1 {
        text-align: center;
    }

    .profile-card {
        margin-top: 5%;
        width: 40%;
        margin-left: auto;
        margin-right: auto;
        padding: 15px;
        background-color: rgba(225, 225, 225, 0.5);
        border-radius: 10px;
        border: 1px solid rgb(225, 225, 225);
    }

    .note {
        margin: 0;
        font-size: 10px;
        padding-left: 10px;
    }

    .input-box {
        display: flex;
        align-items: center;
        padding-left: 0.5rem;
        overflow: hidden;
        font-family: sans-serif;
    }

    .input-box span {
        width: 250px;
        font-size: 20px;
    }

    .input-box:focus-within {
        border-color:
            #777;
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

    .navbarIcon {
        font-size: 30px;
        cursor: pointer;
        margin: 20px;
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

    button {
        float: right;
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
</style>
