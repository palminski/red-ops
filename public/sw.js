const CACHE_NAME = 'redops-static-v1';
const STATIC_ASSET_REGEX = /\.(?:css|js|png|svg|woff2?|ttf)$/;

self.addEventListener('install', () => {
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key)))
        )
    );
    self.clients.claim();
});

// Only cache static, fingerprinted build assets (cache-first). Pages, forms,
// and API calls always hit the network so things like CSRF tokens and
// ratings never go stale behind a service worker cache.
self.addEventListener('fetch', (event) => {
    const { request } = event;

    if (request.method !== 'GET' || !STATIC_ASSET_REGEX.test(new URL(request.url).pathname)) {
        return;
    }

    event.respondWith(
        caches.open(CACHE_NAME).then(async (cache) => {
            const cached = await cache.match(request);
            if (cached) return cached;

            const response = await fetch(request);
            if (response.ok) cache.put(request, response.clone());
            return response;
        })
    );
});
