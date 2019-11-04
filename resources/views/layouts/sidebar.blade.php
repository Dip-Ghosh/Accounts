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

            <!--Company Type-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Company</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('company.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('company.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

                </ul>
            </li>


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

            <!--Income year-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Income Year</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('income.create')}}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{route('income.index')}}"><i class="fa fa-circle-o"></i> List</a></li>

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

            <!--report-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-trash"></i>
                    <span>Report </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('report.index')}}"><i class="fa fa-pie-chart"></i> Store Status Report</a></li>
                    <li><a href="{{route('report.date')}}"><i class="fa fa-pie-chart"></i> Date Wise Report</a></li>
                    <li><a href="{{route('report.supplier')}}"><i class="fa fa-circle-o"></i> Supplier Wise Report</a></li>

                </ul>
            </li>

            <!--sub section for -->
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-windows"></i>
                    <span>Others </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <!-- Group ladger-->
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-trash"></i>
                            <span>Group  Ledger</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('ledger.create')}}"><i class="fa fa-pie-chart"></i> Add</a></li>
                            <li><a href="{{route('ledger.index')}}"><i class="fa fa-pie-chart"></i> List</a></li>


                        </ul>
                    </li>

                    <!--sub Group ladger-->
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-trash"></i>
                            <span>Sub Group  Ledger </span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('subledger.create')}}"><i class="fa fa-pie-chart"></i> Add</a></li>
                            <li><a href="{{route('subledger.index')}}"><i class="fa fa-pie-chart"></i> List</a></li>


                        </ul>
                    </li>

                    <!--control legger Group ladger-->
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-trash"></i>
                            <span>Control Ledger </span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('controlLedger.create')}}"><i class="fa fa-pie-chart"></i> Add</a></li>
                            <li><a href="{{route('controlLedger.index')}}"><i class="fa fa-pie-chart"></i> List</a></li>


                        </ul>
                    </li>

                </ul>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
