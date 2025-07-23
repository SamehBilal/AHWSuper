<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Arab Hardware - OAuth Integration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-microchip text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Arab Hardware</h1>
                        <p class="text-sm text-gray-500">OAuth Integration</p>
                    </div>
                </div>
                <div class="badge badge-primary">Developer Docs</div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Introduction -->
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-2xl text-gray-900 mb-4">
                            <i class="fas fa-sign-in-alt text-red-500 mr-2"></i>
                            Login with Arab Hardware
                        </h2>
                        <p class="text-gray-700 mb-6">
                            Integrate Arab Hardware's OAuth authentication into your application to allow users to log in securely using their Arab Hardware accounts. This provides a seamless authentication experience for your users.
                        </p>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <span>Make sure to register your application in the Arab Hardware Developer Portal to get your Client ID and Client Secret.</span>
                        </div>
                    </div>
                </div>

                <!-- Button Examples -->
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Button Examples</h3>

                        <!-- Large Button -->
                        <div class="mb-8">
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Large Button</h4>
                            <div class="bg-gray-50 p-6 rounded-lg mb-4">
                                <button class="btn bg-red-500 hover:bg-red-600 border-0 text-white px-8 py-3 text-base rounded-lg flex items-center space-x-3 shadow-md transition-all duration-200 hover:shadow-lg">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span class="font-medium">تسجيل الدخول بواسطة عرب هاردوير</span>
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <div class="mockup-code text-xs">
                                <pre><code>&lt;button class="btn bg-red-500 hover:bg-red-600 border-0 text-white px-8 py-3 text-base rounded-lg flex items-center space-x-3 shadow-md"&gt;
    &lt;i class="fas fa-sign-in-alt"&gt;&lt;/i&gt;
    &lt;span&gt;تسجيل الدخول بواسطة عرب هاردوير&lt;/span&gt;
    &lt;i class="fas fa-chevron-right"&gt;&lt;/i&gt;
&lt;/button&gt;</code></pre>
                            </div>
                        </div>

                        <!-- Medium Button -->
                        <div class="mb-8">
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Medium Button</h4>
                            <div class="bg-gray-50 p-6 rounded-lg mb-4">
                                <button class="btn bg-red-500 hover:bg-red-600 border-0 text-white px-6 py-2 text-sm rounded-lg flex items-center space-x-2 shadow-md transition-all duration-200 hover:shadow-lg">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>الدخول بواسطة عرب هاردوير</span>
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <div class="mockup-code text-xs">
                                <pre><code>&lt;button class="btn bg-red-500 hover:bg-red-600 border-0 text-white px-6 py-2 text-sm rounded-lg flex items-center space-x-2 shadow-md"&gt;
    &lt;i class="fas fa-sign-in-alt"&gt;&lt;/i&gt;
    &lt;span&gt;الدخول بواسطة عرب هاردوير&lt;/span&gt;
    &lt;i class="fas fa-chevron-right"&gt;&lt;/i&gt;
&lt;/button&gt;</code></pre>
                            </div>
                        </div>

                        <!-- Small Buttons -->
                        <div class="mb-8">
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Small Buttons</h4>
                            <div class="bg-gray-50 p-6 rounded-lg mb-4 flex items-center space-x-4">
                                <button class="btn bg-red-500 hover:bg-red-600 border-0 text-white px-4 py-2 text-xs rounded-lg flex items-center space-x-1 shadow-md">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <button class="btn bg-red-500 hover:bg-red-600 border-0 text-white p-3 rounded-lg shadow-md">
                                    <i class="fas fa-sign-in-alt"></i>
                                </button>
                            </div>
                            <div class="mockup-code text-xs">
                                <pre><code>&lt;button class="btn bg-red-500 hover:bg-red-600 border-0 text-white px-4 py-2 text-xs rounded-lg flex items-center space-x-1 shadow-md"&gt;
    &lt;i class="fas fa-sign-in-alt"&gt;&lt;/i&gt;
    &lt;i class="fas fa-chevron-right"&gt;&lt;/i&gt;
&lt;/button&gt;</code></pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Implementation Guide -->
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Implementation Guide</h3>

                        <div class="steps w-full">
                            <div class="step step-primary">
                                <div class="step-content">
                                    <h4 class="font-semibold text-gray-800">Register Your App</h4>
                                    <p class="text-sm text-gray-600">Create an application in Arab Hardware Developer Portal</p>
                                </div>
                            </div>
                            <div class="step step-primary">
                                <div class="step-content">
                                    <h4 class="font-semibold text-gray-800">Get Credentials</h4>
                                    <p class="text-sm text-gray-600">Obtain your Client ID and Client Secret</p>
                                </div>
                            </div>
                            <div class="step step-primary">
                                <div class="step-content">
                                    <h4 class="font-semibold text-gray-800">Implement OAuth</h4>
                                    <p class="text-sm text-gray-600">Add OAuth flow to your application</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 space-y-6">
                            <div>
                                <h4 class="text-lg font-medium text-gray-800 mb-3">OAuth Flow</h4>
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
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Start -->
                <div class="card bg-white shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-lg text-gray-900 mb-4">
                            <i class="fas fa-rocket text-blue-500 mr-2"></i>
                            Quick Start
                        </h3>
                        <div class="space-y-3">
                            <a href="#" class="block p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-blue-700">Developer Portal</span>
                                    <i class="fas fa-external-link-alt text-blue-500"></i>
                                </div>
                            </a>
                            <a href="#" class="block p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-green-700">API Documentation</span>
                                    <i class="fas fa-book text-green-500"></i>
                                </div>
                            </a>
                            <a href="#" class="block p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
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
                                <code class="text-xs bg-gray-100 p-2 rounded block break-all">https://api.arabhardware.net/oauth/authorize</code>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700 mb-1">Token URL</div>
                                <code class="text-xs bg-gray-100 p-2 rounded block break-all">https://api.arabhardware.net/oauth/token</code>
                            </div>
                            <div>
                                <div class="font-medium text-gray-700 mb-1">User Info</div>
                                <code class="text-xs bg-gray-100 p-2 rounded block break-all">https://api.arabhardware.net/user</code>
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
                        <button class="btn btn-outline btn-sm text-white border-white hover:bg-white hover:text-red-500">
                            <i class="fas fa-envelope mr-2"></i>
                            Contact Support
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-gray-500 text-sm">
                <p>&copy; 2025 Arab Hardware. All rights reserved.</p>
                <div class="flex justify-center items-center space-x-4 mt-4">
                    <a href="#" class="hover:text-red-500 transition-colors">Privacy Policy</a>
                    <span>•</span>
                    <a href="#" class="hover:text-red-500 transition-colors">Terms of Service</a>
                    <span>•</span>
                    <a href="#" class="hover:text-red-500 transition-colors">Developer Agreement</a>
                </div>
            </div>
        </div>
    </footer>

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
</body>
</html>
