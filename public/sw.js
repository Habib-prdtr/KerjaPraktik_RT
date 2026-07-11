// Service Worker for Laravel WebPush
self.addEventListener('push', function (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    let data = {};
    if (event.data) {
        try {
            data = event.data.json();
        } catch (e) {
            data = {
                title: 'Notifikasi Baru',
                body: event.data.text()
            };
        }
    }

    const title = data.title || 'Pemberitahuan RT 08';
    const options = {
        body: data.body || 'Ada informasi baru untuk Anda.',
        icon: data.icon || '/images/logo-rt.png', // Fallback icon path
        badge: data.badge || '/images/logo-rt.png', // Fallback badge path
        data: {
            url: data.url || '/'
        },
        vibrate: [100, 50, 100],
        actions: data.actions || []
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();

    const targetUrl = event.notification.data.url;
    if (!targetUrl) return;

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (clientList) {
            // If a window is already open with the target URL, focus it
            for (let i = 0; i < clientList.length; i++) {
                let client = clientList[i];
                if (client.url === targetUrl && 'focus' in client) {
                    return client.focus();
                }
            }
            // Otherwise, open a new window
            if (clients.openWindow) {
                return clients.openWindow(targetUrl);
            }
        })
    );
});
