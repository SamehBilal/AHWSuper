import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('Live-Updates')
.listen('NewUser', (e) => {
    console.log('New event received:', e);
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
