<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.admin')] class extends Component {
    use Toast;
    public $author;
    public $message;
    public $user;
    public $clients;
    public $pageTitle = 'Arabhardware | Developers';

    public function mount()
    {
        [$this->message, $this->author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
        $this->user = Auth::user();
        $this->loadClients($this->user);
    }

    public function loadClients($user)
    {
        $this->clients = $user->oauthApps()->get();
    }
}; ?>
<div class="max-w-7xl mx-auto min-h-screen ">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Introduction -->
            <x-mary-card
                class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
                <x-slot:title>
                    <h2 class=" text-2xl flex gap-1 mb-4">
                        <img class="text-red-500 h-8" src="{{ asset('login.webp') }}" alt="">
                        Login with Arabhardware
                    </h2>
                </x-slot:title>
                <p class="text-sm mb-5">Integrate Arab Hardware's OAuth authentication into your application to allow
                    users to
                    log in
                    securely using their Arab Hardware accounts. This provides a seamless authentication experience
                    for your users.</p>

                <x-mary-alert title="Dismissible"
                    description="Make sure to register your application in the Arabhardware Developer Portal to get your
                            Client ID and Client Secret."
                    icon="o-exclamation-triangle" dismissible />

            </x-mary-card>

            <!-- Button Examples -->
            <x-mary-card
                class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
                <x-slot:title>
                    <h2 class=" text-xl mb-4">
                        Button Examples
                    </h2>
                </x-slot:title>

                <!-- Large Button -->
                <div class="mb-8">
                    <h4 class="text-lg font-medium mb-3">Large Button</h4>
                    <div class="alert p-6 rounded-lg mb-4">
                        <button
                            class="btn bg-primary text-white  py-6  rounded-lg flex items-center justify-between  border-primary text-base shadow-lg">
                            <i class="fas fa-sign-in-alt text-lg">
                                <img src="{{ asset('button-arrow.png') }}" alt="" height="20">
                            </i>
                            <span class="flex-1 text-center mx-4">تسجيل الدخول <span class="font-semibold">بواسطة عرب
                                    هاردوير</span></span>
                            <i class="fas fa-chevron-left text-lg">
                                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
                            </i>
                        </button>
                    </div>
                    <div class="code-highlight text-xs relative group">
                        <!-- Copy button (optional) -->
                        {{-- <x-mary-button icon="o-plus" class="absolute top-2 right-2 btn-circle btn-ghost btn-xs" tooltip-left="Create" /> --}}
                        <button
                            class="absolute top-2 right-2 btn btn-xs btn-primary opacity-0 group-hover:opacity-100 transition-opacity"
                            onclick="copyCodeToClipboard(this)" title="Copy code" tooltip-left="Create">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </button>
<pre><code class="language-html rounded-lg p-18">&lt;!-- Arab Hardware Login Button --&gt;
&lt;button id="ahw-login-btn" style="background:#d32f2f;color:#fff;padding:16px 32px;border:none;
    border-radius:8px;display:flex;align-items:center;gap:12px;font-size:16px;box-shadow:0 2px 8px #0001;
    cursor:pointer;" onclick="ahwLogin()"&gt;
        &lt;img src=\"https://yourdomain.com/button-arrow.png\" alt=\"\" height=\"20\" /&gt;
        &lt;span&gt;تسجيل الدخول بواسطة عرب هاردوير&lt;/span&gt;
        &lt;img src=\"https://yourdomain.com/button_logo.png\" alt=\"\" height=\"20\" /&gt;
&lt;/button&gt;
&lt;script&gt;
    function ahwLogin() {
        var clientId = 'YOUR_CLIENT_ID';
        var redirectUri = 'YOUR_REDIRECT_URI';
        var authUrl = 'https://api.arabhardware.net/oauth/authorize?'+
            'client_id=' + encodeURIComponent(clientId) +
            '&redirect_uri=' + encodeURIComponent(redirectUri) +
            '&response_type=code&scope=profile email';
        window.location.href = authUrl;
    }
&lt;/script&gt;</code></pre>
                    </div>
                </div>

                <!-- Medium Button -->
                <div class="mb-8">
                    <h4 class="text-lg font-medium mb-3">Medium Button</h4>
                    <div class="alert p-6 rounded-lg mb-4">
                        <button
                            class="btn bg-primary text-white  py-6  rounded-lg flex items-center justify-between  border-primary text-base shadow-lg">
                            <i class="fas fa-sign-in-alt text-lg">
                                <img src="{{ asset('button-arrow.png') }}" alt="" height="20">
                            </i>
                            <span class="flex-1 text-center mx-4">الدخول <span class="font-semibold">بواسطة عرب
                                    هاردوير</span></span>
                            <i class="fas fa-chevron-left text-lg">
                                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
                            </i>
                        </button>
                    </div>
                    <div class="code-highlight text-xs relative group">
                        <!-- Copy button (optional) -->
                        {{-- <x-mary-button icon="o-plus" class="absolute top-2 right-2 btn-circle btn-ghost btn-xs" tooltip-left="Create" /> --}}
                        <button
                            class="absolute top-2 right-2 btn btn-xs btn-primary opacity-0 group-hover:opacity-100 transition-opacity"
                            onclick="copyCodeToClipboard(this)" title="Copy code" tooltip-left="Create">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </button>
<pre><code class="language-html rounded-lg p-18">&lt;!-- Arab Hardware Login Button --&gt;
&lt;button id="ahw-login-btn" style="background:#d32f2f;color:#fff;padding:16px 32px;border:none;
    border-radius:8px;display:flex;align-items:center;gap:12px;font-size:16px;box-shadow:0 2px 8px #0001;
    cursor:pointer;" onclick="ahwLogin()"&gt;
        &lt;img src=\"https://yourdomain.com/button-arrow.png\" alt=\"\" height=\"20\" /&gt;
        &lt;span&gt;الدخول بواسطة عرب هاردوير&lt;/span&gt;
        &lt;img src=\"https://yourdomain.com/button_logo.png\" alt=\"\" height=\"20\" /&gt;
&lt;/button&gt;
&lt;script&gt;
    function ahwLogin() {
        var clientId = 'YOUR_CLIENT_ID';
        var redirectUri = 'YOUR_REDIRECT_URI';
        var authUrl = 'https://api.arabhardware.net/oauth/authorize?'+
            'client_id=' + encodeURIComponent(clientId) +
            '&redirect_uri=' + encodeURIComponent(redirectUri) +
            '&response_type=code&scope=profile email';
        window.location.href = authUrl;
    }
&lt;/script&gt;</code></pre>
                    </div>
                </div>

                <!-- Small Buttons -->
                <div class="mb-8">
                    <h4 class="text-lg font-medium  mb-3">Small Buttons</h4>
                    <div class="alert p-6 rounded-lg mb-4 flex items-center space-x-4">
                        <button
                            class="btn bg-primary text-white  py-6  rounded-lg flex items-center justify-between  border-primary text-base shadow-lg">
                            <i class="fas fa-sign-in-alt text-lg">
                                <img src="{{ asset('button-arrow.png') }}" alt="" height="20">
                            </i>
                            <i class="fas fa-chevron-left text-lg">
                                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
                            </i>
                        </button>
                        <button
                            class="btn bg-primary text-white  py-6  rounded-lg flex items-center justify-between  border-primary text-base shadow-lg">
                            <i class="fas fa-chevron-left text-lg">
                                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
                            </i>
                        </button>
                    </div>
                    <div class="code-highlight text-xs relative group">
                        <!-- Copy button (optional) -->
                        {{-- <x-mary-button icon="o-plus" class="absolute top-2 right-2 btn-circle btn-ghost btn-xs" tooltip-left="Create" /> --}}
                        <button
                            class="absolute top-2 right-2 btn btn-xs btn-primary opacity-0 group-hover:opacity-100 transition-opacity"
                            onclick="copyCodeToClipboard(this)" title="Copy code" tooltip-left="Create">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </button>
<pre><code class="language-html rounded-lg p-18">&lt;!-- Arab Hardware Login Button --&gt;
&lt;button id="ahw-login-btn" style="background:#d32f2f;color:#fff;padding:16px 32px;border:none;
    border-radius:8px;display:flex;align-items:center;gap:12px;font-size:16px;box-shadow:0 2px 8px #0001;
    cursor:pointer;" onclick="ahwLogin()"&gt;
        &lt;img src=\"https://yourdomain.com/button-arrow.png\" alt=\"\" height=\"20\" /&gt;
        &lt;img src=\"https://yourdomain.com/button_logo.png\" alt=\"\" height=\"20\" /&gt;
&lt;/button&gt;
&lt;script&gt;
    function ahwLogin() {
        var clientId = 'YOUR_CLIENT_ID';
        var redirectUri = 'YOUR_REDIRECT_URI';
        var authUrl = 'https://api.arabhardware.net/oauth/authorize?'+
            'client_id=' + encodeURIComponent(clientId) +
            '&redirect_uri=' + encodeURIComponent(redirectUri) +
            '&response_type=code&scope=profile email';
        window.location.href = authUrl;
    }
&lt;/script&gt;</code></pre>
                    </div>
                </div>

            </x-mary-card>

            <!-- Introduction -->
            <x-mary-card
                class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
                <x-slot:title>
                    <h2 class=" text-2xl mb-4">
                        Implementation Guide
                    </h2>
                </x-slot:title>
                <p class="text-sm mb-5">Integrate Arab Hardware's OAuth authentication into your application to allow
                    users to
                    log in
                    securely using their Arab Hardware accounts. This provides a seamless authentication experience
                    for your users.</p>

                <div class="flex justify-center text-center items-center ">
                    <ul class="timeline timeline-vertical lg:timeline-horizontal">
                        <li>
                            <div class="timeline-start">Register Your App</div>
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-end timeline-box">Create an application in <br /> Arabhardware
                                Developer<br />
                                Portal
                            </div>
                            <hr />
                        </li>
                        <li>
                            <hr />
                            <div class="timeline-start">Get Credentials</div>
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-end timeline-box">Obtain your Client ID <br /> and Client Secret</div>
                            <hr />
                        </li>
                        <li>
                            <hr />
                            <div class="timeline-start">Implement OAuth</div>
                            <div class="timeline-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="timeline-end timeline-box">Add OAuth flow to<br /> your application</div>
                            {{-- <hr /> --}}
                        </li>
                    </ul>
                </div>



                <div class="mt-8 space-y-6">
                    <div>
                        <h4 class="text-lg font-medium  mb-3">OAuth Flow</h4>
                        <div class="mockup-code">
                            <pre><code>// 1. Redirect user to authorization URL
const authUrl = `https://api.arabhardware.net/oauth/authorize?` +
`client_id=${CLIENT_ID}&` +
`redirect_uri=${REDIRECT_URI}&` +
`response_type=code&` +
`scope=profile email`;

window.location.href = authUrl;

// 2. Handle the callback and exchange code for token
const tokenResponse = await fetch('https://api.arabhardware.net/oauth/token', {
method: 'POST',
headers: { 'Content-Type': 'application/json' },
body: JSON.stringify({
    client_id: CLIENT_ID,
    client_secret: CLIENT_SECRET,
    code: authCode,
    grant_type: 'authorization_code'
})
});

const { access_token } = await tokenResponse.json();</code></pre>
                        </div>
                    </div>
                </div>

            </x-mary-card>

        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 flex flex-col min-h-screen">
            <div class="space-y-6 sticky top-20 ">
                <!-- Quick Start -->
                <div class="card  shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg text-gray-900 mb-4">
                            <i class="fas fa-rocket text-blue-500 mr-2"></i>
                            Quick Start
                        </h3>
                        <div class="space-y-3">
                            <a href="#"
                                class="block p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-blue-700">Developer Portal</span>
                                    <i class="fas fa-external-link-alt text-blue-500"></i>
                                </div>
                            </a>
                            <a href="#"
                                class="block p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-green-700">API Documentation</span>
                                    <i class="fas fa-book text-green-500"></i>
                                </div>
                            </a>
                            <a href="#"
                                class="block p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-purple-700">SDK Downloads</span>
                                    <i class="fas fa-download text-purple-500"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- OAuth Endpoints -->
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg text-gray-900 mb-4">
                            <i class="fas fa-server text-green-500 mr-2"></i>
                            OAuth Endpoints
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <div class="font-medium text-gray-700 mb-1">Authorization URL</div>
                                <code
                                    class="text-xs bg-gray-100 p-2 rounded block break-all">https://api.arabhardware.net/oauth/authorize</code>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700 mb-1">Token URL</div>
                                <code
                                    class="text-xs bg-gray-100 p-2 rounded block break-all">https://api.arabhardware.net/oauth/token</code>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700 mb-1">User Info</div>
                                <code
                                    class="text-xs bg-gray-100 p-2 rounded block break-all">https://api.arabhardware.net/user</code>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supported Scopes -->
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg text-gray-900 mb-4">
                            <i class="fas fa-shield-alt text-orange-500 mr-2"></i>
                            Supported Scopes
                        </h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center space-x-2">
                                <div class="badge badge-outline badge-sm">profile</div>
                                <span class="text-gray-600">Basic profile information</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="badge badge-outline badge-sm">email</div>
                                <span class="text-gray-600">Email address</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="badge badge-outline badge-sm">posts</div>
                                <span class="text-gray-600">Read user posts</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support -->
                <div class="card bg-gradient-to-br from-red-500 to-red-600 text-white shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <i class="fas fa-headset mr-2"></i>
                            Need Help?
                        </h3>
                        <p class="text-sm text-red-100 mb-4">
                            Our developer support team is here to help you integrate successfully.
                        </p>
                        <button
                            class="btn btn-outline btn-sm text-white border-white hover:bg-white hover:text-red-500">
                            <i class="fas fa-envelope mr-2"></i>
                            Contact Support
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Add interactive functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Copy code functionality
        document.querySelectorAll('.mockup-code pre').forEach(pre => {
            pre.addEventListener('click', function() {
                navigator.clipboard.writeText(this.textContent);

                // Show toast notification
                const toast = document.createElement('div');
                toast.className = 'toast toast-top toast-end';
                toast.innerHTML = `
                        <div class="alert alert-success">
                            <span>Code copied to clipboard!</span>
                        </div>
                    `;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);
            });
        });
    });
</script>

@script
    <script>
        // Copy function for the code block
        function copyCodeToClipboard(button) {
            const codeBlock = button.parentElement.querySelector('code');
            const text = codeBlock.textContent;

            navigator.clipboard.writeText(text).then(() => {
                // Change button appearance temporarily
                const originalHTML = button.innerHTML;
                button.innerHTML = `
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        `;
                button.classList.add('btn-success');

                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('btn-success');
                }, 2000);
            }).catch(() => {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
            });
        }

        // Initialize highlighting for this component
        document.addEventListener('livewire:updated', () => {
            if (window.hljs) {
                // Re-highlight only the code blocks in this component
                $el.querySelectorAll('pre code').forEach((block) => {
                    hljs.highlightElement(block);
                });
            }
        });

        // Initial highlight
        if (window.hljs) {
            $el.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightElement(block);
            });
        }
    </script>
@endscript
