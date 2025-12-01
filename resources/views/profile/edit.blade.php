{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<!DOCTYPE html>
<html lang="bn" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>প্রোফাইল - BillingSoft Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .profile-img-hover {
            transition: all 0.3s ease;
        }
        .profile-img-hover:hover {
            transform: scale(1.05);
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="h-full">
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
            <a class="nav-link" href="#" onclick="showSection('inventory')">
                <i class="fas fa-warehouse"></i> স্টক ম্যানেজমেন্ট
            </a>
            <a class="nav-link" href="#" onclick="showSection('settings')">
                <i class="fas fa-cog"></i> সেটিংস
            </a>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <div class="px-3 py-2">
                <small class="text-white-50">দ্রুত অ্যাক্সেস</small>
            </div>
            <a class="nav-link" href="#" onclick="showBackupModal()">
                <i class="fas fa-database"></i> ব্যাকআপ
            </a>
            {{-- <a class="nav-link" href="#" onclick="showNotifications()">
                <i class="fas fa-bell"></i> নোটিফিকেশন
                <span class="notification-badge"></span>
            </a> --}}
        </nav>
    </div>
    <!-- Header/Navigation -->
    @include('frontend.layouts.header')
    @include('frontend.layouts.style')



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Profile Header Card -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl shadow-2xl overflow-hidden mb-8">
            <div class="p-8 sm:p-12">
                <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-6 sm:space-y-0 sm:space-x-8">
                    
                    <!-- Profile Image -->
                    <div class="relative group">
                        <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-2xl overflow-hidden profile-img-hover bg-white">
                            <img src="https://ui-avatars.com/api/?name=User+Name&size=200&background=667eea&color=fff&bold=true" 
                                 alt="Profile" class="w-full h-full object-cover" id="profileImage">
                        </div>
                        <label for="uploadPhoto" class="absolute bottom-2 right-2 bg-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg cursor-pointer hover:bg-gray-100 transition">
                            <i class="fas fa-camera text-indigo-600"></i>
                        </label>
                        <input type="file" id="uploadPhoto" class="hidden" accept="image/*" onchange="handleImageUpload(event)">
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center sm:text-left">
                        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-2" id="displayName"> {{ Auth::user()->name ?? 'ব্যবহারকারী' }}</h2>
                        <p class="text-indigo-100 text-lg mb-4" id="displayEmail"> {{ Auth::user()->email ?? 'ব্যবহারকারী' }}</p>
                        <div class="flex flex-wrap gap-3 justify-center sm:justify-start">
                            {{-- <span class="px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-semibold">
                                <i class="fas fa-briefcase mr-2"></i>ব্যবসার মালিক
                            </span> --}}
                            <span class="px-4 py-2 bg-white/20 backdrop-blur rounded-full text-white text-sm font-semibold">
                                <i class="fas fa-calendar-check mr-2"></i>যোগদান:  {{ Auth::user()->created_at ?? 'ব্যবহারকারী' }}
                            </span>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <button onclick="toggleEditMode()" class="px-6 py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-gray-100 transition shadow-lg">
                        <i class="fas fa-edit mr-2"></i>প্রোফাইল এডিট করুন
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
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

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Profile Details Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">ব্যক্তিগত তথ্য</h3>
                    
                    <form id="profileForm" onsubmit="saveProfile(event)">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user mr-2 text-indigo-600"></i>পূর্ণ নাম
                                </label>
    <input type="text" id="fullName" name="name" value="{{ $user->name ?? '' }}" disabled
           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-100">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-2 text-indigo-600"></i>মোবাইল নম্বর
                                </label>
    <input type="tel" id="phone" name="phone" value="{{ $user->phone ?? '' }}" disabled
           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-100">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-indigo-600"></i>ইমেইল
                                </label>
    <input type="tel" id="phone" name="phone" value="{{ $user->email ?? '' }}" disabled
           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-100">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-store mr-2 text-indigo-600"></i>ব্যবসার নাম
                                </label>
                                <input type="text" id="businessName" value="{{ $user->business_name ?? '' }}" disabled
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-100">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>ঠিকানা
                                </label>
                                <textarea id="address" rows="3" disabled
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 disabled:bg-gray-100">{{ $user->email ?? '' }}</textarea>
                            </div>
                        </div>

                        <div id="editButtons" class="hidden mt-6 flex gap-4">
                            <button type="submit" class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg transition">
                                <i class="fas fa-save mr-2"></i>সংরক্ষণ করুন
                            </button>
                            <button type="button" onclick="cancelEdit()" class="flex-1 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                                <i class="fas fa-times mr-2"></i>বাতিল
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Password Change Section -->
                {{-- <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 mt-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">পাসওয়ার্ড পরিবর্তন করুন</h3>
                    
                    <form onsubmit="changePassword(event)">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-indigo-600"></i>বর্তমান পাসওয়ার্ড
                                </label>
                                <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-key mr-2 text-indigo-600"></i>নতুন পাসওয়ার্ড
                                </label>
                                <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-check-circle mr-2 text-indigo-600"></i>নতুন পাসওয়ার্ড নিশ্চিত করুন
                                </label>
                                <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg transition">
                                <i class="fas fa-shield-alt mr-2"></i>পাসওয়ার্ড আপডেট করুন
                            </button>
                        </div>
                    </form>
                </div> --}}
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                
                <!-- Quick Actions -->
                {{-- <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">দ্রুত কাজ</h3>
                    <div class="space-y-3">
                        <button class="w-full text-left px-4 py-3 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition flex items-center">
                            <i class="fas fa-file-invoice text-indigo-600 mr-3"></i>
                            <span class="font-semibold text-gray-700">নতুন বিল তৈরি করুন</span>
                        </button>
                        <button class="w-full text-left px-4 py-3 bg-green-50 hover:bg-green-100 rounded-xl transition flex items-center">
                            <i class="fas fa-user-plus text-green-600 mr-3"></i>
                            <span class="font-semibold text-gray-700">নতুন গ্রাহক যোগ করুন</span>
                        </button>
                        <button class="w-full text-left px-4 py-3 bg-purple-50 hover:bg-purple-100 rounded-xl transition flex items-center">
                            <i class="fas fa-box-open text-purple-600 mr-3"></i>
                            <span class="font-semibold text-gray-700">পণ্য যোগ করুন</span>
                        </button>
                        <button class="w-full text-left px-4 py-3 bg-orange-50 hover:bg-orange-100 rounded-xl transition flex items-center">
                            <i class="fas fa-chart-line text-orange-600 mr-3"></i>
                            <span class="font-semibold text-gray-700">রিপোর্ট দেখুন</span>
                        </button>
                    </div>
                </div> --}}

                <!-- Recent Activity -->
                {{-- <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">সাম্প্রতিক কার্যক্রম</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3 pb-4 border-b">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-receipt text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">নতুন বিল তৈরি</p>
                                <p class="text-xs text-gray-500">২ ঘন্টা আগে</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 pb-4 border-b">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">পেমেন্ট গ্রহণ</p>
                                <p class="text-xs text-gray-500">৫ ঘন্টা আগে</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-check text-purple-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">নতুন গ্রাহক যোগ</p>
                                <p class="text-xs text-gray-500">১ দিন আগে</p>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Settings -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">সেটিংস</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-700">ইমেইল নোটিফিকেশন</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-700">SMS নোটিফিকেশন</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        let isEditMode = false;

        function toggleEditMode() {
            isEditMode = !isEditMode;
            const inputs = document.querySelectorAll('#profileForm input, #profileForm textarea');
            const editButtons = document.getElementById('editButtons');
            
            inputs.forEach(input => {
                input.disabled = !isEditMode;
            });

            if (isEditMode) {
                editButtons.classList.remove('hidden');
            } else {
                editButtons.classList.add('hidden');
            }
        }

        function cancelEdit() {
            toggleEditMode();
            // Reset form values here if needed
        }

        function saveProfile(event) {
            event.preventDefault();
            
            // Get form values
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            
            // Update display name
            document.getElementById('displayName').textContent = fullName;
            document.getElementById('displayEmail').textContent = email;
            
            toggleEditMode();
            
            alert('প্রোফাইল সফলভাবে আপডেট হয়েছে! ✓');
        }

        function changePassword(event) {
            event.preventDefault();
            alert('পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে! ✓');
        }

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function logout() {
            if (confirm('আপনি কি লগআউট করতে চান?')) {
                alert('লগআউট সফল হয়েছে!');
                // Add your logout logic here
            }
        }
    </script>

</body>
</html>
