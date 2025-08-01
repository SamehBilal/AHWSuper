@if($pendingInvitations->count() > 0)
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Testing Invitations</h3>
        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
            {{ $pendingInvitations->count() }} pending
        </span>
    </div>

    <div class="space-y-3">
        @foreach($pendingInvitations as $invitation)
        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                    <span class="text-white text-sm font-bold">
                        {{ substr($invitation->app->name, 0, 2) }}
                    </span>
                </div>
                <div>
                    <p class="font-medium text-gray-900">{{ $invitation->app->name }}</p>
                    <p class="text-sm text-gray-500">Invited by {{ $invitation->invitedBy->name }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('app-tester.show', $invitation->invitation_token) }}"
                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
