@extends('layouts.app')

@section('content')
    <main class="flex-1 p-8">
        <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
            <h1 class="text-2xl font-bold text-[#0f172a] mb-4">
                <i class="fas fa-user mr-2 text-[#f59e0b]"></i>Mon Profil
            </h1>
            <p class="text-gray-600 mb-6">Gérez vos informations personnelles.</p>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('candidat.profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                           class="input-field @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- First Name -->
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', Auth::user()->first_name) }}"
                           class="input-field @error('first_name') border-red-500 @enderror">
                    @error('first_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                           class="input-field @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe (facultatif)</label>
                    <input type="password" name="password" id="password"
                           class="input-field @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="input-field">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        /* Animations */
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

        .animate-fade-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Card Styling */
        .card-modern {
            background: linear-gradient(145deg, rgba(30, 64, 175, 0.2), rgba(255, 255, 255, 0.8));
            border: 1px solid rgba(30, 64, 175, 0.3);
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(30, 64, 175, 0.2);
        }

        /* Input Styling */
        .input-field {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            transition: border-color 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #1e40af;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #1e40af;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #1e3a8a;
        }

        /* Error Message */
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 4px;
        }
    </style>
@endpush