const preLoad = function () {
    return caches.open("offline").then(function (cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("install", function (event) {
    event.waitUntil(preLoad());
});

const filesToCache = [
    'https://example-app-production.up.railway.app/',
    "https://example-app-production.up.railway.app/afrohuila_1.svg",
    "https://example-app-production.up.railway.app/apple-touch-icon.png",
    'https://example-app-production.up.railway.app/index.php',
    'https://example-app-production.up.railway.app/login',
    "http://example-app-production.up.railway.app/usuarios",
    "https://example-app-production.up.railway.app/manifest.json",
    "https://example-app-production.up.railway.app/sw.js",
   
    
    
    
    
    ];

const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

const addToCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};

const returnFromCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status === 404) {
                return cache.match("offline.html");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener("fetch", function (event) {
    event.respondWith(checkResponse(event.request).catch(function () {
        return returnFromCache(event.request);
    }));
    if(!event.request.url.startsWith('https')){
        event.waitUntil(addToCache(event.request));
    }
});
