<nav class="navbar navbar-light bg-faded m-b-30 p-10">
    <div class="row">
        <div class="d-inline-block">
            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('purchase-orders')}}"><i class="icofont icofont-tasks"></i> Purchase Orders</a>
            <a href="{{ route('suppliers') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-cart-alt"></i> Suppliers</a>
        </div>
    </div>
    <div class="nav-item nav-grid">
        <a href="{{route('suppliers')}}" class="btn btn-warning btn-mini waves-effect waves-light"><i class="icofont icofont-tasks mr-2"></i>All Suppliers</a>
        <a href="{{route('new-supplier')}}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-plus mr-2"></i>Add New Supplier</a>
    </div>
</nav>
