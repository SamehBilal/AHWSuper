<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('roles::components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone = '';
    public string $phone_key = '+20';
    public array $phone_keys = [
        ['id' => '+20', 'name' => 'Egypt (+20)'],
        ['id' => '+1', 'name' => 'United States (+1)'],
        ['id' => '+44', 'name' => 'United Kingdom (+44)'],
        ['id' => '+49', 'name' => 'Germany (+49)'],
        ['id' => '+33', 'name' => 'France (+33)'],
        ['id' => '+91', 'name' => 'India (+91)'],
        ['id' => '+81', 'name' => 'Japan (+81)'],
        ['id' => '+61', 'name' => 'Australia (+61)'],
        ['id' => '+86', 'name' => 'China (+86)'],
        ['id' => '+7', 'name' => 'Russia (+7)'],
        ['id' => '+39', 'name' => 'Italy (+39)'],
        ['id' => '+34', 'name' => 'Spain (+34)'],
        ['id' => '+55', 'name' => 'Brazil (+55)'],
        ['id' => '+27', 'name' => 'South Africa (+27)'],
        ['id' => '+82', 'name' => 'South Korea (+82)'],
        ['id' => '+66', 'name' => 'Thailand (+66)'],
        ['id' => '+60', 'name' => 'Malaysia (+60)'],
        ['id' => '+62', 'name' => 'Indonesia (+62)'],
        ['id' => '+63', 'name' => 'Philippines (+63)'],
        ['id' => '+351', 'name' => 'Portugal (+351)'],
        ['id' => '+34', 'name' => 'Spain (+34)'],
        ['id' => '+90', 'name' => 'Turkey (+90)'],
        ['id' => '+31', 'name' => 'Netherlands (+31)'],
        ['id' => '+32', 'name' => 'Belgium (+32)'],
        ['id' => '+41', 'name' => 'Switzerland (+41)'],

    ];

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
         <!-- Name -->
        <x-mary-input :label="__('Name')" wire:model="name" placeholder="{{ __('Full name') }}" inline clearable
            required autofocus autocomplete="name" />

       <!-- Email Address -->
        <x-mary-input :label="__('Email address')" type="email" wire:model="email" placeholder="email@example.com" inline clearable
            required autocomplete="email" />

        <x-mary-input :label="__('Phone')" wire:model="phone" inline required>
            <x-slot:prepend>
                <x-mary-select icon="o-phone" wire:model="phone_key" :options="$phone_keys" class="join-item {{-- bg-base-200 --}}" />
            </x-slot:prepend>
        </x-mary-input>

        <!-- Password -->
        <x-mary-password :label="__('Password')" wire:model="password" :placeholder="__('Password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="current-password" />

        <!-- Confirm Password -->
        <x-mary-password :label="__('Confirm Password')" wire:model="password_confirmation" :placeholder="__('Confirm Password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="new-password" />

         <div class="flex items-center justify-end">
            <x-mary-button label="{{ __('Create account') }}" type="submit" wire:click="register" class="w-full btn-primary"
                spinner />
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="underline" wire:navigate>{{ __('Log in') }}</a>
    </div>



    <div class="divider">or</div>

    <div class="flex flex-row gap-6">
        <!-- Google -->
        <x-mary-button class="btn btn-square bg-white text-black border-[#e5e5e5]" spinner>
            <svg aria-label="Google logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <g>
                    <path fill="#34a853" d="M153 292c30 82 118 95 171 60h62v48A192 192 0 0190 341"></path>
                    <path fill="#4285f4" d="m386 400a140 175 0 0053-179H260v74h102q-7 37-38 57"></path>
                    <path fill="#fbbc02" d="m90 341a208 200 0 010-171l63 49q-12 37 0 73"></path>
                    <path fill="#ea4335" d="m153 219c22-69 116-109 179-50l55-54c-78-75-230-72-297 55"></path>
                </g>
            </svg>
        </x-mary-button>

        <!-- GitHub -->
        <x-mary-button class="btn btn-square bg-black text-white border-black" spinner>
            <svg aria-label="GitHub logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24">
                <path fill="white"
                    d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z">
                </path>
            </svg>
        </x-mary-button>

        <!-- Facebook -->
        <x-mary-button class="btn btn-square bg-[#1A77F2] text-white border-[#005fd8]" spinner>
            <svg aria-label="Facebook logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 32 32">
                <path fill="white" d="M8 12h5V8c0-6 4-7 11-6v5c-4 0-5 0-5 3v2h5l-1 6h-4v12h-6V18H8z"></path>
            </svg>
        </x-mary-button>

        <!-- X -->
        <x-mary-button class="btn btn-square bg-black text-white border-black" spinner>
            <svg aria-label="X logo" width="24" height="24" viewBox="0 0 300 271"
                xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor"
                    d="m236 0h46l-101 115 118 156h-92.6l-72.5-94.8-83 94.8h-46l107-123-113-148h94.9l65.5 86.6zm-16.1 244h25.5l-165-218h-27.4z" />
            </svg>
        </x-mary-button>

        <!-- Apple -->
        <x-mary-button class="btn btn-square bg-black text-white border-black" spinner>
            <svg aria-label="Apple logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1195 1195">
                <path fill="white"
                    d="M1006.933 812.8c-32 153.6-115.2 211.2-147.2 249.6-32 25.6-121.6 25.6-153.6 6.4-38.4-25.6-134.4-25.6-166.4 0-44.8 32-115.2 19.2-128 12.8-256-179.2-352-716.8 12.8-774.4 64-12.8 134.4 32 134.4 32 51.2 25.6 70.4 12.8 115.2-6.4 96-44.8 243.2-44.8 313.6 76.8-147.2 96-153.6 294.4 19.2 403.2zM802.133 64c12.8 70.4-64 224-204.8 230.4-12.8-38.4 32-217.6 204.8-230.4z">
                </path>
            </svg>
        </x-mary-button>

        <!-- Amazon -->
        <x-mary-button class="btn btn-square bg-[#FF9900] text-black border-[#e17d00]" spinner>
            <svg aria-label="Amazon logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16">
                <g fill="black">
                    <path
                        d="M14.463 13.831c-1.753 1.294-4.291 1.981-6.478 1.981-3.066 0-5.825-1.131-7.912-3.019-.163-.147-.019-.35.178-.234 2.253 1.313 5.041 2.1 7.919 2.1 1.941 0 4.075-.403 6.041-1.238.294-.125.544.197.253.409z">
                    </path>
                    <path
                        d="M15.191 13c-.225-.287-1.481-.137-2.047-.069-.172.019-.197-.128-.044-.238 1.003-.703 2.647-.5 2.838-.266.194.238-.05 1.884-.991 2.672-.144.122-.281.056-.219-.103.216-.528.688-1.709.463-1.997zM11.053 11.838l.003.003c.387-.341 1.084-.95 1.478-1.278.156-.125.128-.334.006-.509-.353-.488-.728-.884-.728-1.784v-3c0-1.272.088-2.438-.847-3.313-.738-.706-1.963-.956-2.9-.956-1.831 0-3.875.684-4.303 2.947-.047.241.131.369.287.403l1.866.203c.175-.009.3-.181.334-.356.159-.778.813-1.156 1.547-1.156.397 0 .847.144 1.081.5.269.397.234.938.234 1.397v.25c-1.116.125-2.575.206-3.619.666-1.206.522-2.053 1.584-2.053 3.147 0 2 1.259 3 2.881 3 1.369 0 2.116-.322 3.172-1.403.35.506.463.753 1.103 1.284a.395.395 0 0 0 .456-.044zm-1.94-4.694c0 .75.019 1.375-.359 2.041-.306.544-.791.875-1.331.875-.737 0-1.169-.563-1.169-1.394 0-1.641 1.472-1.938 2.863-1.938v.416z">
                    </path>
                </g>
            </svg>
        </x-mary-button>
    </div>

    <div class="flex flex-row gap-6">
        <!-- Microsoft -->
        <x-mary-button class="btn btn-square bg-[#2F2F2F] text-white border-black" spinner>
            <svg aria-label="Microsoft logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <path d="M96 96H247V247H96" fill="#f24f23"></path>
                <path d="M265 96V247H416V96" fill="#7eba03"></path>
                <path d="M96 265H247V416H96" fill="#3ca4ef"></path>
                <path d="M265 265H416V416H265" fill="#f9ba00"></path>
            </svg>
        </x-mary-button>

        <!-- Slack -->
        <x-mary-button class="btn btn-square bg-[#622069] text-white border-[#591660]" spinner>
            <svg aria-label="Slack logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <g stroke-linecap="round" stroke-width="78">
                    <path stroke="#36c5f0" d="m110 207h97m0-97h.1v-.1"></path>
                    <path stroke="#2eb67d" d="m305 110v97m97 0v.1h.1"></path>
                    <path stroke="#ecb22e" d="m402 305h-97m0 97h-.1v.1"></path>
                    <path stroke="#e01e5a" d="M110 305h.1v.1m97 0v97"></path>
                </g>
            </svg>
        </x-mary-button>

        <!-- LinkedIn -->
        {{-- <x-mary-button class="btn btn-square bg-[#0967C2] text-white border-[#0059b3]" spinner>
            <svg aria-label="LinkedIn logo" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 32 32">
                <path fill="white"
                    d="M26.111,3H5.889c-1.595,0-2.889,1.293-2.889,2.889V26.111c0,1.595,1.293,2.889,2.889,2.889H26.111c1.595,0,2.889-1.293,2.889-2.889V5.889c0-1.595-1.293-2.889-2.889-2.889ZM10.861,25.389h-3.877V12.87h3.877v12.519Zm-1.957-14.158c-1.267,0-2.293-1.034-2.293-2.31s1.026-2.31,2.293-2.31,2.292,1.034,2.292,2.31-1.026,2.31-2.292,2.31Zm16.485,14.158h-3.858v-6.571c0-1.802-.685-2.809-2.111-2.809-1.551,0-2.362,1.048-2.362,2.809v6.571h-3.718V12.87h3.718v1.686s1.118-2.069,3.775-2.069,4.556,1.621,4.556,4.975v7.926Z"
                    fill-rule="evenodd"></path>
            </svg>
        </x-mary-button> --}}

        <!-- Twitch -->
        <x-mary-button class="btn btn-square bg-[#9147FF] text-white border-[#772ce8]" spinner>
            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="24px" height="24px" viewBox="0 0 512 512">
                <title>ionicons-v5_logos</title>
                <path d="M80,32,48,112V416h96v64h64l64-64h80L464,304V32ZM416,288l-64,64H256l-64,64V352H112V80H416Z" />
                <rect x="320" y="143" width="48" height="129" />
                <rect x="208" y="143" width="48" height="129" />
            </svg>
        </x-mary-button>

        <!-- TikTok -->
        <x-mary-button class="btn btn-square bg-black text-white border-black" spinner>
            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="21"
                viewBox="-0.32296740998066475 -3.1283528999801873 42.68446958125966 42.128352899980186">
                <g fill="none">
                    <path
                        d="M14 15.599v-1.486A13.1 13.1 0 0 0 12.337 14C5.535 14 0 19.18 0 25.547 0 29.452 2.086 32.91 5.267 35c-2.13-2.132-3.315-4.942-3.313-7.861 0-6.276 5.377-11.394 12.046-11.54"
                        fill="#00f2ea" />
                    <path
                        d="M14.327 32c2.876 0 5.221-2.273 5.328-5.107l.01-25.292h4.65A8.72 8.72 0 0 1 24.164 0h-6.35l-.011 25.293c-.106 2.832-2.453 5.105-5.328 5.105a5.329 5.329 0 0 1-2.476-.61A5.34 5.34 0 0 0 14.327 32m18.672-21.814V8.78a8.818 8.818 0 0 1-4.81-1.421A8.85 8.85 0 0 0 33 10.186"
                        fill="#00f2ea" />
                    <path
                        d="M28 7.718A8.63 8.63 0 0 1 25.832 2h-1.697A8.735 8.735 0 0 0 28 7.718M12.325 20.065c-2.94.004-5.322 2.361-5.325 5.27A5.267 5.267 0 0 0 9.854 30a5.2 5.2 0 0 1-1.008-3.073c.003-2.91 2.385-5.268 5.325-5.271.55 0 1.075.09 1.572.244v-6.4a11.72 11.72 0 0 0-1.572-.114c-.092 0-.183.006-.274.007v4.916a5.286 5.286 0 0 0-1.572-.244"
                        fill="#ff004f" />
                    <path
                        d="M32.153 11v4.884a15.15 15.15 0 0 1-8.813-2.811V25.84c0 6.377-5.23 11.565-11.658 11.565-2.485 0-4.789-.778-6.682-2.097A11.67 11.67 0 0 0 13.528 39c6.429 0 11.659-5.188 11.659-11.564V14.668A15.15 15.15 0 0 0 34 17.478v-6.283A8.87 8.87 0 0 1 32.153 11"
                        fill="#ff004f" />
                    <path
                        d="M23.979 25.42V12.632A15.741 15.741 0 0 0 33 15.448v-4.89a9.083 9.083 0 0 1-4.912-2.82C26.016 6.431 24.586 4.358 24.132 2h-4.747l-.01 25.215c-.11 2.824-2.505 5.09-5.44 5.09-1.754-.002-3.398-.822-4.42-2.204-1.794-.913-2.919-2.716-2.92-4.682.003-2.92 2.44-5.285 5.45-5.289.56 0 1.098.09 1.608.245v-4.933C7.202 15.589 2 20.722 2 27.016c0 3.045 1.219 5.816 3.205 7.885A12.115 12.115 0 0 0 12.045 37c6.58 0 11.934-5.195 11.934-11.58"
                        fill="#fff" />
                </g>
            </svg>
        </x-mary-button>

        <!-- Discord -->
        <x-mary-button class="btn btn-square bg-[#5865F2] text-white border-[#404eed]" spinner>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 -28.5 256 256" version="1.1" preserveAspectRatio="xMidYMid">
                <g>
                    <path
                        d="M216.856339,16.5966031 C200.285002,8.84328665 182.566144,3.2084988 164.041564,0 C161.766523,4.11318106 159.108624,9.64549908 157.276099,14.0464379 C137.583995,11.0849896 118.072967,11.0849896 98.7430163,14.0464379 C96.9108417,9.64549908 94.1925838,4.11318106 91.8971895,0 C73.3526068,3.2084988 55.6133949,8.86399117 39.0420583,16.6376612 C5.61752293,67.146514 -3.4433191,116.400813 1.08711069,164.955721 C23.2560196,181.510915 44.7403634,191.567697 65.8621325,198.148576 C71.0772151,190.971126 75.7283628,183.341335 79.7352139,175.300261 C72.104019,172.400575 64.7949724,168.822202 57.8887866,164.667963 C59.7209612,163.310589 61.5131304,161.891452 63.2445898,160.431257 C105.36741,180.133187 151.134928,180.133187 192.754523,160.431257 C194.506336,161.891452 196.298154,163.310589 198.110326,164.667963 C191.183787,168.842556 183.854737,172.420929 176.223542,175.320965 C180.230393,183.341335 184.861538,190.991831 190.096624,198.16893 C211.238746,191.588051 232.743023,181.531619 254.911949,164.955721 C260.227747,108.668201 245.831087,59.8662432 216.856339,16.5966031 Z M85.4738752,135.09489 C72.8290281,135.09489 62.4592217,123.290155 62.4592217,108.914901 C62.4592217,94.5396472 72.607595,82.7145587 85.4738752,82.7145587 C98.3405064,82.7145587 108.709962,94.5189427 108.488529,108.914901 C108.508531,123.290155 98.3405064,135.09489 85.4738752,135.09489 Z M170.525237,135.09489 C157.88039,135.09489 147.510584,123.290155 147.510584,108.914901 C147.510584,94.5396472 157.658606,82.7145587 170.525237,82.7145587 C183.391518,82.7145587 193.761324,94.5189427 193.539891,108.914901 C193.539891,123.290155 183.391518,135.09489 170.525237,135.09489 Z"
                        fill="#fff" fill-rule="nonzero">

                    </path>
                </g>
            </svg>
        </x-mary-button>

        <!-- Riot Games -->
        <x-mary-button class="btn btn-square bg-[#D32936] text-white border-[#b71c27]" spinner>
            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="24px" height="24px"
                viewBox="0 0 24 24" role="img">
                <title>Riot Games icon</title>
                <path
                    d="M12.534 21.77l-1.09-2.81 10.52.54-.451 4.5zM15.06 0L.307 6.969 2.59 17.471H5.6l-.52-7.512.461-.144 1.81 7.656h3.126l-.116-9.15.462-.144 1.582 9.294h3.31l.78-11.053.462-.144.82 11.197h4.376l1.54-15.37Z" />
            </svg>
        </x-mary-button>
    </div>
</div>
