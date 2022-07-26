<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}"><strong>{{ \App\Models\ShopSettings::find(1)->text_logo}}</strong> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                {{ request()->is('add_transaction_user') ? 'active' : '' }}
                {{ request()->is('transactions_list_user') ? 'active' : '' }}

                " href="{{ route('add_transaction_user') }}">Transactions</a>
            </li>           
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle 
                {{ request()->is('user_profile_user') ? 'active' : '' }}
                
                " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> {{ Auth()->user()->username }}</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 0;">
                    <li><a class="dropdown-item" href="{{ route('user_profile_user') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>

                    <li><a class="dropdown-item" href="{{ route('logout_user') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
        </div>
    </div>
</nav>