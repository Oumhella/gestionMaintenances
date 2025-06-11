<style>
    /*.menu {*/
    /*    margin: 0;*/
    /*    padding: 0;*/
    /*    list-style: none;*/
    /*}*/

    /*.menu .nav-item {*/
    /*    margin-bottom: 10px;*/
    /*}*/

    /*.menu .nav-link {*/
    /*    text-decoration: none;*/
    /*}*/

    /*.menu .btn {*/
    /*    width: 100%; !* Make buttons full-width *!*/
    /*}*/

    /*.menu .btn-primary {*/
    /*    background-color: #007bff;*/
    /*    color: #fff;*/
    /*}*/

    /*.menu .btn-secondary {*/
    /*    background-color: #6c757d;*/
    /*    color: #fff;*/
    /*}*/

    /*.menu .btn-success {*/
    /*    background-color: #28a745;*/
    /*    color: #fff;*/
    /*}*/
    body {
        font-family: "Lato", sans-serif;
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
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }

</style>
{{--<div class="menu">--}}
<body>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('coffrets_informatique') }}">
                <button class="btn btn-primary">Coffrets informatique</button>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('gtc') }}">
                <button class="btn btn-secondary">sous-stations GTC</button>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.maintenance_preventive.intervention_sur_site.Comptage_electrique') }}">
                <button class="btn btn-success">Comptage electrique</button>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('comptage_eau') }}">
                <button class="btn btn-success">Comptage d'eau</button>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pcs') }}">
                <button class="btn btn-success">Salles PCS</button>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ge') }}">
                <button class="btn btn-success">Gestion d'affichage</button>
            </a>
        </li>
        <!-- Add more buttons as needed -->
    </ul>
</div>
<span style="color:white; font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Tasks</span>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
</body>
