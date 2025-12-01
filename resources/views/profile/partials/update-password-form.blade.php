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
<div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 mt-8">
    <h3 class="text-2xl font-bold text-gray-900 mb-6">পাসওয়ার্ড পরিবর্তন করুন</h3>
    
    @if (session('status') === 'password-updated')
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
            <i class="fas fa-check-circle mr-2"></i>পাসওয়ার্ড সফলভাবে আপডেট হয়েছে!
        </div>
    @endif

    @if ($errors->updatePassword->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->updatePassword->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 text-indigo-600"></i>বর্তমান পাসওয়ার্ড
                </label>
                <input 
                    type="password" 
                    name="current_password"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('current_password', 'updatePassword') border-red-500 @enderror">
                @error('current_password', 'updatePassword')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-key mr-2 text-indigo-600"></i>নতুন পাসওয়ার্ড
                </label>
                <input 
                    type="password" 
                    name="password"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('password', 'updatePassword') border-red-500 @enderror">
                @error('password', 'updatePassword')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-check-circle mr-2 text-indigo-600"></i>নতুন পাসওয়ার্ড নিশ্চিত করুন
                </label>
                <input 
                    type="password" 
                    name="password_confirmation"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg transition">
                <i class="fas fa-shield-alt mr-2"></i>পাসওয়ার্ড আপডেট করুন
            </button>
        </div>
    </form>
</div>
</body>
</html>