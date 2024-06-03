<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="{{ asset('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="50"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                {{ request()->is('add_transaction') ? 'active' : '' }}
                {{ request()->is('transactions_list') ? 'active' : '' }}

                " href="{{ route('add_transaction') }}">Invoice</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                {{ request()->is('add_payment') ? 'active' : '' }}
                {{ request()->is('payments_list') ? 'active' : '' }}

                " href="{{ route('payments_list') }}">Payment</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                {{ request()->is('receivables_list') ? 'active' : '' }}
                {{ request()->is('add_receivable') ? 'active' : '' }}
                {{ request()->is('show_receivable*') ? 'active' : '' }}

                " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Inventory</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 0;">
                    <li><a class="dropdown-item" href="{{ route('receivables_list') }}">Receivables</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('customers') }}">Requisition</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link
                {{ request()->is('income_exp_list') ? 'active' : '' }}
                {{ request()->is('add_income_exp') ? 'active' : '' }}

                " href="{{ route('income_exp_list') }}">Income & Exp</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                {{ request()->is('products_list') ? 'active' : '' }}
                {{ request()->is('price_product') ? 'active' : '' }}
                {{ request()->is('restock_product') ? 'active' : '' }}
                {{ request()->is('product_restock_history') ? 'active' : '' }}
                {{ request()->is('product_price_history') ? 'active' : '' }}

                " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 0;">
                    <li><a class="dropdown-item" href="{{ route('products_list') }}">Product List</a></li>
                    <li><a class="dropdown-item" href="{{ route('price_product') }}">Reprice Product</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('restock_product') }}">Restock Product</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                {{ request()->is('suppliers_list') ? 'active' : '' }}
                {{ request()->is('customers') ? 'active' : '' }}

                " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Customers</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 0;">
                    <li><a class="dropdown-item" href="{{ route('suppliers_list') }}">Suppliers</a></li>
                    {{-- <li><a class="dropdown-item" href="{{ route('price_product') }}">Reprice Product</a></li> --}}
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('customers') }}">Customers</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
                {{ request()->is('users_list') ? 'active' : '' }}
                {{ request()->is('user_profile') ? 'active' : '' }}
                {{ request()->is('register') ? 'active' : '' }}

                " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> {{ Auth()->user()->username }}</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 0;">
                    <li><a class="dropdown-item" href="{{ route('user_profile') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('users_list') }}">Users</a></li>
                    <li><hr class="dropdown-divider"></li>
                    @if (Auth()->user()->username == "sam119")
                        <li><a class="dropdown-item" href="{{ route('shop_setup') }}">Shop Setup</a></li>
                    @endif

                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
        </div>
    </div>
</nav>
