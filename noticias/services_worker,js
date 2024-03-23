const urlsToCache = [
  '/',
  '/css/style.css',
  '/js/main.js',
  '/images/icon.png',
  // Otros recursos estáticos necesarios para la shell de la aplicación
];

self.addEventListener('install', function(event) {
  // Realizar la instalación del Service Worker y almacenar los recursos en caché
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
  // Intercepta las solicitudes de red y sirve desde la caché si está disponible
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Si se encuentra en caché, devuelve la respuesta almacenada en caché
        if (response) {
          return response;
        }
        // Si no se encuentra en caché, realiza la solicitud de red normalmente
        return fetch(event.request);
      })
  );
});
