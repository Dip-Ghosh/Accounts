<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">

            <!--Product Type-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Product Type</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('productType.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('productType.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>

            <!-- Product -->
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-pause"></i>
                    <span>Product </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('product.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('product.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>

            <!-- Supplier -->
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-user"></i>
                    <span>Supplier </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('supplier.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('supplier.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>

            <!-- customer -->
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-user"></i>
                    <span>Customer </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('customer.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('customer.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>

            <!--Store In-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-hourglass"></i>
                    <span>Store In </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('storeIn.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('storeIn.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>

            <!--Store out-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-hourglass-o"></i>
                    <span>Store Out </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('storeOut.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('storeOut.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>

            <!--waste out-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-trash"></i>
                    <span>Waste </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('waste.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('waste.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
