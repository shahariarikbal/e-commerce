<div class="top-menu-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="menu-fullwidth">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="logo-wrapper">
                                    <div class="logo logo-top">
                                        <a href="{{ url('/') }}"><img src="{{ asset('logo-images/'.$show_logo->image) }}" alt="logo image" class="img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form class="example" action="">
                                    <input type="text" placeholder="Search.." name="search">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <div class="col-md-2" style="height: 85px;">
                                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('show-cart-product') }}">
                                                    <img src="{{ asset('/frontend/shopping-cart.png') }}" style="height: 50px; width: 50px; position: relative">
                                                    <sup class="badge badge-danger" id="totalItems" style="position: absolute; top: 24px; left: 0px;">{{ Cart::count() }}</sup>
                                                </a>
                                            </li>
                                            <li class="nav-item float-right">
                                                <a class="nav-link" href="#">
                                                    <b><span class="btn btn-sm btn-primary" style="background-color: #6E4FF6; color: white">Login</span></b>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</div>
