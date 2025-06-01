<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecruitAI - Excellence en Recrutement</title>
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
            background-color: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(209, 213, 219, 0.3);
        }
        .hero-pattern {
            background-image: radial-gradient(circle at 25px 25px, rgba(255,255,255,0.1) 2px, transparent 0),
                              radial-gradient(circle at 75px 75px, rgba(255,255,255,0.1) 2px, transparent 0);
            background-size: 100px 100px;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 transition-all duration-300" id="navbar">
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
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#solutions" class="text-white hover:text-primary px-3 py-2 text-sm font-medium transition-colors duration-300">Solutions</a>
                        <a href="#features" class="text-white hover:text-primary px-3 py-2 text-sm font-medium transition-colors duration-300">Fonctionnalités</a>
                        <a href="#pricing" class="text-white hover:text-primary px-3 py-2 text-sm font-medium transition-colors duration-300">Tarifs</a>
                        <a href="#contact" class="text-white hover:text-primary px-3 py-2 text-sm font-medium transition-colors duration-300">Contact</a>
                    </div>
                </div>
                
                
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-white hover:text-primary font-medium transition-colors">Connexion</a>
                    <a href="/register" class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">
        <div class="hero-pattern absolute inset-0"></div>
        
        <!-- Background Image -->
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                 alt="Professional team" class="w-full h-full object-cover">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div class="animate-slide-in-left">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        Transformez votre
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">
                            recrutement
                        </span>
                        avec l'IA
                    </h1>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        Découvrez la plateforme de recrutement nouvelle génération qui connecte les meilleurs talents 
                        aux entreprises visionnaires grâce à l'intelligence artificielle.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <button class="bg-accent hover:bg-yellow-500 text-gray-900 px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-xl">
                            <i class="fas fa-rocket mr-2"></i>
                            Démarrer gratuitement
                        </button>
                        <button class="glass-morphism text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 hover:bg-white hover:text-gray-900">
                            <i class="fas fa-play mr-2"></i>
                            Voir la démo
                        </button>
                    </div>
                    
                    <!-- Trust Indicators -->
                    <div class="flex items-center space-x-8 text-gray-400">
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
                
                <!-- Hero Image -->
                <div class="animate-slide-in-right">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-full h-full bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl opacity-20 animate-float-slow"></div>
                        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Modern recruitment" class="relative z-10 rounded-2xl shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Pourquoi choisir RecruitAI ?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Notre plateforme révolutionne le recrutement avec des outils intelligents 
                    qui vous font gagner du temps et améliorer vos résultats.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-brain text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">IA Prédictive</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Algorithmes avancés qui analysent et prédisent la compatibilité 
                        entre candidats et postes avec une précision de 95%.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-search text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Recherche Intelligente</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Trouvez les candidats parfaits en quelques secondes grâce à notre 
                        moteur de recherche sémantique alimenté par l'IA.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Analytics Avancées</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tableaux de bord complets avec insights en temps réel pour 
                        optimiser vos processus de recrutement.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-2xl text-orange-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Collaboration d'Équipe</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Outils collaboratifs intégrés pour que vos équipes RH travaillent 
                        ensemble efficacement sur chaque recrutement.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shield-alt text-2xl text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Sécurité Premium</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Protection des données de niveau entreprise avec chiffrement 
                        bout-en-bout et conformité RGPD.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-mobile-alt text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Mobile First</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Interface responsive optimisée pour tous les appareils. 
                        Recrutez où que vous soyez, à tout moment.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Un processus simplifié
                </h2>
                <p class="text-xl text-gray-600">
                    Trois étapes pour révolutionner votre recrutement
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 items-center mb-20">
                <!-- Process Steps -->
                <div class="space-y-12">
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">1</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Créez votre profil d'entreprise</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Configurez votre espace de travail personnalisé avec vos critères, 
                                votre marque employeur et vos préférences de recrutement.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">2</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Publiez vos offres intelligentes</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Notre IA optimise automatiquement vos annonces pour attirer 
                                les meilleurs candidats et maximiser la visibilité.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">3</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Sélectionnez les talents parfaits</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Recevez une liste pré-qualifiée des meilleurs candidats, 
                                classés par compatibilité avec vos besoins spécifiques.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Process Image -->
                <div class="relative">
                    <div class="absolute -top-4 -right-4 w-full h-full bg-gradient-to-r from-primary to-blue-600 rounded-3xl opacity-10"></div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Team collaboration" class="relative z-10 rounded-3xl shadow-2xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Ils nous font confiance
                </h2>
                <p class="text-xl text-gray-600">
                    Découvrez comment nos clients transforment leur recrutement
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                             alt="Sarah Martin" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-900">Sarah Martin</h4>
                            <p class="text-gray-600 text-sm">DRH chez TechCorp</p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        "RecruitAI a révolutionné notre processus de recrutement. Nous avons réduit 
                        notre temps d'embauche de 60% tout en améliorant la qualité de nos recrutements."
                    </p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                             alt="Marc Dubois" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-900">Marc Dubois</h4>
                            <p class="text-gray-600 text-sm">CEO StartupXYZ</p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        "L'IA de RecruitAI nous a permis de trouver des talents exceptionnels 
                        que nous n'aurions jamais découverts avec les méthodes traditionnelles."
                    </p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                             alt="Julie Chen" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-900">Julie Chen</h4>
                            <p class="text-gray-600 text-sm">Responsable RH</p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        "Interface intuitive, résultats exceptionnels. RecruitAI est devenu 
                        un outil indispensable pour notre équipe RH."
                    </p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-primary to-blue-700 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                Prêt à transformer votre recrutement ?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Rejoignez plus de 800 entreprises qui utilisent RecruitAI pour 
                trouver les meilleurs talents plus rapidement et plus efficacement.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-accent hover:bg-yellow-500 text-gray-900 px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl">
                    <i class="fas fa-rocket mr-2"></i>
                    Commencer l'essai gratuit
                </button>
                <button class="glass-morphism text-white px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300 hover:bg-white hover:text-gray-900">
                    <i class="fas fa-calendar mr-2"></i>
                    Réserver une démo
                </button>
            </div>
            <p class="text-blue-200 text-sm mt-4">
                Essai gratuit de 14 jours • Aucune carte de crédit requise • Support 24/7
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <!-- Company Info -->
                <div class="col-span-2">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold">RecruitAI</span>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md leading-relaxed">
                        La plateforme de recrutement intelligente qui connecte les entreprises 
                        aux meilleurs talents grâce à l'intelligence artificielle.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-primary transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-primary transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-primary transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Produit</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Fonctionnalités</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Tarification</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Intégrations</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Support</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Centre d'aide</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Statut</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © 2024 RecruitAI. Tous droits réservés.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Politique de confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Conditions d'utilisation</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Mentions légales</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('glass-morphism', 'shadow-lg');
            } else {
                navbar.classList.remove('glass-morphism', 'shadow-lg');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute