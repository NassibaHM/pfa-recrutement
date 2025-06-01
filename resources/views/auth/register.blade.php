<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - RecruitAI</title>
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
                        'float-slow': 'floatSlow 8s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite alternate',
                        'spin-slow': 'spin 3s linear infinite'
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
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            100% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6); }
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
        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 4px 20px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }
        .gradient-border {
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #3b82f6, #8b5cf6) border-box;
            border: 2px solid transparent;
        }
        .strength-meter {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 8px;
        }
        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
            animation: floatSlow 8s ease-in-out infinite;
        }
        .register-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">
    <!-- Background Pattern -->
    <div class="hero-pattern absolute inset-0"></div>
    
    <!-- Background Image -->
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
             alt="Professional team" class="w-full h-full object-cover">
    </div>

    <!-- Floating Orbs -->
    <div class="floating-orb w-72 h-72 top-10 -left-20" style="animation-delay: 0s;"></div>
    <div class="floating-orb w-96 h-96 -top-20 right-10" style="animation-delay: 2s;"></div>
    <div class="floating-orb w-64 h-64 bottom-10 -right-10" style="animation-delay: 4s;"></div>
    <div class="floating-orb w-80 h-80 -bottom-20 left-1/4" style="animation-delay: 1s;"></div>

    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 glass-morphism shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">RecruitAI</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 text-sm">Déjà un compte ?</span>
                    <a href="/login" class="bg-primary hover:bg-blue-700 text-white px-6 py-2 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 pt-20 pb-12">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Side - Welcome Content -->
            <div class="animate-slide-in-left text-white">
                <div class="mb-8">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                        Rejoignez la révolution du
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                            recrutement IA
                        </span>
                    </h1>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        Créez votre compte gratuitement et découvrez comment l'intelligence artificielle 
                        peut transformer votre processus de recrutement.
                    </p>
                </div>

                <!-- Features Preview -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-brain text-blue-400"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">IA Prédictive Avancée</h3>
                            <p class="text-gray-400 text-sm">Matching intelligent avec 95% de précision</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-search text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Recherche Sémantique</h3>
                            <p class="text-gray-400 text-sm">Trouvez les talents parfaits en secondes</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-purple-400"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Analytics en Temps Réel</h3>
                            <p class="text-gray-400 text-sm">Insights pour optimiser vos recrutements</p>
                        </div>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="flex items-center space-x-6 text-gray-400">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">15k+</div>
                        <div class="text-sm">Candidats</div>
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
            </div>

            <!-- Right Side - Registration Form -->
            <div class="animate-slide-in-right">
                <div class="register-card rounded-3xl shadow-2xl p-8 md:p-10">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg animate-pulse-glow">
                            <i class="fas fa-rocket text-2xl text-white"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Créer un compte</h2>
                    </div>

                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-6">
                        <!-- CSRF Token -->
                        @csrf
                        
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-user mr-2 text-primary"></i>
                                Nom complet
                            </label>
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent input-glow transition-all duration-300 bg-white placeholder-gray-500"
                                placeholder="Votre nom complet"
                            >
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

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
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent input-glow transition-all duration-300 bg-white placeholder-gray-500"
                                placeholder="votre@email.com"
                            >
                            <div id="emailFeedback" class="text-xs mt-1 hidden">
                                <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                <span class="text-green-600">Email valide</span>
                            </div>
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
                                    onkeyup="checkPasswordStrength(this.value)"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent input-glow transition-all duration-300 bg-white placeholder-gray-500 pr-12"
                                    placeholder="••••••••"
                                >
                                <button 
                                    type="button" 
                                    onclick="togglePassword('password')"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary transition-colors"
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
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-lock mr-2 text-primary"></i>
                                Confirmer le mot de passe
                            </label>
                            <div class="relative">
                                <input 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    type="password" 
                                    required 
                                    onkeyup="checkPasswordMatch()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent input-glow transition-all duration-300 bg-white placeholder-gray-500 pr-12"
                                    placeholder="••••••••"
                                >
                                <button 
                                    type="button" 
                                    onclick="togglePassword('password_confirmation')"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary transition-colors"
                                >
                                    <i id="toggleIcon2" class="fas fa-eye"></i>
                                </button>
                            </div>
                            <p id="matchText" class="text-xs text-gray-500 mt-1">Répétez votre mot de passe</p>
                            @error('password_confirmation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-center space-x-2">
                            <input 
                                id="terms" 
                                name="terms" 
                                type="checkbox" 
                                required 
                                class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                            >
                            <label for="terms" class="text-sm text-gray-700">
                                J'accepte les <a href="#" class="text-primary hover:text-blue-700 underline">Conditions d'utilisation</a> et la <a href="#" class="text-primary hover:text-blue-700 underline">Politique de confidentialité</a>
                            </label>
                            @error('terms')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="w-full bg-gradient-to-r from-primary to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                        >
                            <i class="fas fa-rocket"></i>
                            <span>Créer mon compte</span>
                        </button>

                        <!-- Login Link -->
                        <div class="text-center pt-4">
                            <p class="text-sm text-gray-600">
                                Déjà inscrit ? 
                                <a href="/login" class="text-primary hover:text-blue-700 font-semibold underline transition-colors">
                                    Connectez-vous ici
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Benefits -->
                <div class="mt-6 grid grid-cols-3 gap-4 text-center">
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-3 text-white">
                        <i class="fas fa-shield-check text-lg text-accent mb-2"></i>
                        <p class="text-xs">100% Sécurisé</p>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-3 text-white">
                        <i class="fas fa-gift text-lg text-accent mb-2"></i>
                        <p class="text-xs">14 jours gratuits</p>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-3 text-white">
                        <i class="fas fa-headset text-lg text-accent mb-2"></i>
                        <p class="text-xs">Support 24/7</p>
                    </div>
                </div>
            </div>
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

        // Email validation
        const emailInput = document.getElementById('email');
        const emailFeedback = document.getElementById('emailFeedback');
        
        emailInput.addEventListener('input', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && emailRegex.test(email)) {
                this.classList.add('border-green-300');
                this.classList.remove('border-gray-300', 'border-red-300');
                emailFeedback.classList.remove('hidden');
            } else if (email) {
                this.classList.add('border-red-300');
                this.classList.remove('border-gray-300', 'border-green-300');
                emailFeedback.classList.add('hidden');
            } else {
                this.classList.add('border-gray-300');
                this.classList.remove('border-green-300', 'border-red-300');
                emailFeedback.classList.add('hidden');
            }
        });

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
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
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Création du compte...';
            submitBtn.disabled = true;

            // Let the form submit naturally to the server
            // The server will handle validation, saving to the database, and redirection
        });

        // Add floating animation to form elements
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Parallax effect for floating orbs
        window.addEventListener('mousemove', function(e) {
            const orbs = document.querySelectorAll('.floating-orb');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            orbs.forEach((orb, index) => {
                const speed = (index + 1) * 0.5;
                const x = (mouseX - 0.5) * speed * 50;
                const y = (mouseY - 0.5) * speed * 50;
                orb.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    </script>
</body>
</html>