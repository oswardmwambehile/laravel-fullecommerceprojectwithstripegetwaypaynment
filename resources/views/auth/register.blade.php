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
            background-color: #4f46e5;
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

            .auth-left,
            .auth-right {
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
        <!-- Left Side -->
        <div class="auth-left">
            <div>
                <h1>Join Our Shopping Community</h1>
                <p>Create an account to enjoy the best shopping deals and features.</p>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="auth-right">
            <div class="auth-card">
                <x-validation-errors class="mb-4" />

                <h2>Create an account</h2>
                <p>Fill out the form to register</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required />
                    </div>

                    <div>
                        <label for="phone">Phone Number</label>
                        <input id="phone" type="text" name="phone" :value="old('phone')" required />
                    </div>

                    <div>
                        <label for="address">Address</label>
                        <input id="address" type="text" name="address" :value="old('address')" required />
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required />
                    </div>

                    <div>
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4 text-sm text-gray-600">
                            <label for="terms" class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <span class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </span>
                            </label>
                        </div>
                    @endif

                    <button type="submit">Register</button>
                </form>

                <div class="auth-footer">
                    Already have an account?
                    <a href="{{ route('login') }}">Log in</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
