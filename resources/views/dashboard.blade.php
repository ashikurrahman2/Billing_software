  @extends('frontend.app')

  @section('title', 'Dashboard')

  @section('content')
  
       <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <h4><i class="fas fa-receipt"></i> A to Z Billing</h4>
            <small>প্রফেশনাল বিলিং সিস্টেম</small>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                <i class="fas fa-home"></i> ড্যাশবোর্ড
            </a>
            {{-- <a class="nav-link" href="#" onclick="showSection('new-bill')">
                <i class="fas fa-plus-circle"></i> নতুন বিল
            </a> --}}
            <a class="nav-link" href="#" onclick="showSection('bills')">
                <i class="fas fa-file-invoice"></i> সকল বিল
            </a>
            <a class="nav-link" href="#" onclick="showSection('customers')">
                <i class="fas fa-users"></i> কাস্টমার
            </a>
            <a class="nav-link" href="#" onclick="showSection('products')">
                <i class="fas fa-box"></i> প্রোডাক্ট
            </a>
            <a class="nav-link" href="#" onclick="showSection('reports')">
                <i class="fas fa-chart-bar"></i> রিপোর্ট
            </a>
            <a class="nav-link" href="#" onclick="showSection('expenses')">
                <i class="fas fa-money-bill-wave"></i> খরচ ম্যানেজমেন্ট
            </a>
         
            {{-- <hr style="border-color: rgba(255,255,255,0.2);"> --}}
            {{-- <div class="px-3 py-2">
                <small class="text-white-50">দ্রুত অ্যাক্সেস</small>
            </div> --}}
            {{-- <a class="nav-link" href="#" onclick="showBackupModal()">
                <i class="fas fa-database"></i> ব্যাকআপ
            </a> --}}
            {{-- <a class="nav-link" href="#" onclick="showNotifications()">
                <i class="fas fa-bell"></i> নোটিফিকেশন
                <span class="notification-badge"></span>
            </a> --}}
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        {{-- <div class="top-navbar">
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
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> <span class="d-none d-md-inline">অ্যাডমিন</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> প্রোফাইল</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> সেটিংস</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt"></i> লগআউট</a></li>
                    </ul>
                </div>
            </div>
        </div> --}}

        <!-- Dashboard Section -->
        <div id="dashboard" class="content-section">
            {{-- <div class="d-flex justify-content-between align-items-center mb-4"> --}}
                <h4 class="mb-0">ড্যাশবোর্ড ওভারভিউ</h4>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>আজ</option>
                        <option>এই সপ্তাহ</option>
                        <option>এই মাস</option>
                        <option>এই বছর</option>
                    </select>
                    <button class="btn btn-sm btn-primary" onclick="exportData()">
                        <i class="fas fa-download"></i> এক্সপোর্ট
                    </button>
                </div>
            {{-- </div> --}}
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card blue">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">মোট বিক্রয়</h6>
                                <h3 class="mb-0">৳ {{ number_format($totalSales, 0) }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card green">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">মোট বিল</h6>
                                <h3 class="mb-0">{{ $totalBills }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card orange">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">কাস্টমার</h6>
                                <h3 class="mb-0">{{ $totalCustomers }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card red">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">বাকি</h6>
                                <h3 class="mb-0">৳ {{ number_format($totalDue, 0) }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Recent bill --}}
            <div class="row mt-4">
                <div class="col-lg-8 mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-chart-line"></i> সাম্প্রতিক বিল তালিকা</span>
                            <button class="btn btn-sm btn-primary" onclick="showSection('bills')">সব দেখুন</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>বিল নং</th>
                                            <th>কাস্টমার</th>
                                            <th>তারিখ</th>
                                            <th>পরিমাণ</th>
                                            <th>স্ট্যাটাস</th>
                                            <th>অ্যাকশন</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bills as $bill)
                                      <tr>
                                        <td>#{{ str_pad($bill->invoice_no, 3, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $bill->customer?->name ?? 'ওয়াক-ইন কাস্টমার' }}</td>
                                        <td>{{ date('d/m/Y', strtotime($bill->date)) }}</td>
                                        <td>৳ {{ number_format($bill->grand_total, 0) }}</td>

                                        <td>
                                            @if($bill->status == 'paid')
                                                <span class="badge bg-success">পরিশোধিত</span>
                                            @elseif($bill->status == 'partial')
                                                <span class="badge bg-warning text-dark">আংশিক</span>
                                            @elseif($bill->status == 'due')
                                                <span class="badge bg-danger">বাকি</span>
                                            @else
                                                <span class="badge bg-secondary">ড্রাফট</span>
                                            @endif
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-primary" onclick="viewBill({{ $bill->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="printBill({{ $bill->id }})">
                                                <i class="fas fa-print"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success" onclick="shareBill({{ $bill->id }})">
                                                <i class="fas fa-share-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-tasks"></i> দ্রুত অ্যাকশন
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" onclick="showSection('new-bill')">
                                    <i class="fas fa-plus"></i> নতুন বিল তৈরি করুন
                                </button>
                                <button class="btn btn-success" onclick="showAddCustomerModal()">
                                    <i class="fas fa-user-plus"></i> নতুন কাস্টমার
                                </button>
                                <button class="btn btn-info" onclick="showAddProductModal()">
                                    <i class="fas fa-box"></i> প্রোডাক্ট যোগ করুন
                                </button>
                                <button class="btn btn-warning" onclick="exportData()">
                                    <i class="fas fa-file-export"></i> রিপোর্ট ডাউনলোড
                                </button>
                            </div>
                            
                            <hr class="my-3">
                            
                            <h6 class="mb-3"><i class="fas fa-calendar-day"></i> আজকের সারসংক্ষেপ</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success"></i> ১২টি বিল তৈরি হয়েছে
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-money-bill text-info"></i> ৳ ৩৫,০০০ আদায় হয়েছে
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-user-plus text-primary"></i> ৫ জন নতুন কাস্টমার
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-exclamation-circle text-danger"></i> ৩টি বিল বাকি আছে
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-history"></i> সাম্প্রতিক কার্যকলাপ
                        </div>
                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                            <div class="activity-item">
                                <small class="text-muted">২ মিনিট আগে</small>
                                <p class="mb-0"><strong>নতুন বিল</strong> তৈরি করা হয়েছে #INV-001</p>
                            </div>
                            <div class="activity-item">
                                <small class="text-muted">১৫ মিনিট আগে</small>
                                <p class="mb-0"><strong>পেমেন্ট গ্রহণ</strong> করা হয়েছে ৳ ৫,৫০০</p>
                            </div>
                            <div class="activity-item">
                                <small class="text-muted">১ ঘন্টা আগে</small>
                                <p class="mb-0"><strong>নতুন কাস্টমার</strong> যোগ করা হয়েছে</p>
                            </div>
                            <div class="activity-item">
                                <small class="text-muted">২ ঘন্টা আগে</small>
                                <p class="mb-0"><strong>প্রোডাক্ট স্টক</strong> আপডেট করা হয়েছে</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Bill Section -->
        <div id="new-bill" class="content-section" style="display:none;">
            <h4 class="mb-4"><i class="fas fa-plus-circle"></i> নতুন বিল তৈরি করুন</h4>
            
            <div class="card">
                <div class="card-body">
                    <form id="billForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">বিল নম্বর</label>
                                <input type="text" class="form-control" value="#INV-005" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">তারিখ</label>
                                <input type="date" class="form-control" value="2025-11-27">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">কাস্টমার নির্বাচন করুন</label>
                                <div class="input-group">
                                    <select class="form-select" id="customerSelect">
                                        <option>কাস্টমার নির্বাচন করুন</option>
                                        <option>রহিম আহমেদ</option>
                                        <option>করিম মিয়া</option>
                                        <option>সালমা খাতুন</option>
                                    </select>
                                    <button class="btn btn-outline-success" type="button" onclick="showAddCustomerModal()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">পেমেন্ট মেথড</label>
                                <select class="form-select">
                                    <option>ক্যাশ</option>
                                    <option>বিকাশ</option>
                                    <option>নগদ</option>
                                    <option>ব্যাংক ট্রান্সফার</option>
                                    <option>কার্ড</option>
                                </select>
                            </div>
                        </div>
                        
                        <h5 class="mt-4 mb-3">পণ্য তথ্য</h5>
                        <div class="table-responsive">
                            <table class="table" id="productTable">
                                <thead class="table-light">
                                    <tr>
                                        <th width="35%">পণ্য</th>
                                        <th width="15%">পরিমাণ</th>
                                        <th width="20%">মূল্য</th>
                                        <th width="20%">মোট</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody id="productRows">
                                    <tr>
                                        <td>
                                            <select class="form-select">
                                                <option>পণ্য নির্বাচন করুন</option>
                                                <option>চাল (কেজি)</option>
                                                <option>ডাল (কেজি)</option>
                                                <option>তেল (লিটার)</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" value="1" min="1" onchange="calculateRow(this)">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" placeholder="০" onchange="calculateRow(this)">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control row-total" readonly value="০">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <button type="button" class="btn btn-secondary mb-3" onclick="addProductRow()">
                            <i class="fas fa-plus"></i> আরও পণ্য যোগ করুন
                        </button>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">নোট (ঐচ্ছিক)</label>
                                    <textarea class="form-control" rows="3" placeholder="বিশেষ নির্দেশনা বা মন্তব্য..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <td><strong>সাবটোটাল:</strong></td>
                                        <td class="text-end" id="subtotal">৳ ০</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>ভ্যাট:</strong>
                                            <input type="number" class="form-control form-control-sm d-inline-block" style="width: 60px;" value="5" min="0" onchange="calculateTotal()"> %
                                        </td>
                                        <td class="text-end" id="vat">৳ ০</td>
                                    </tr>
                                    <tr>
                                        <td><strong>ডিসকাউন্ট:</strong></td>
                                        <td class="text-end">
                                            <input type="number" class="form-control form-control-sm" value="0" id="discount" onchange="calculateTotal()">
                                        </td>
                                    </tr>
                                    <tr class="table-primary">
                                        <td><strong>সর্বমোট:</strong></td>
                                        <td class="text-end"><strong id="grandTotal">৳ ০</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 justify-content-end mt-4 flex-wrap">
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">বাতিল করুন</button>
                            <button type="submit" class="btn btn-primary" onclick="saveBill(event)">বিল সংরক্ষণ করুন</button>
                            <button type="button" class="btn btn-success" onclick="saveAndPrint(event)">সংরক্ষণ ও প্রিন্ট</button>
                            <button type="button" class="btn btn-info" onclick="saveAndShare(event)">সংরক্ষণ ও শেয়ার</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- All Bill sections -->
        <div id="bills" class="content-section" style="display:none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="fas fa-file-invoice"></i> সকল বিল</h4>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" placeholder="বিল খুঁজুন..." style="width: 200px;">
                    <select class="form-select" style="width: 150px;">
                        <option>সব স্ট্যাটাস</option>
                        <option>পরিশোধিত</option>
                        <option>অপেক্ষমাণ</option>
                        <option>বাকি</option>
                    </select>
                    <button class="btn btn-primary" onclick="showSection('new-bill')">
                        <i class="fas fa-plus"></i> নতুন বিল
                    </button>
                </div>
            </div>
           <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
                        <th>বিল নং</th>
                        <th>কাস্টমার</th>
                        <th>তারিখ</th>
                        <th>পরিমাণ</th>
                        <th>পেমেন্ট মেথড</th>
                        <th>স্ট্যাটাস</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bills as $bill)
                        <tr>
                            <td><input type="checkbox" class="form-check-input bill-checkbox"></td>
                            <td>
                                <strong>#{{ str_pad($bill->invoice_no, 3, '0', STR_PAD_LEFT) }}</strong>
                            </td>
                            <td>{{ $bill->customer?->name ?? 'ওয়াক-ইন কাস্টমার' }}</td>
                            <td>{{ $bill->date }}</td>
                            <td><strong>৳ {{ number_format($bill->grand_total, 0) }}</strong></td>
                            <td>
                                @php
                                    $method = match($bill->payment_method) {
                                        'cash'  => 'ক্যাশ',
                                        'bkash' => 'বিকাশ',
                                        'nagad' => 'নগদ',
                                        'bank'  => 'ব্যাংক',
                                        default => ucfirst($bill->payment_method)
                                    };
                                @endphp
                                <span class="text-muted">{{ $method }}</span>
                            </td>
                            <td>
                                @switch($bill->status)
                                    @case('paid')
                                        <span class="badge bg-success">পরিশোধিত</span>
                                        @break
                                    @case('partial')
                                        <span class="badge bg-warning text-dark">আংশিক</span>
                                        @break
                                    @case('due')
                                        <span class="badge bg-danger">বাকি</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">ড্রাফট</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-primary" onclick="viewBill({{ $bill->id }})" title="দেখুন">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-info text-white" onclick="printBill({{ $bill->id }})" title="প্রিন্ট">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button class="btn btn-warning" onclick="editBill({{ $bill->id }})" title="এডিট">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger" onclick="deleteBill({{ $bill->id }})" title="ডিলিট">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-2x mb-3"></i><br>
                                কোনো বিল পাওয়া যায়নি
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Laravel Pagination -->
        <div class="mt-4">
            {{ $bills->links() }}
        </div>

        <!-- পেজ ইনফো (অপশনাল, সুন্দর লাগে) -->
        <div class="text-muted small mt-2 text-end">
            মোট {{ $bills->total() }} টি বিলের মধ্যে {{ $bills->firstItem() }} থেকে {{ $bills->lastItem() }} পর্যন্ত দেখছেন
        </div>
    </div>
</div>

<!-- Select All Checkbox JS -->
<script>
    document.getElementById('selectAll')?.addEventListener('change', function() {
        document.querySelectorAll('.bill-checkbox').forEach(cb => cb.checked = this.checked);
    });
</script>
        </div>
       {{-- Customer management --}}
        <div id="customers" class="content-section" style="display:none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="fas fa-users"></i> কাস্টমার ম্যানেজমেন্ট</h4>
                <button class="btn btn-primary" onclick="showAddCustomerModal()">
                    <i class="fas fa-user-plus"></i> নতুন কাস্টমার
                </button>
            </div>

            {{-- Customer management section --}}
         <div class="row g-4">
        @forelse($customers as $customer)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift transition">
                    <div class="card-body text-center p-4">

                        <!-- প্রোফাইল আইকন -->
                        <div class="mb-4">
                            <i class="fas fa-user-circle fa-5x text-primary opacity-75"></i>
                        </div>

                        <!-- নাম ও ফোন -->
                        <h5 class="mb-1 fw-bold">{{ $customer->name }}</h5>
                        <p class="text-muted mb-1">
                            <i class="fas fa-phone-alt me-1"></i>
                            {{ $customer->phone ?? 'নাম্বার নেই' }}
                        </p>
                        <p class="text-muted small mb-4">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            {{ Str::limit($customer->address ?? 'ঠিকানা নেই', 40) }}
                        </p>

                        <!-- বিল ও মোট টাকা -->
                        <div class="row text-center mb-4">
                            <div class="col-6 border-end">
                                <h4 class="mb-0 text-primary fw-bold">
                                   {{ $customer->total_bills }}
                                </h4>
                                <small class="text-muted">বিল</small>
                            </div>
                            <div class="col-6">
                                <h4 class="mb-0 text-success fw-bold">
                                    ৳ {{ number_format($customer->bills_sum_grand_total, 0) }}
                                </h4>
                                <small class="text-muted">মোট</small>
                            </div>
                        </div>

                        <!-- অ্যাকশন বাটন -->
                        {{-- <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-outline-primary btn-sm" 
                                    onclick="viewCustomer({{ $customer->id }})"
                                    title="দেখুন">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" 
                                    onclick="deleteCustomer({{ $customer->id }})"
                                    title="ডিলিট">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div> --}}

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">কোনো কাস্টমার পাওয়া যায়নি</h4>
                    <p class="text-muted">এখনো কোনো কাস্টমার যোগ করা হয়নি</p>
                    <button class="btn btn-primary mt-3" onclick="showSection('new-customer')">
                        <i class="fas fa-plus"></i> প্রথম কাস্টমার যোগ করুন
                    </button>
                </div>
            </div>
        @endforelse
    </div>

</div>



<!-- Hover Effect CSS (অপশনাল কিন্তু সুন্দর লাগে) -->
<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
</style>
        </div>
        {{-- Product management --}}
        <div id="products" class="content-section" style="display:none;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><i class="fas fa-box"></i> প্রোডাক্ট ম্যানেজমেন্ট</h4>
          
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                 <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>প্রোডাক্ট নাম</th>
                            <th>ক্যাটাগরি</th>
                            <th>মূল্য</th>
                            <th>একক</th>
                            <th>স্টক</th>
                            <th>স্ট্যাটাস</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td>৳{{ number_format($product->price) }}</td>
                                <td>{{$product->unit }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->stock > 50 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                                        {{ $product->stock }} 
                                    </span>
                                </td>
                                <td>
                                    @if($product->stock > 50)
                                        <span class="badge bg-success">স্টকে আছে</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-warning">কম স্টক</span>
                                    @else
                                        <span class="badge bg-danger">স্টক শেষ</span>
                                    @endif
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    কোনো প্রোডাক্ট পাওয়া যায়নি
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                    @if($products->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $products->links() }}
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Report Section --}}
     <div id="reports" class="content-section" style="display:none;">
    <h4 class="mb-4 text-2xl font-bold text-primary">
        <i class="fas fa-chart-bar"></i> রিপোর্ট ও বিশ্লেষণ
    </h4>

    <!-- তারিখ ফিল্টার (শুধু দেখানোর জন্য) -->
    <div class="card mb-4 shadow">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-bold">শুরুর তারিখ</label>
                    <input type="date" id="startDate" class="form-control" value="2025-01-01">
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold">শেষের তারিখ</label>
                    <input type="date" id="endDate" class="form-control" value="2025-11-30">
                </div>
                <div class="col-md-2">
                    <button onclick="loadReports()" class="btn btn-primary w-100">
                        <i class="fas fa-sync"></i> লোড করুন
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- রিপোর্ট দেখানোর জায়গা -->
    <div id="reportContent" class="row g-4"></div>

    <!-- ডাউনলোড বাটন -->
    <div class="card mt-4 shadow" id="exportSection" style="display:none;">
        <div class="card-header bg-dark text-white">রিপোর্ট ডাউনলোড করুন</div>
        <div class="card-body">
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <button onclick="alert('এক্সেল ফাইল ডাউনলোড হচ্ছে...')" class="btn btn-success btn-lg w-100">
                        <i class="fas fa-file-excel"></i><br>এক্সেল
                    </button>
                </div>
                <div class="col-6 col-md-3">
                    <button onclick="alert('পিডিএফ তৈরি হচ্ছে...')" class="btn btn-danger btn-lg w-100">
                        <i class="fas fa-file-pdf"></i><br>পিডিএফ
                    </button>
                </div>
                <div class="col-6 col-md-3">
                    <button onclick="alert('সিএসভি ফাইল ডাউনলোড হচ্ছে...')" class="btn btn-info btn-lg w-100">
                        <i class="fas fa-file-csv"></i><br>সিএসভি
                    </button>
                </div>
                <div class="col-6 col-md-3">
                    <button onclick="window.print()" class="btn btn-secondary btn-lg w-100">
                        <i class="fas fa-print"></i><br>প্রিন্ট
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- চার্ট লাইব্রেরি -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ডামি ডাটা (তুমি যখন ডাটাবেস বানাবে তখন এটা বদলে দিবে)
const dummyData = {
    sales: {
        labels: ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট'],
        data: [120000, 190000, 300000, 250000, 400000, 380000, 450000, 520000]
    },
    payment: {
        labels: ['নগদ', 'বিকাশ', 'নগদ', 'রকেট', 'কার্ড'],
        data: [45, 30, 15, 8, 2]
    },
    topProducts: {
        labels: ['চাল ৫০কেজি', 'ডাল ১কেজি', 'তেল ৫লিটার', 'চিনি ১কেজি', 'লবণ ১কেজি'],
        data: [850, 620, 480, 390, 320]
    },
    topCustomers: [
        {name: "রহিম মিয়া", total: 285000},
        {name: "করিম সাহেব", total: 242000},
        {name: "জাহিদ হোসেন", total: 198000},
        {name: "সোহেল রানা", total: 175000},
        {name: "আলমগীর হোসেন", total: 162000}
    ]
};

function loadReports() {
    // লোডিং দেখাও
    document.getElementById('reportContent').innerHTML = `
        <div class="col-12 text-center py-5">
            <h4 class="text-primary">রিপোর্ট লোড হচ্ছে...</h4>
        </div>
    `;

    // ১ সেকেন্ড পর ডামি ডাটা দেখাও (যেন রিয়েল মনে হয়)
    setTimeout(() => {
        const d = dummyData;

        document.getElementById('reportContent').innerHTML = `
            <!-- মাসিক বিক্রয় -->
            <div class="col-lg-6">
                <div class="card shadow h-100">
                    <div class="card-header bg-primary text-white">মাসিক বিক্রয় রিপোর্ট</div>
                    <div class="card-body">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- পেমেন্ট মেথড -->
            <div class="col-lg-6">
                <div class="card shadow h-100">
                    <div class="card-header bg-success text-white">পেমেন্ট মেথড বিতরণ</div>
                    <div class="card-body">
                        <canvas id="paymentChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- টপ প্রোডাক্ট -->
            <div class="col-lg-7">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">টপ ৫ বিক্রিত প্রোডাক্ট</div>
                    <div class="card-body">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- টপ কাস্টমার -->
            <div class="col-lg-5">
                <div class="card shadow h-100">
                    <div class="card-header bg-warning text-dark">টপ ৫ কাস্টমার</div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <tbody>
                                ${d.topCustomers.map((c,i) => `
                                    <tr>
                                        <td><strong>${i+1}</strong></td>
                                        <td>${c.name}</td>
                                        <td class="text-end fw-bold">৳${c.total.toLocaleString()}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;

        // চার্টগুলো তৈরি করো
        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: { labels: d.sales.labels, datasets: [{ label: 'বিক্রয় (টাকা)', data: d.sales.data, borderColor: '#4361ee', backgroundColor: 'rgba(67,97,238,0.1)', fill: true, tension: 0.4 }] },
            options: { responsive: true }
        });

        new Chart(document.getElementById('paymentChart'), {
            type: 'doughnut',
            data: { labels: d.payment.labels, datasets: [{ data: d.payment.data, backgroundColor: ['#2ecc71','#3498db','#f1c40f','#e74c3c','#9b59b6'] }] },
            options: { responsive: true }
        });

        new Chart(document.getElementById('topProductsChart'), {
            type: 'bar',
            data: { labels: d.topProducts.labels, datasets: [{ label: 'বিক্রি (পিস)', data: d.topProducts.data, backgroundColor: '#17a2b8' }] },
            options: { indexAxis: 'y', responsive: true }
        });

        // এক্সপোর্ট বাটন দেখাও
        document.getElementById('exportSection').style.display = 'block';

    }, 800);
}

// পেজ লোড হলেই রিপোর্ট দেখাও
window.addEventListener('load', loadReports);
</script>

<style>
@media print {
    body > *:not(#reports) { display: none !important; }
    #reports { display: block !important; position: absolute; top: 0; left: 0; width: 100%; }
}
</style>

  <div id="expenses" class="content-section" style="display:none;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-money-bill-wave text-success me-2"></i> খরচ ম্যানেজমেন্ট
        </h4>
        {{-- <button class="btn btn-primary shadow-sm px-4" @click="openModal()">
            <i class="fas fa-plus"></i> নতুন খরচ যোগ করুন
        </button> --}}
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Total Expense Card -->
    {{-- <div class="card border-0 shadow-sm mb-4"> --}}
        <div class="card-body bg-gradient-danger text-white rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-2 opacity-90">মোট খরচ</h5>
                    <h2 class="mb-0 fw-bold">৳ {{ number_format($totalExpenses ?? 0) }}</h2>
                    <small class="opacity-80">{{ $expenses->total() ?? 0 }} টি রেকর্ড</small>
                </div>
                <i class="fas fa-wallet fa-4x opacity-50"></i>
            </div>
        </div>
    {{-- </div> --}}

    <!-- Search & Filter -->
    <div class="card border-0 shadow-sm mb-4" x-data="{ search: '', category: '' }">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-8">
                    <input type="text" class="form-control form-control-lg rounded-pill" 
                           placeholder="শিরোনাম দিয়ে খুঁজুন..." x-model.debounce.500ms="search">
                </div>
                <div class="col-lg-4">
                    <select class="form-select form-select-lg rounded-pill" x-model="category">
                        <option value="">সব ক্যাটাগরি</option>
                        <option value="food">খাবার</option>
                        <option value="transport">যাতায়াত</option>
                        <option value="shopping">কেনাকাটা</option>
                        <option value="bills">বিল</option>
                        <option value="entertainment">বিনোদন</option>
                        <option value="health">স্বাস্থ্য</option>
                        <option value="other">অন্যান্য</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Expense Table -->
    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">তারিখ</th>
                            <th>শিরোনাম</th>
                            <th>ক্যাটাগরি</th>
                            <th class="text-end pe-4">পরিমাণ</th>
                            <th class="text-center">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                            <tr x-show="
                                '{{ addslashes($expense->title) }}'.toLowerCase().includes(search.toLowerCase()) &&
                                (!category || '{{ $expense->category }}' === category)
                            ">
                                <td class="ps-4 text-muted fw-medium">
                                    {{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}
                                </td>
                                <td class="fw-bold text-dark">{{ $expense->title }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 text-white
                                        @if($expense->category == 'food') bg-danger
                                        @elseif($expense->category == 'transport') bg-warning text-dark
                                        @elseif($expense->category == 'shopping') bg-info
                                        @elseif($expense->category == 'bills') bg-primary
                                        @elseif($expense->category == 'entertainment') bg-pink
                                        @elseif($expense->category == 'health') bg-success
                                        @else bg-secondary @endif">
                                        {{ __("{$expense->category}") == $expense->category ? ucfirst($expense->category) : __("{$expense->category}") }}
                                        {{ $expense->category == 'other' ? 'অন্যান্য' : '' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4 fw-bold text-danger fs-5">
                                    ৳ {{ number_format($expense->amount) }}
                                </td>
                                <td class="text-center">
                                    {{-- <button @click="edit({!! $expense->toJson() !!})" 
                                            class="btn btn-sm btn-outline-warning rounded-circle" title="এডিট">
                                        <i class="fas fa-edit"></i>
                                    </button> --}}
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('নিশ্চিত করে মুছবেন?')"
                                                class="btn btn-sm btn-outline-danger rounded-circle ms-2" title="ডিলিট">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-receipt fa-4x text-muted mb-3"></i>
                                    <p class="text-muted">কোনো খরচ যোগ করা হয়নি</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="card-footer bg-white border-top-0">
                {{ $expenses->links() }}
            </div>
        </div>
    </div>

    <!-- Modal - Auto Open হবে না (গ্যারান্টি) -->
    <div x-data="expenseModal()" 
         x-show="open" 
         x-transition.opacity 
         class="modal fade" 
         style="display: none;"
         :style="open ? 'display: block; background: rgba(0,0,0,0.6);' : 'display: none;'"
         @keydown.escape.window="open = false"
         role="dialog">

        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        <span x-text="editing ? 'খরচ সম্পাদনা করুন' : 'নতুন খরচ যোগ করুন'"></span>
                    </h5>
                    <button @click="open = false" class="btn-close btn-close-white"></button>
                </div>

                <form :action="editing ? '/expenses/' + form.id : '/expenses'" method="POST">
                    @csrf
                    @if($editing ?? false) @method('PUT') @endif

                    <div class="modal-body py-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">শিরোনাম <span class="text-danger">*</span></label>
                                <input type="text" name="title" x-model="form.title" required 
                                       class="form-control form-control-lg rounded-pill" placeholder="যেমন: অফিসের লাঞ্চ">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">তারিখ <span class="text-danger">*</span></label>
                                <input type="date" name="date" x-model="form.date" required 
                                       class="form-control form-control-lg rounded-pill">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">পরিমাণ <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-white fw-bold">৳</span>
                                    <input type="number" step="0.01" name="amount" x-model="form.amount" required 
                                           class="form-control form-control-lg" placeholder="500">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">ক্যাটাগরি <span class="text-danger">*</span></label>
                                <select name="category" x-model="form.category" required class="form-select form-select-lg rounded-pill">
                                    <option value="food">খাবার</option>
                                    <option value="transport">যাতায়াত</option>
                                    <option value="shopping">কেনাকাটা</option>
                                    <option value="bills">বিল</option>
                                    <option value="entertainment">বিনোদন</option>
                                    <option value="health">স্বাস্থ্য</option>
                                    <option value="other">অন্যান্য</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">বিবরণ (ঐচ্ছিক)</label>
                                <textarea name="description" x-model="form.description" rows="3" 
                                          class="form-control rounded-3" placeholder="বিস্তারিত লিখুন..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" @click="open = false" class="btn btn-secondary btn-lg px-5 rounded-pill">
                            বাতিল
                        </button>
                        <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow">
                            <span x-text="editing ? 'আপডেট করুন' : 'যোগ করুন'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alpine.js Script -->
    <script>
        function expenseModal() {
            return {
                open: false,
                editing: false,
                form: {
                    id: '',
                    title: '',
                    amount: '',
                    date: new Date().toISOString().split('T')[0],
                    category: 'other',
                    description: ''
                },
                openModal() {
                    this.editing = false;
                    this.form = {
                        id: '', title: '', amount: '', date: new Date().toISOString().split('T')[0],
                        category: 'other', description: ''
                    };
                    this.open = true;
                },
                edit(expense) {
                    this.editing = true;
                    this.form = {
                        id: expense.id,
                        title: expense.title,
                        amount: expense.amount,
                        date: expense.date,
                        category: expense.category || 'other',
                        description: expense.description || ''
                    };
                    this.open = true;
                }
            }
        }
    </script>
</div>

<!-- Alpine.js CDN (শুধু একবার লোড করুন পুরো প্রজেক্টে) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

     
        
        
        {{-- <div id="settings" class="content-section" style="display:none;">
            <h4 class="mb-4"><i class="fas fa-cog"></i> সেটিংস</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">ব্যবসার তথ্য</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">ব্যবসার নাম</label>
                                <input type="text" class="form-control" value="A to Z স্টোর">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ঠিকানা</label>
                                <textarea class="form-control" rows="2">ঢাকা, বাংলাদেশ</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ফোন নম্বর</label>
                                <input type="text" class="form-control" value="০১৭১২-৩৪৫৬৭৮">
                            </div>
                            <button class="btn btn-primary">সংরক্ষণ করুন</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">বিল সেটিংস</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">বিল প্রিফিক্স</label>
                                <input type="text" class="form-control" value="INV-">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ডিফল্ট ভ্যাট (%)</label>
                                <input type="number" class="form-control" value="5">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">মুদ্রা</label>
                                <select class="form-select">
                                    <option>BDT (৳)</option>
                                    <option>USD ($)</option>
                                </select>
                            </div>
                            <button class="btn btn-primary">সংরক্ষণ করুন</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
     @endsection