// Function to convert VAPID public key to Uint8Array
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

// Register Service Worker and subscribe to Push Notification
function initPushNotification() {
    if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
        console.warn('Push notification is not supported in this browser.');
        return;
    }

    // Register Service Worker
    navigator.serviceWorker.register('/sw.js')
        .then(function (registration) {
            console.log('Service Worker registered successfully with scope:', registration.scope);
            checkSubscription(registration);
        })
        .catch(function (error) {
            console.error('Service Worker registration failed:', error);
        });
}

function checkSubscription(registration) {
    registration.pushManager.getSubscription()
        .then(function (subscription) {
            if (subscription) {
                // Already subscribed, send to backend to make sure it's synchronized
                sendSubscriptionToBackend(subscription);
            } else {
                // Not subscribed yet, ask user
                askPermissionAndSubscribe(registration);
            }
        });
}

function askPermissionAndSubscribe(registration) {
    const vapidPublicKey = document.querySelector('meta[name="vapid-public-key"]').getAttribute('content');
    if (!vapidPublicKey) {
        console.error('VAPID public key not found in meta tag.');
        return;
    }

    // Request Permission
    Notification.requestPermission().then(function (permission) {
        if (permission === 'granted') {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(vapidPublicKey)
            };

            registration.pushManager.subscribe(subscribeOptions)
                .then(function (subscription) {
                    console.log('User subscribed to push successfully.');
                    sendSubscriptionToBackend(subscription);
                })
                .catch(function (error) {
                    console.error('Failed to subscribe user to push:', error);
                });
        } else {
            console.warn('Notification permission was denied.');
        }
    });
}

function sendSubscriptionToBackend(subscription) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/push-subscriptions', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify(subscription)
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Bad response from server');
        }
        return response.json();
    })
    .then(function (data) {
        console.log('Push subscription sent to backend:', data);
    })
    .catch(function (error) {
        console.error('Could not send push subscription to backend:', error);
    });
}

// Auto-initialize when page loads if user is authenticated
document.addEventListener('DOMContentLoaded', function () {
    const isAuthenticated = document.querySelector('meta[name="auth-check"]')?.getAttribute('content') === 'true';
    if (isAuthenticated) {
        initPushNotification();
    }
});
