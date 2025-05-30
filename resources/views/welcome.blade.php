<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecruitAI - Recrutement Intelligent</title>
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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-2xl font-bold gradient-text">RecruitAI</span>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#features" class="text-white hover:text-gray-200 px-3 py-2 text-sm font-medium transition-colors">Fonctionnalités</a>
                        <a href="#about" class="text-white hover:text-gray-200 px-3 py-2 text-sm font-medium transition-colors">À propos</a>
                        <a href="#contact" class="text-white hover:text-gray-200 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-white hover:text-gray-200 px-4 py-2 text-sm font-medium transition-colors">
                        Connexion
                    </a>
                    <a href="/register" class="bg-white text-purple-600 hover:bg-gray-100 px-6 py-2 rounded-full text-sm font-semibold transition-all transform hover:scale-105">
                        S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-20 h-20 bg-white opacity-10 rounded-full animate-float"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-white opacity-10 rounded-full animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-20 w-12 h-12 bg-white opacity-10 rounded-full animate-float" style="animation-delay: 4s;"></div>
            <div class="absolute bottom-40 right-10 w-24 h-24 bg-white opacity-10 rounded-full animate-float" style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="animate-slide-up">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    L'avenir du
                    <span class="block text-yellow-300">Recrutement</span>
                    est ici
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Découvrez une nouvelle façon de recruter avec l'intelligence artificielle. 
                    Trouvez les talents parfaits en quelques clics.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-8 py-4 rounded-full text-lg font-semibold transition-all transform hover:scale-105 shadow-2xl">
                        <i class="fas fa-rocket mr-2"></i>
                        Commencer maintenant
                    </button>
                    <button class="border-2 border-white text-white hover:bg-white hover:text-purple-600 px-8 py-4 rounded-full text-lg font-semibold transition-all">
                        <i class="fas fa-play mr-2"></i>
                        Voir la démo
                    </button>
                </div>
            </div>
        </div>

        <!-- Floating AI Elements -->
        <div class="absolute right-10 top-1/2 transform -translate-y-1/2 hidden lg:block animate-float">
            <div class="bg-white bg-opacity-20 rounded-2xl p-6 backdrop-blur-sm">
                <i class="fas fa-brain text-4xl text-yellow-300 mb-4"></i>
                <p class="text-white text-sm">IA Avancée</p>
            </div>
        </div>
        <div class="absolute left-10 top-1/3 hidden lg:block animate-float" style="animation-delay: 1s;">
            <div class="bg-white bg-opacity-20 rounded-2xl p-6 backdrop-blur-sm">
                <i class="fas fa-users text-4xl text-yellow-300 mb-4"></i>
                <p class="text-white text-sm">Matching Parfait</p>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Pourquoi choisir <span class="gradient-text">RecruitAI</span> ?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Notre plateforme révolutionne le processus de recrutement grâce à l'intelligence artificielle
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-2 group">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-search text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Recherche Intelligente</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Notre IA analyse des milliers de profils pour vous proposer les candidats les plus pertinents en fonction de vos critères spécifiques.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-2 group">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Analyse Prédictive</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Prédisez le succès des candidats grâce à notre algorithme d'analyse comportementale et de performance.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-2 group">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-clock text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Gain de Temps</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Réduisez votre temps de recrutement de 70% grâce à l'automatisation des tâches répétitives.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 hero-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="animate-bounce-slow">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-300 mb-2">10K+</div>
                    <div class="text-white text-lg">Candidats</div>
                </div>
                <div class="animate-bounce-slow" style="animation-delay: 0.5s;">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-300 mb-2">500+</div>
                    <div class="text-white text-lg">Entreprises</div>
                </div>
                <div class="animate-bounce-slow" style="animation-delay: 1s;">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-300 mb-2">95%</div>
                    <div class="text-white text-lg">Satisfaction</div>
                </div>
                <div class="animate-bounce-slow" style="animation-delay: 1.5s;">
                    <div class="text-4xl md:text-5xl font-bold text-yellow-300 mb-2">70%</div>
                    <div class="text-white text-lg">Temps Économisé</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Comment ça <span class="gradient-text">fonctionne</span> ?
                </h2>
                <p class="text-xl text-gray-600">Un processus simple en 3 étapes</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <span class="text-2xl font-bold text-white">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Définissez vos critères</h3>
                    <p class="text-gray-600">
                        Décrivez le poste idéal et les compétences recherchées. Notre IA comprend vos besoins.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <span class="text-2xl font-bold text-white">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">L'IA fait le tri</h3>
                    <p class="text-gray-600">
                        Notre algorithme analyse et classe les candidats selon leur adéquation avec votre offre.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <span class="text-2xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Recrutez le meilleur</h3>
                    <p class="text-gray-600">
                        Rencontrez uniquement les candidats les plus prometteurs et prenez la meilleure décision.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 hero-bg relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Prêt à révolutionner votre recrutement ?
            </h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Rejoignez des centaines d'entreprises qui font confiance à RecruitAI pour trouver leurs talents.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-8 py-4 rounded-full text-lg font-semibold transition-all transform hover:scale-105 shadow-2xl">
                    Essai gratuit 14 jours
                </button>
                <button class="border-2 border-white text-white hover:bg-white hover:text-purple-600 px-8 py-4 rounded-full text-lg font-semibold transition-all">
                    Demander une démo
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-2">
                    <h3 class="text-2xl font-bold gradient-text mb-4">RecruitAI</h3>
                    <p class="text-gray-400 mb-6 max-w-md">
                        La plateforme de recrutement intelligent qui transforme votre façon de recruter grâce à l'IA.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Produit</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Fonctionnalités</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Prix</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 RecruitAI. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
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

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-white', 'bg-opacity-90');
                nav.classList.remove('glass-effect');
            } else {
                nav.classList.remove('bg-white', 'bg-opacity-90');
                nav.classList.add('glass-effect');
            }
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all sections for animation
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(section);
        });
    </script>
</body>
</html>