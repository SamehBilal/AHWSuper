@php
    $formId = $formId ?? uniqid('login_');
@endphp
<div>
    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <div class="flex mt-10 flex-col gap-6 w-full">
        <!-- Email Address -->
        <x-mary-input id="email-{{ $formId }}" :label="__('Email address')" type="email" placeholder="email@example.com"
            inline clearable required />

        <div class="relative">
            <!-- Forgot Password Link -->

            <a class="absolute underline end-0 top-0 text-sm">
                {{ __('Forgot your password?') }}
            </a>

        </div>

        <!-- Password -->
        <x-mary-password id="password-{{ $formId }}" :label="__('Password')" :placeholder="__('Password')"
            password-icon="o-lock-closed" password-visible-icon="o-lock-open" inline right required />

        <!-- Remember Me -->
        <x-mary-checkbox id="remember-{{ $formId }}" :label="__('Remember me for 30 days')" />

        <div class="flex items-center justify-end">
            <x-mary-button label="{{ __('Log in') }}" class="w-full btn-primary" spinner />
        </div>
    </div>

    <div class="divider">or</div>

    <div class="flex  flex-col gap-3 w-full">


        <!-- Google -->
        <button class="btn bg-white text-black border-[#e5e5e5] w-full">
            <svg aria-label="Google logo" width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <g>
                    <path d="m0 0H512V512H0" fill="#fff"></path>
                    <path fill="#34a853" d="M153 292c30 82 118 95 171 60h62v48A192 192 0 0190 341">
                    </path>
                    <path fill="#4285f4" d="m386 400a140 175 0 0053-179H260v74h102q-7 37-38 57">
                    </path>
                    <path fill="#fbbc02" d="m90 341a208 200 0 010-171l63 49q-12 37 0 73"></path>
                    <path fill="#ea4335" d="m153 219c22-69 116-109 179-50l55-54c-78-75-230-72-297 55">
                    </path>
                </g>
            </svg>
            Login with Google
        </button>

        <!-- Large Button with Full Text -->
        <button
            class="ahw-btn btn bg-primary text-white px-6 py-2 rounded-lg flex items-center justify-between  border-primary text-base shadow-lg hover:shadow-lg hover:ring-6 hover:ring-primary/60 transition-all duration-200">
            <i class="fas fa-sign-in-alt text-lg">
                <img src="{{ asset('button-arrow.png') }}" alt="" height="20">
            </i>
            <span class="flex-1 text-center mx-4">تسجيل الدخول <span class="font-[600]!">بواسطة عرب
                    هاردوير</span></span>
            <i class="fas fa-chevron-left text-lg">
                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
            </i>
        </button>
    </div>
</div>
