<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>

        <li>
            <a href="{{ route('admin') }}" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span key="t-chat">Dashboards</span>
            </a>
        </li>

        <li class="menu-title" key="t-apps">Apps</li>      

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-list-ul"></i>
                <span key="t-ecommerce">Customer</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('customer.create') }}" key="t-products">Create</a></li>
                <li><a href="{{ route('customer.index') }}" key="t-product-detail">Table</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-list-ul"></i>
                <span key="t-ecommerce">Item</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('product.create') }}" key="t-products">Create</a></li>
                <li><a href="{{ route('product.index') }}" key="t-product-detail">Table</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-list-ul"></i>
                <span key="t-ecommerce">Invoice</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('invoice.create') }}" key="t-products">Create</a></li>
                <li><a href="{{ route('invoice.index') }}" key="t-product-detail">Table</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-list-ul"></i>
                <span key="t-ecommerce">Tax</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @php
                    $tax = App\Models\Tax::pluck('id')->count();
                @endphp
                  
                @if ($tax > 0 && $tax < 1)
                <li><a href="{{ route('tax.create') }}" key="t-products">Create</a></li>
                @endif
                <li><a href="{{ route('tax.index') }}" key="t-product-detail">Table</a></li>
            </ul>
        </li>

    </ul>
</div>