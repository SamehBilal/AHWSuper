<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="text-center mb-6">
                @if($app->logo_url)
                    <img src="{{ $app->logo_url }}" alt="{{ $app->name }}" class="mx-auto h-16 w-16 rounded-lg">
                @else
                    <div class="mx-auto h-16 w-16 bg-blue-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">{{ substr($app->name, 0, 1) }}</span>
                    </div>
                @endif
                <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $app->name }}</h2>
                <p class="mt-2 text-sm text-gray-600">wants to access your ArabHardware account</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-2">This app will be able to:</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Read your basic profile information</li>
                    <li>• Access your public posts and reviews</li>
                    @if($app->scopes)
                        @foreach($app->scopes as $scope)
                            <li>• {{ $scope }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="space-y-3">
                <form method="POST" action="{{ route('passport.authorizations.approve') }}">
                    @csrf
                    <input type="hidden" name="state" value="{{ $request->state }}">
                    <input type="hidden" name="client_id" value="{{ $request->client_id }}">
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">

                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Authorize {{ $app->name }}
                    </button>
                </form>

                <form method="POST" action="{{ route('passport.authorizations.deny') }}">
                    @csrf
                    <input type="hidden" name="state" value="{{ $request->state }}">
                    <input type="hidden" name="client_id" value="{{ $request->client_id }}">
                    <input type="hidden" name="auth_token" value="{{ $authToken }}">

                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    By authorizing, you agree to share the requested information with {{ $app->name }}.
                    <a href="{{ $app->website_url }}" target="_blank" class="text-blue-600 hover:text-blue-500">Learn more</a>
                </p>
            </div>
        </div>
    </div>
</div>
