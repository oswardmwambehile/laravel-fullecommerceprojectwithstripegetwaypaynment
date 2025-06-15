<x-guest-layout>
    <style>
        .auth-container {
            display: flex;
            min-height: 100vh;
            height: 100dvh;
            font-family: 'Inter', sans-serif;
        }

        .auth-left {
            flex: 1;
            background-color: 	#1E2A38; /* Indigo-600 */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
        }

        .auth-left h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .auth-left p {
            font-size: 1.1rem;
            color: #c7d2fe;
        }

        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background-color: whitesmoke;
        }

        .auth-card {
            width: 100%;
            max-width: 400px;
        }

        .auth-card h2 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1f2937;
            text-align: center;
        }

        .auth-card p {
            font-size: 0.95rem;
            text-align: center;
            color: #6b7280;
            margin-bottom: 1.5rem;
        }

        .auth-card input {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            margin-top: 0.25rem;
            margin-bottom: 1.2rem;
            font-size: 0.95rem;
        }

        .auth-card label {
            font-size: 0.85rem;
            color: #374151;
        }

        .auth-card button {
            width: 100%;
            background-color: #4f46e5;
            color: white;
            padding: 0.6rem;
            font-weight: 600;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .auth-card button:hover {
            background-color: #4338ca;
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .auth-footer a {
            color: #4f46e5;
            text-decoration: underline;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-left, .auth-right {
                width: 100%;
                padding: 2rem;
                min-height: 50vh;
            }

            .auth-left {
                text-align: center;
            }
        }
    </style>

    <div class="auth-container">
        {{-- Left: iCommerce branding --}}
        <div class="auth-left">
            <div>
               <h1>Welcome to Online Shopping</h1>
<p>Discover a seamless shopping experience with top brands, exclusive deals, and fast delivery—all from the comfort of your home.</p>
            </div>
        </div>

        {{-- Right: Login Form --}}
        <div class="auth-right">
            <div class="auth-card">
                <x-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600 font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <h2>Sign in to your account</h2>
                <p>Use your credentials to access the platform</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required />
                    </div>

                    <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                        

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit">
                        Log in
                    </button>
                </form>

                @if (Route::has('register'))
                    <div class="auth-footer">
                        Don’t have an account?
                        <a href="{{ route('register') }}">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
