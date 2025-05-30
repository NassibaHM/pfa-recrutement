<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - RecruitAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'fade-in': 'fadeIn 1s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                        'bounce-slow': 'bounce 2s infinite'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
    </style>
</head>
<body class="hero-bg min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-10 w-20 h-20 bg-white opacity-10 rounded-full animate-float"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-white opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-20 w-12 h-12 bg-white opacity-10 rounded-full animate-float" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-40 right-10 w-24 h-24 bg-white opacity-10 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-yellow-300 opacity-5 rounded-full animate-pulse-slow"></div>
        <div class="absolute top-1/3 right-1/3 w-20 h-20 bg-yellow-300 opacity-5 rounded-full animate-pulse-slow" style="animation-delay: 1.5s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0">
                        <span class="text-2xl font-bold gradient-text">RecruitAI</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 text-sm">Pas encore de compte ?</span>
                    <a href="/register" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-full text-sm font-semibold transition-all transform hover:scale-105 shadow-lg">
                        S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Form Container -->
    <div class="w-full max-w-md mx-auto px-4 relative z-10 animate-slide-up">
        <!-- Login Card -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8 md:p-10">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-yellow-400 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg animate-bounce-slow">
                    <i class="fas fa-user text-2xl text-gray-900"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Bon retour !</h1>
                <p class="text-gray-600">Connectez-vous à votre compte RecruitAI</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="/login" class="space-y-6">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-envelope mr-2 text-purple-600"></i>
                        Adresse e-mail
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        autocomplete="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus bg-white bg-opacity-80 placeholder-gray-500"
                        placeholder="votre@email.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-lock mr-2 text-purple-600"></i>
                        Mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            autocomplete="current-password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus bg-white bg-opacity-80 placeholder-gray-500 pr-12"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-purple-600 transition-colors"
                        >
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-purple-600 hover:text-purple-500 transition-colors">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                >
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Se connecter</span>
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 rounded-full">ou continuer avec</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
               
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    En vous connectant, vous acceptez nos 
                    <a href="#" class="text-purple-600 hover:text-purple-500 font-medium">Conditions d'utilisation</a>
                    et notre 
                    <a href="#" class="text-purple-600 hover:text-purple-500 font-medium">Politique de confidentialité</a>
                </p>
            </div>
        </div>

        <!-- Bottom Link -->
        <div class="text-center mt-6">
            <p class="text-white text-sm">
                Première visite ? 
                <a href="/register" class="text-yellow-300 hover:text-yellow-200 font-semibold underline transition-colors">
                    Créez votre compte gratuitement
                </a>
            </p>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute right-10 top-1/2 transform -translate-y-1/2 hidden lg:block animate-float">
        <div class="bg-white bg-opacity-20 rounded-2xl p-6 backdrop-blur-sm">
            <i class="fas fa-shield-alt text-4xl text-yellow-300 mb-4"></i>
            <p class="text-white text-sm">Connexion Sécurisée</p>
        </div>
    </div>
    <div class="absolute left-10 top-1/3 hidden lg:block animate-float" style="animation-delay: 1s;">
        <div class="bg-white bg-opacity-20 rounded-2xl p-6 backdrop-blur-sm">
            <i class="fas fa-rocket text-4xl text-yellow-300 mb-4"></i>
            <p class="text-white text-sm">Accès Rapide</p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add floating animation on form focus
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', 'scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', 'scale-105');
            });
        });

        // Form validation animation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Connexion en cours...';
            submitBtn.disabled = true;
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.text-red-500');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>