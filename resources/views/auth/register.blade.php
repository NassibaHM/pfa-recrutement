<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - RecruitAI</title>
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
        .strength-meter {
            height: 4px;
            border-radius: 2px;
            background: #e5e7eb;
            overflow: hidden;
            margin-top: 8px;
        }
        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
    </style>
</head>
<body class="hero-bg min-h-screen flex items-center justify-center relative overflow-hidden py-8">
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
                    <span class="text-gray-700 text-sm">Déjà un compte ?</span>
                    <a href="/login" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-full text-sm font-semibold transition-all transform hover:scale-105 shadow-lg">
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Register Form Container -->
    <div class="w-full max-w-lg mx-auto px-4 relative z-10 animate-slide-up">
        <!-- Register Card -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8 md:p-10">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-yellow-400 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg animate-bounce-slow">
                    <i class="fas fa-user-plus text-2xl text-gray-900"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Rejoignez RecruitAI</h1>
                <p class="text-gray-600">Créez votre compte et révolutionnez votre recrutement</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <!-- Name Field -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-user mr-2 text-purple-600"></i>
                        Nom complet
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        required 
                        autofocus
                        autocomplete="name"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus bg-white bg-opacity-80 placeholder-gray-500"
                        placeholder="Votre nom complet"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

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
                        autocomplete="username"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus bg-white bg-opacity-80 placeholder-gray-500"
                        placeholder="votre@email.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
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
                            autocomplete="new-password"
                            onkeyup="checkPasswordStrength(this.value)"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus bg-white bg-opacity-80 placeholder-gray-500 pr-12"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-purple-600 transition-colors"
                        >
                            <i id="toggleIcon1" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <!-- Password Strength Meter -->
                    <div class="strength-meter">
                        <div id="strengthFill" class="strength-fill bg-red-500" style="width: 0%"></div>
                    </div>
                    <p id="strengthText" class="text-xs text-gray-500 mt-1">Utilisez au moins 8 caractères avec des lettres et chiffres</p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-lock mr-2 text-purple-600"></i>
                        Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required 
                            autocomplete="new-password"
                            onkeyup="checkPasswordMatch()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent input-focus bg-white bg-opacity-80 placeholder-gray-500 pr-12"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-purple-600 transition-colors"
                        >
                            <i id="toggleIcon2" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p id="matchText" class="text-xs text-gray-500 mt-1">Répétez votre mot de passe</p>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

               

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    id="submitBtn"
                    class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                >
                    <i class="fas fa-user-plus"></i>
                    <span>Créer mon compte</span>
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 rounded-full">ou s'inscrire avec</span>
                    </div>
                </div>

                <!-- Social Register Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button 
                        type="button" 
                        class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                    >
                        <i class="fab fa-google text-red-500 mr-2"></i>
                        Google
                    </button>
                    
                    <button 
                        type="button" 
                        class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                    >
                        <i class="fab fa-linkedin text-blue-600 mr-2"></i>
                        LinkedIn
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center pt-4">
                    <p class="text-sm text-gray-600">
                        Déjà inscrit ? 
                        <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-500 font-semibold underline transition-colors">
                            Connectez-vous ici
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Bottom Benefits -->
        <div class="mt-6 grid grid-cols-3 gap-4 text-center text-white text-xs">
            <div class="bg-white bg-opacity-20 rounded-xl p-3 backdrop-blur-sm">
                <i class="fas fa-shield-check text-lg text-yellow-300 mb-2"></i>
                <p>100% Sécurisé</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-xl p-3 backdrop-blur-sm">
                <i class="fas fa-clock text-lg text-yellow-300 mb-2"></i>
                <p>Inscription rapide</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-xl p-3 backdrop-blur-sm">
                <i class="fas fa-gift text-lg text-yellow-300 mb-2"></i>
                <p>Essai gratuit</p>
            </div>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute right-10 top-1/2 transform -translate-y-1/2 hidden lg:block animate-float">
        <div class="bg-white bg-opacity-20 rounded-2xl p-6 backdrop-blur-sm">
            <i class="fas fa-rocket text-4xl text-yellow-300 mb-4"></i>
            <p class="text-white text-sm">Démarrage Rapide</p>
        </div>
    </div>
    <div class="absolute left-10 top-1/3 hidden lg:block animate-float" style="animation-delay: 1s;">
        <div class="bg-white bg-opacity-20 rounded-2xl p-6 backdrop-blur-sm">
            <i class="fas fa-star text-4xl text-yellow-300 mb-4"></i>
            <p class="text-white text-sm">Excellence IA</p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = fieldId === 'password' ? document.getElementById('toggleIcon1') : document.getElementById('toggleIcon2');
            
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

        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let text = '';
            let color = '';
            
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 25;
            
            if (strength <= 25) {
                text = 'Mot de passe faible';
                color = 'bg-red-500';
            } else if (strength <= 50) {
                text = 'Mot de passe moyen';
                color = 'bg-orange-500';
            } else if (strength <= 75) {
                text = 'Mot de passe bon';
                color = 'bg-yellow-500';
            } else {
                text = 'Mot de passe excellent';
                color = 'bg-green-500';
            }
            
            strengthFill.style.width = Math.min(strength, 100) + '%';
            strengthFill.className = 'strength-fill ' + color;
            strengthText.textContent = text;
            strengthText.className = 'text-xs mt-1 ' + (strength > 50 ? 'text-green-600' : 'text-gray-500');
        }

        // Password match checker
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchText = document.getElementById('matchText');
            
            if (confirmPassword.length === 0) {
                matchText.textContent = 'Répétez votre mot de passe';
                matchText.className = 'text-xs text-gray-500 mt-1';
            } else if (password === confirmPassword) {
                matchText.innerHTML = '<i class="fas fa-check-circle mr-1"></i>Les mots de passe correspondent';
                matchText.className = 'text-xs text-green-600 mt-1 flex items-center';
            } else {
                matchText.innerHTML = '<i class="fas fa-times-circle mr-1"></i>Les mots de passe ne correspondent pas';
                matchText.className = 'text-xs text-red-500 mt-1 flex items-center';
            }
        }

        // Add floating animation on form focus
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
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
            const submitBtn = document.getElementById('submitBtn');
            const termsCheckbox = document.getElementById('terms');
            
            if (!termsCheckbox.checked) {
                e.preventDefault();
                termsCheckbox.focus();
                termsCheckbox.parentElement.classList.add('animate-pulse');
                setTimeout(() => {
                    termsCheckbox.parentElement.classList.remove('animate-pulse');
                }, 2000);
                return;
            }
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Création du compte...';
            submitBtn.disabled = true;
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.text-red-500');
            alerts.forEach(alert => {
                if (alert.tagName === 'P') {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 8000);

        // Real-time email validation
        const emailInput = document.getElementById('email');
        emailInput.addEventListener('input', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                this.classList.add('border-red-300');
                this.classList.remove('border-gray-300');
            } else {
                this.classList.remove('border-red-300');
                this.classList.add('border-gray-300');
            }
        });
    </script>
</body>
</html>