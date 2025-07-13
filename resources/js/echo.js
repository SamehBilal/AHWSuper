import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Only initialize Echo if Reverb environment variables are available
if (import.meta.env.VITE_REVERB_APP_KEY && import.meta.env.VITE_REVERB_HOST) {
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: import.meta.env.VITE_REVERB_APP_KEY,
        wsHost: import.meta.env.VITE_REVERB_HOST,
        wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
        wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
        forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
        enabledTransports: ['ws', 'wss'],
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            },
        },
    });
} else {
    // Disable broadcasting entirely since environment variables are not set
    console.log('Broadcasting disabled - environment variables not configured');
    window.Echo = {
        channel: () => ({
            listen: () => {},
            notification: () => {}
        }),
        private: () => ({
            notification: () => {}
        })
    };
}

window.Echo.channel('Live-Updates')
.listen('NewUser', (e) => {
    console.log('New event received:', e);
     window.Livewire.dispatch('show-toast', {
        type: 'success',
        title: 'New User!',
        description: e.message,
        position: 'toast-bottom toast-end',
        timeout: 5000
    });
    alert(e.message)
});

window.Echo.channel('Live-Updates')
.notification((notification) => {
    console.log('New notification received:', notification.message);
    alert(notification.message)
});

document.addEventListener("DOMContentLoaded", function() {
    //let userId = document.getElementById('userId')?.value;
    let userId = 2;

    if (userId) {
        window.Echo.private(`users.${userId}`)
            .notification((notification) => {
                console.log('New private notification:', notification.message);
                // Append new notification to the list
                //appendNotification(notification);

                // Update the notification count
                //updateNotificationCount();
            });
    } else {
        //console.error('User ID not found!');
    }
});
