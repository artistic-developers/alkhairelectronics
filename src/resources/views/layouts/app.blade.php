<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<link href="../../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../css/style.css" rel="stylesheet">
<link href="../../../../css/font-awesome.min.css" rel="stylesheet">

<script src="../../../../js/jquery-1.11.1.min.js"></script>
<script src="../../../../js/bootstrap.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="../../../../../css/materialize.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../../../../js/materialize.min.js"></script>
<script src="../../../../js/main.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>

</script>
</head>

<body>


@if(Auth::user())
<div class="container-fluid">
    <div class="row">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <img src="../../../../uploads/logo/logo2.png" width="40" class="size" style="margin-top:5px;margin-left: 5px;" />
                
            </div>
            <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/home">
                        Home
                    </a>
                </li>
                <li>
                    <a>
                        Shop Reports
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a style="margin-right: 10px;" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                </li>
            </ul>
            </div>
        </div>
    </div>
</div>
<!--<div class="nav-side-menu">
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                
                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fa fa-users fa-lg"></i> Add Users </a>
                </li>
                

                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><i class="fa fa-product-hunt fa-lg"></i> Add Products </a>
                </li>  
                

                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#"><i class="fa fa-money fa-lg"></i> Branches <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                  <li>Branch 1</li>
                  <li>Branch 2</li>
                  <li>Branch 3</li>
                </ul>

                 <li>
                  <a href="#">
                  <i class="fa fa-share fa-lg"></i>Add Stock
                  </a>
                  </li>

            </ul>
     </div>
</div>-->
<div class="container-fluid">
    <div class="row">
        <div class="operGap">
            <div class="col-md-3">
                <div class="sideNav">
                    <div class="sideNavIn">
                        @yield('side-nav')
                        <ul class="nav1">
                            <li>
                                <a href="/users/">
                                    <i class="fa fa-users fa-lg"></i> Users Area
                                </a>
                            </li>
                            <li>
                                <a href="/products">
                                <i class="fa fa-product-hunt fa-lg"></i> Products Area
                                </a>
                            </li>
                            <li>
                            <a href="">
                                <i class="fa fa-plus fa-lg"></i> Add Stock
                                </a>
                            </li>
                            <li data-toggle="collapse" href="#collapse1">
                            <a href="">
                                <i class="fa fa-industry fa-lg"></i> Branches <i class="arrow fa fa-caret-down fa-lg"></i>
                            </a>
                            </li>
                            <div id="collapse1" class="collapse">
                                <ul class="nav1">
                                    <li><a>Branch 1</a></li>
                                    <li><a>Branch 2</a></li>
                                    <li><a>Branch 3</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="mainBody">
                    <div class="mainBodyIn">
                       @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="pull-left">
                <p class="footerDec">&#169; 2017 AL KHAIR ELECRTONICS</p>
            </div>
            <div class="pull-right">
                <p class="footerDec1">Developed by WestCodesDevelopers</p>
            </div>
        </div>
    </div>
</div>
@else
<div class="container" style="margin-top: 15%;">
    @yield('content')
</div> 
@endif
</body>

</html>