/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
(function () {
    const savedTheme = localStorage.getItem('theme') || 'light';
    //alert('Theme is set to: ' + savedTheme);
    document.documentElement.setAttribute('data-theme', savedTheme);
})();
