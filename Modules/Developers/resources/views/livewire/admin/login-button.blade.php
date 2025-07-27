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

                <x-mary-alert title="Reminder"
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
                            class="ahw-btn btn bg-primary text-white py-6 rounded-lg flex items-center justify-between  border-primary text-base shadow-lg hover:shadow-lg hover:ring-6 hover:ring-primary/60 transition-all duration-200">
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
                    <div class="mockup-code bg-[#282a36] code-highlight text-xs relative group">
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
&lt;button id="ahw-login-btn" style="background: #d32f2f;color: #fff;padding: 16px 32px;border: none;
    border-radius: 8px;display: flex;align-items: center;gap: 12px;font-size: 16px;font-family: inherit;
    font-weight: 500;box-shadow: 0 2px 8px rgba(211,47,47,0.15);cursor: pointer;
    transition: box-shadow 0.2s, outline 0.2s;outline: none;position: relative;"
    onmouseover="this.style.boxShadow='0 0 0 6px rgba(211,47,47,0.18), 0 6px 16px rgba(211,47,47,0.15)'"
    onmouseout="this.style.boxShadow='0 4px 16px rgba(211,47,47,0.15)'" onclick="ahwLogin()"&gt;
        &lt;img src="{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/button-arrow.png" alt="Arabhardware" height="20" /&gt;
        &lt;span&gt;تسجيل الدخول &lt;span style="font-weight:600;" &gt; بواسطة عرب هاردوير &lt;/span&gt; &lt;/span&gt;
        &lt;img src="{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/button_logo.png" alt="Arabhardware" height="20" /&gt;
&lt;/button&gt;
&lt;script&gt;
    function ahwLogin() {
        var clientId = 'YOUR_CLIENT_ID';
        var redirectUri = 'YOUR_REDIRECT_URI';
        var authUrl = '{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/authorize?'+
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
                            class="ahw-btn btn bg-primary text-white  py-6  rounded-lg flex items-center justify-between  border-primary text-base shadow-lg hover:shadow-lg hover:ring-6 hover:ring-primary/60 transition-all duration-200">
                            <i class="fas fa-sign-in-alt text-lg">
                                <img src="{{ asset('button-arrow.png') }}" alt="" height="20">
                            </i>
                            <span class="flex-1 text-center mx-4">الدخول <span class="font-[600]!">بواسطة عرب
                                    هاردوير</span></span>
                            <i class="fas fa-chevron-left text-lg">
                                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
                            </i>
                        </button>
                    </div>
                    <div class="mockup-code bg-[#282a36] code-highlight text-xs relative group">
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
&lt;button id="ahw-login-btn" style="background: #d32f2f;color: #fff;padding: 16px 32px;border: none;
    border-radius: 8px;display: flex;align-items: center;gap: 12px;font-size: 16px;font-family: inherit;
    font-weight: 500;box-shadow: 0 2px 8px rgba(211,47,47,0.15);cursor: pointer;
    transition: box-shadow 0.2s, outline 0.2s;outline: none;position: relative;"
    onmouseover="this.style.boxShadow='0 0 0 6px rgba(211,47,47,0.18), 0 6px 16px rgba(211,47,47,0.15)'"
    onmouseout="this.style.boxShadow='0 4px 16px rgba(211,47,47,0.15)'" onclick="ahwLogin()"&gt;
        &lt;img src="{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/button-arrow.png" alt="Arabhardware" height="20" /&gt;
        &lt;span&gt;الدخول &lt;span style="font-weight:600;" &gt; بواسطة عرب هاردوير &lt;/span&gt; &lt;/span&gt;
        &lt;img src="{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/button_logo.png" alt="Arabhardware" height="20" /&gt;
&lt;/button&gt;
&lt;script&gt;
    function ahwLogin() {
        var clientId = 'YOUR_CLIENT_ID';
        var redirectUri = 'YOUR_REDIRECT_URI';
        var authUrl = '{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/authorize?'+
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
                            class="btn bg-primary text-white  py-6  rounded-lg flex items-center justify-between  border-primary text-base shadow-lg hover:shadow-lg hover:ring-6 hover:ring-primary/60 transition-all duration-200">
                            <i class="fas fa-sign-in-alt text-lg">
                                <img src="{{ asset('button-arrow.png') }}" alt="" height="20">
                            </i>
                            <i class="fas fa-chevron-left text-lg">
                                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
                            </i>
                        </button>
                        <button
                            class="btn bg-primary text-white  py-6  rounded-lg flex items-center justify-between  border-primary text-base shadow-lg hover:shadow-lg hover:ring-6 hover:ring-primary/60 transition-all duration-200">
                            <i class="fas fa-chevron-left text-lg">
                                <img src="{{ asset('button_logo.png') }}" alt="" height="20">
                            </i>
                        </button>
                    </div>

                    <!-- name of each tab group should be unique -->
                    <div class="tabs tabs-lift tabs-bottom">
                        <input type="radio" name="my_tabs_5" class="tab" aria-label="With arrow"
                            checked="checked" />
                        <div class="tab-content bg-base-100 border-base-300 p-6">
                            <div class="mockup-code bg-[#282a36] code-highlight text-xs relative group">
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
&lt;button id="ahw-login-btn" style="background: #d32f2f;color: #fff;padding: 16px 32px;border: none;
    border-radius: 8px;display: flex;align-items: center;gap: 12px;font-size: 16px;font-family: inherit;
    font-weight: 500;box-shadow: 0 2px 8px rgba(211,47,47,0.15);cursor: pointer;
    transition: box-shadow 0.2s, outline 0.2s;outline: none;position: relative;"
    onmouseover="this.style.boxShadow='0 0 0 6px rgba(211,47,47,0.18), 0 6px 16px rgba(211,47,47,0.15)'"
    onmouseout="this.style.boxShadow='0 4px 16px rgba(211,47,47,0.15)'" onclick="ahwLogin()"&gt;
        &lt;img src="{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/button-arrow.png" alt="Arabhardware" height="20" /&gt;
        &lt;img src="{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/button_logo.png" alt="Arabhardware" height="20" /&gt;
&lt;/button&gt;
&lt;script&gt;
    function ahwLogin() {
        var clientId = 'YOUR_CLIENT_ID';
        var redirectUri = 'YOUR_REDIRECT_URI';
        var authUrl = '{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/authorize?'+
            'client_id=' + encodeURIComponent(clientId) +
            '&redirect_uri=' + encodeURIComponent(redirectUri) +
            '&response_type=code&scope=profile email';
        window.location.href = authUrl;
    }
&lt;/script&gt;</code></pre>
                            </div>
                        </div>

                        <input type="radio" name="my_tabs_5" class="tab" aria-label="Without arrow" />
                        <div class="tab-content bg-base-100 border-base-300 p-6">
                            <div class="mockup-code bg-[#282a36] code-highlight text-xs relative group">
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
&lt;button id="ahw-login-btn" style="background: #d32f2f;color: #fff;padding: 16px 32px;border: none;
    border-radius: 8px;display: flex;align-items: center;gap: 12px;font-size: 16px;
    font-family: inherit;font-weight: 500;box-shadow: 0 2px 8px rgba(211,47,47,0.15);cursor: pointer;
    transition: box-shadow 0.2s, outline 0.2s;outline: none;position: relative;"
    onmouseover="this.style.boxShadow='0 0 0 6px rgba(211,47,47,0.18), 0 6px 16px rgba(211,47,47,0.15)'"
    onmouseout="this.style.boxShadow='0 4px 16px rgba(211,47,47,0.15)'" onclick="ahwLogin()"&gt;
        &lt;img src="{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/button_logo.png" alt="Arabhardware" height="20" /&gt;
&lt;/button&gt;
&lt;script&gt;
    function ahwLogin() {
        var clientId = 'YOUR_CLIENT_ID';
        var redirectUri = 'YOUR_REDIRECT_URI';
        var authUrl = '{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/authorize?'+
            'client_id=' + encodeURIComponent(clientId) +
            '&redirect_uri=' + encodeURIComponent(redirectUri) +
            '&response_type=code&scope=profile email';
        window.location.href = authUrl;
    }
&lt;/script&gt;</code></pre>
                            </div>
                        </div>
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
                        <div class="mockup-code bg-[#282a36]">
                            <pre><code>// 1. Redirect user to authorization URL
const authUrl = `{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/authorize?` +
`client_id=${CLIENT_ID}&` +
`redirect_uri=${REDIRECT_URI}&` +
`response_type=code&` +
`scope=profile email`;

window.location.href = authUrl;

// 2. Handle the callback and exchange code for token
const tokenResponse = await fetch('{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/token', {
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
        <livewire:partials.admin.right-sidebar />
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
