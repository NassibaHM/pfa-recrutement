<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - RecruitAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#1e40af',
                        'secondary': '#0f172a',
                        'accent': '#f59e0b'
                    },
                    animation: {
                        'slide-in-left': 'slideInLeft 1s ease-out',
                        'slide-in-right': 'slideInRight 1s ease-out',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'float-slow': 'floatSlow 8s ease-in-out infinite'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .glass-morphism {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }
        .hero-pattern {
            background-image: radial-gradient(circle at 25px 25px, rgba(255,255,255,0.1) 2px, transparent 0),
                              radial-gradient(circle at 75px 75px, rgba(255,255,255,0.1) 2px, transparent 0);
            background-size: 100px 100px;
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 64, 175, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 glass-morphism shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold text-gray-900">RecruitAI</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 text-sm">Pas encore de compte ?</span>
                    <a href="/register" class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden relative pt-20">
        <div class="hero-pattern absolute inset-0"></div>
        
        <!-- Background Image -->
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                 alt="Professional team" class="w-full h-full object-cover">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center min-h-screen">
                
                <!-- Left Content - Welcome Message -->
                <div class="animate-slide-in-left">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        Bon retour sur
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                            RecruitAI
                        </span>
                    </h1>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        Connectez-vous à votre espace et continuez à révolutionner votre recrutement 
                        avec l'intelligence artificielle.
                    </p>
                    
                    <!-- Trust Indicators -->
                    <div class="flex items-center space-x-8 text-gray-400 mb-12">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">15k+</div>
                            <div class="text-sm">Candidats actifs</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">800+</div>
                            <div class="text-sm">Entreprises</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">98%</div>
                            <div class="text-sm">Satisfaction</div>
                        </div>
                    </div>

                    <!-- Features Preview -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 text-gray-300">
                            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-brain text-white text-sm"></i>
                            </div>
                            <span>IA Prédictive pour un matching parfait</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <div class="w-8 h-8 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-search text-gray-900 text-sm"></i>
                            </div>
                            <span>Recherche intelligente en temps réel</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-white text-sm"></i>
                            </div>
                            <span>Analytics avancées et insights</span>
                        </div>
                    </div>
                </div>
                
                <!-- Right Content - Login Form -->
                <div class="animate-slide-in-right">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-full h-full bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl opacity-20 animate-float-slow"></div>
                        
                        <!-- Login Card -->
                        <div class="relative z-10 glass-morphism rounded-2xl shadow-2xl p-8 lg:p-10">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <div class="w-16 h-16 bg-accent rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                    <i class="fas fa-sign-in-alt text-2xl text-gray-900"></i>
                                </div>
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Connexion</h2>
                                <p class="text-gray-600">Accédez à votre tableau de bord</p>
                            </div>

                            <!-- Login Form -->
                            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                                <!-- CSRF Token -->
                                @csrf
                                
                                <!-- Email Field -->
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-envelope mr-2 text-primary"></i>
                                        Adresse e-mail
                                    </label>
                                    <input 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        required 
                                        autocomplete="email"
                                        value="{{ old('email') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent input-focus bg-white placeholder-gray-500 transition-all duration-300"
                                        placeholder="votre@email.com"
                                    >
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-lock mr-2 text-primary"></i>
                                        Mot de passe
                                    </label>
                                    <div class="relative">
                                        <input 
                                            id="password" 
                                            name="password" 
                                            type="password" 
                                            required 
                                            autocomplete="current-password"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent input-focus bg-white placeholder-gray-500 pr-12 transition-all duration-300"
                                            placeholder="••••••••"
                                        >
                                        <button 
                                            type="button" 
                                            onclick="togglePassword()"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary transition-colors"
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
                                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                                        >
                                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                            Se souvenir de moi
                                        </label>
                                    </div>
                                    <div class="text-sm">
                                        <a href="#" class="font-medium text-primary hover:text-blue-700 transition-colors">
                                            Mot de passe oublié ?
                                        </a>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button 
                                    type="submit" 
                                    class="w-full bg-primary hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                                >
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Se connecter</span>
                                </button>
                            </form>

                            <!-- Footer -->
                            <div class="mt-8 text-center">
                                <p class="text-sm text-gray-600">
                                    En vous connectant, vous acceptez nos 
                                    <a href="#" class="text-primary hover:text-blue-700 font-medium">Conditions d'utilisation</a>
                                    et notre 
                                    <a href="#" class="text-primary hover:text-blue-700 font-medium">Politique de confidentialité</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute right-10 top-1/2 transform -translate-y-1/2 hidden xl:block animate-float-slow">
            <div class="glass-morphism rounded-2xl p-6 shadow-xl">
                <i class="fas fa-shield-alt text-4xl text-accent mb-4"></i>
                <p class="text-gray-900 text-sm font-semibold">Connexion Sécurisée</p>
                <p class="text-gray-600 text-xs">Chiffrement SSL 256-bit</p>
            </div>
        </div>
        <div class="absolute left-10 top-1/3 hidden xl:block animate-float-slow" style="animation-delay: 2s;">
            <div class="glass-morphism rounded-2xl p-6 shadow-xl">
                <i class="fas fa-rocket text-4xl text-primary mb-4"></i>
                <p class="text-gray-900 text-sm font-semibold">Accès Instantané</p>
                <p class="text-gray-600 text-xs">Dashboard optimisé</p>
            </div>
        </div>
    </section>

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

        // Form submission with loading state
        const form = document.getElementById('loginForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalContent = submitBtn.innerHTML;

                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Connexion en cours...';
                submitBtn.disabled = true;

                // Let the form submit naturally to the server
                // The server will handle validation, saving to the database, and redirection
            });
        }

        // Auto-hide alerts after 5 seconds (if any server-side errors are rendered)
        setTimeout(() => {
            const alerts = document.querySelectorAll('.text-red-500');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Smooth scrolling for any potential anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>