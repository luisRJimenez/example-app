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
    '/',
    'index.php',
    "afrohuila_1.svg",
    "apple-touch-icon.png",
    "build/assets/app-f2a28a1f.css",
    "build/assets/app-8c6a0ea2.css",
    "build/assets/app-2a1b3fb8.js",
    "manifest.json",
    "sw.js",
    "offline.html",
    


    //'https://example-app-production.up.railway.app/dashboard',
    
    // "/afrohuila_1.svg",
    // "/apple-touch-icon.png",
    // // "/build/assets/app-f2a28a1f.css",
    // // "/build/assets/app-8c6a0ea2.css",
    // // "/build/assets/app-7ac38bf3.js",
    
    // '/login',
    // "/register",
    // '/dashboard',
    // '/usuarios',
    // '/roles',
    // '/encuestas',
    // '/profile',
    // "/manifest.json",
    // "/sw.js",
   
    
    
    
    
    ];

const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            console.log(response);
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
                return cache.match("/");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener("fetch", function (event) {
    console.log(event.request)
    event.respondWith(checkResponse(event.request).catch(function () {
        return returnFromCache(event.request);
    }));
    if(!event.request.url.startsWith('httpt')){
        event.waitUntil(addToCache(event.request));
    }
});
