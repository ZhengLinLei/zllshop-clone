//GET VERSION
const CACHE_VERSION = "1.2.10";
const CURRENT_CACHE = `ZLL_SHOP_v${CACHE_VERSION}`;
let filesToCache = [
  "./offline",
  "./view/resource/css/index.css",
  "./view/resource/font/font.css",
  "./view/manifest.json",
  "./view/manifest.webmanifest",
  "./view/resource/img/web/favicon/favicon.ico",
  "./view/resource/font/SourceHanSansSC-Bold.woff",
  "./view/resource/font/SourceHanSansSC-Regular.woff",
  "./view/resource/font/SourceHanSansSC-Light.woff",
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js',
  "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js",
  "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js",
  "https://code.jquery.com/jquery-3.3.1.slim.min.js",
  "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css",
  "https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap"
];
//INSTALL
self.addEventListener("install", eo => {
  console.log("Installing service worker");
  eo.waitUntil(
    caches.open(CURRENT_CACHE)
      .then(cache => {
        console.log("Caching...")
        cache.addAll(filesToCache);
      })
  );
});
// on activation we clean up the previously registered service workers
self.addEventListener('activate', evt => {
  console.log("Activating service worker");
  evt.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CURRENT_CACHE) {
            console.log("Deleting old cache");
            return caches.delete(cacheName);
          }
        })
      )
    })
  );
});
const updateCache = request => {
  if (!request.url.includes(".woff")) {
    caches.open(CURRENT_CACHE)
      .then(cache => {
        cache.match(request)
          .then(response => {
            if (response) {
              fetch(request)
                .then(res => {
                  cache.put(request, res.clone());
                });
            }
          })
      })
  }
}

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.open(CURRENT_CACHE)
      .then(cache => {
        return cache.match(event.request.url)
          .then(response => {
            return (response) ? response : fetch(event.request);
          })
      })
      .catch(err => {
        return caches.open(CURRENT_CACHE)
          .then(cache => {
            return cache.match('./offline');
          })
      })
  );
  updateCache(event.request);
});