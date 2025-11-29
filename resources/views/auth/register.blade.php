<!DOCTYPE html>
<html lang="bn" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>অ্যাকাউন্ট তৈরি করুন</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="h-full">

<div class="min-h-full flex items-center justify-center py-12 px-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-600 rounded-2xl shadow-2xl">
                <i class="fas fa-file-invoice-dollar text-white text-4xl"></i>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">অ্যাকাউন্ট তৈরি করুন</h2>
         <p class="mt-2 text-center text-sm text-gray-600">
            আপনার ব্যবসার হিসাব সহজ ও নিরাপদে পরিচালনা করুন
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-8">

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">নাম</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                               placeholder="আপনার পুরো নাম">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">ইমেইল</label>
                        <div class="mt-2 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="pl-12 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">পাসওয়ার্ড</label>
                        <div class="mt-2 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" required minlength="8"
                                   class="pl-12 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                                   placeholder="কমপক্ষে ৮ অক্ষর">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold text-lg rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                        ফ্রি অ্যাকাউন্ট তৈরি করুন
                    </button>
                </div>
            </form>

            <p class="mt-8 text-center text-gray-600">
                ইতিমধ্যে অ্যাকাউন্ট আছে?
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500">
                    এখনই লগইন করুন
                </a>
            </p>
        </div>
    </div>
</div>

</body>
</html>