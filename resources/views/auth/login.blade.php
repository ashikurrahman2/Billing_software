<!DOCTYPE html>
<html lang="bn" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লগইন করুন</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .logo-container {
            margin-bottom: 30px;
            animation: fadeInDown 0.8s ease;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .logo svg {
            width: 50px;
            height: 50px;
        }

        .app-name {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-top: 20px;
            text-align: center;
            animation: fadeInDown 0.8s ease 0.2s backwards;
            letter-spacing: 1px;
        }

        .app-tagline {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            margin-top: 8px;
            animation: fadeInDown 0.8s ease 0.3s backwards;
        }

        .loader-container {
            margin-top: 40px;
            animation: fadeInUp 0.8s ease 0.4s backwards;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        .loading-text {
            color: white;
            font-size: 16px;
            margin-top: 25px;
            text-align: center;
            animation: pulse 1.5s ease-in-out infinite;
        }

        .progress-bar-container {
            width: 280px;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
        }

        .progress-bar {
            height: 100%;
            background: white;
            border-radius: 10px;
            animation: progressLoad 2.5s ease-in-out forwards;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes progressLoad {
            0% { width: 0%; }
            100% { width: 100%; }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .logo {
                width: 70px;
                height: 70px;
            }

            .logo svg {
                width: 40px;
                height: 40px;
            }

            .app-name {
                font-size: 24px;
            }

            .app-tagline {
                font-size: 13px;
            }

            .spinner {
                width: 50px;
                height: 50px;
            }

            .loading-text {
                font-size: 14px;
            }

            .progress-bar-container {
                width: 240px;
            }
        }

        @media (max-width: 480px) {
            .logo {
                width: 60px;
                height: 60px;
            }

            .logo svg {
                width: 35px;
                height: 35px;
            }

            .app-name {
                font-size: 20px;
            }

            .app-tagline {
                font-size: 12px;
            }

            .progress-bar-container {
                width: 200px;
            }
        }

        /* Login page hidden initially */
        .login-content {
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        .login-content.show {
            opacity: 1;
        }
    </style>
</head>
<body class="h-full">
   <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="logo-container">
            <div class="logo">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 7H7C5.89543 7 5 7.89543 5 9V17C5 18.1046 5.89543 19 7 19H17C18.1046 19 19 18.1046 19 17V9C19 7.89543 18.1046 7 17 7H15" stroke="#667eea" stroke-width="2" stroke-linecap="round"/>
                    <rect x="9" y="5" width="6" height="4" rx="1" stroke="#667eea" stroke-width="2"/>
                    <path d="M9 12H15M9 15H13" stroke="#667eea" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
        
        <div class="app-name">BillingSoft Pro</div>
        <div class="app-tagline">Smart Billing Solution</div>
        
        <div class="loader-container">
            <div class="spinner"></div>
            <div class="loading-text">Loading your workspace...</div>
            <div class="progress-bar-container">
                <div class="progress-bar"></div>
            </div>
        </div>
    </div>

<div class="min-h-full flex items-center justify-center py-12 px-6">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-600 rounded-2xl shadow-2xl">
                <i class="fas fa-file-invoice-dollar text-white text-4xl"></i>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">লগইন করুন</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
            আপনার ব্যবসার হিসাব সহজ ও নিরাপদে পরিচালনা করুন
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-8">

            @if(session('status'))
                <div class="mb-6 p-5 bg-green-100 border-2 border-green-400 rounded-xl text-center font-bold text-green-800 text-lg">
                    <i class="fas fa-check-circle text-3xl mb-2 block"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                    ইমেইল বা পাসওয়ার্ড ভুল হয়েছে।
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">ইমেইল</label>
                        <div class="mt-2 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="আপনার ইমেইল লিখুন" required
                                   class="pl-12 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">পাসওয়ার্ড</label>
                        <div class="mt-2 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" required placeholder="আপনার পাসওয়ার্ড দিন"
                                   class="pl-12 w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg rounded-xl shadow-lg transform hover:scale-105 transition">
                        লগইন করুন
                    </button>
                </div>
            </form>

            <p class="mt-8 text-center text-gray-600">
                অ্যাকাউন্ট নেই?
                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-500">
                    এখনই তৈরি করুন
                </a>
            </p>
        </div>
    </div>
</div>


 <script>
        // Hide preloader and show login page
        window.addEventListener('load', function() {
            setTimeout(function() {
                const preloader = document.getElementById('preloader');
                const loginContent = document.getElementById('loginContent');
                
                preloader.classList.add('fade-out');
                
                setTimeout(function() {
                    preloader.style.display = 'none';
                    loginContent.classList.add('show');
                }, 500);
            }, 2500); // 2.5 seconds loading time
        });

        // Demo login handler (replace with your actual backend)
        function handleLogin(event) {
            event.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Demo validation - replace with your actual authentication
            if (email && password) {
                alert('লগইন সফল হয়েছে! (এটি ডেমো, আপনার backend এর সাথে যুক্ত করুন)');
            }
        }
    </script>
</body>
</html>