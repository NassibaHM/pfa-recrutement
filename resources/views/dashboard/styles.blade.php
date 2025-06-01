@section('styles')
<style>
    /* Import Google Fonts pour correspondre au welcome */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    /* Animations modernes inspirées du welcome */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from { 
            opacity: 0; 
            transform: translateX(-100px); 
        }
        to { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }

    @keyframes slideInRight {
        from { 
            opacity: 0; 
            transform: translateX(100px); 
        }
        to { 
            opacity: 1; 
            transform: translateX(0); 
        }
    }

    @keyframes floatSlow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }

    @keyframes pulseGlow {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(30, 64, 175, 0.4);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(30, 64, 175, 0);
        }
    }

    .animate-fade-up {
        animation: fadeInUp 0.8s ease-out;
    }

    .animate-slide-left {
        animation: slideInLeft 1s ease-out;
    }

    .animate-slide-right {
        animation: slideInRight 1s ease-out;
    }

    .animate-float {
        animation: floatSlow 8s ease-in-out infinite;
    }

    .pulse-glow {
        animation: pulseGlow 2s infinite;
    }

    /* Glassmorphism effect comme dans le welcome */
    .glass-morphism {
        backdrop-filter: blur(16px) saturate(180%);
        background-color: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(209, 213, 219, 0.3);
    }

    .glass-dark {
        backdrop-filter: blur(16px) saturate(180%);
        background-color: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(209, 213, 219, 0.1);
    }

    /* Thème inspiré du welcome page */
    .hero-bg {
        background: linear-gradient(135deg, #0f172a 0%, #1e40af 50%, #0f172a 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-pattern {
        background-image: radial-gradient(circle at 25px 25px, rgba(255,255,255,0.1) 2px, transparent 0),
                          radial-gradient(circle at 75px 75px, rgba(255,255,255,0.1) 2px, transparent 0);
        background-size: 100px 100px;
    }

    /* Cards modernes avec effet hover */
    .modern-card {
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        border: 1px solid rgba(30, 64, 175, 0.1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modern-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: rgba(30, 64, 175, 0.3);
    }

    /* Buttons comme dans le welcome */
    .btn-primary {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
    }

    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.4);
    }

    .btn-accent {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        color: #1f2937;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-accent:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
    }

    /* Sidebar moderne */
    .sidebar-modern {
        background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 100%);
        border-right: 1px solid rgba(59, 130, 246, 0.2);
        box-shadow: 5px 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Progress circles */
    .circle-progress {
        position: relative;
        width: 80px;
        height: 80px;
    }

    .circle-progress svg {
        transform: rotate(-90deg);
    }

    .circle-progress .progress-ring {
        fill: none;
        stroke-width: 4;
        stroke-linecap: round;
        transition: stroke-dashoffset 1.5s ease-in-out;
    }

    /* Gradient text */
    .gradient-text {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .gradient-text-accent {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #1e40af;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #3b82f6;
    }
</style>
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection