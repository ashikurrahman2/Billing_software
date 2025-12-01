 <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <button class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="search-box d-none d-md-block">
                <i class="fas fa-search"></i>
                <input type="text" class="form-control" placeholder="বিল, কাস্টমার বা প্রোডাক্ট খুঁজুন..." style="width: 300px;">
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative">
                    <button class="btn btn-light" onclick="showNotifications()">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </button>
                </div>
            <div class="dropdown">
    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user-circle"></i> 
        <span class="d-none d-md-inline">
            @auth('web')
                {{ Auth::guard('web')->user()->name }}
            @else
                অতিথি
            @endauth
        </span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item disabled" href="#">
                <small class="text-muted">{{ Auth::guard('web')->user()->email }}</small>
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> প্রোফাইল</a></li>
        <li><a class="dropdown-item" href="{{ route('password.change') }}"><i class="fas fa-user"></i> পাসওয়ার্ড পরিবর্তন</a></li>
        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> সেটিংস</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; cursor: pointer; width: 100%; text-align: left; padding: 0.25rem 1rem;">
                    <i class="fas fa-sign-out-alt"></i> লগআউট
                </button>
            </form>
        </li>
    </ul>
</div>
            </div>
        </div>
 </div>