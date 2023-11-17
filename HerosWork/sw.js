const CACHE_NAME = "Heroes Wrok";
const PRE_CACHED_RESOURCES = ["/", "css/index.css"];

self.addEventListener("install", event => {
  event.waitUntil(preCacheResources());
  console.log("WORKER: install event in progress.");
});

self.addEventListener("activate", event => {
  console.log("WORKER: activate event in progress.");
});

self.addEventListener('fetch', event => {
  event.respondWith(handleFetch(event.request));
});

async function handleFetch(request) {
  try {
    // Your fetch logic here
  } catch (error) {
    console.error('Error in fetch handler:', error);
    // Handle the error gracefully
  }
}


async function preCacheResources() {
  const cache = await caches.open(CACHE_NAME);
  await cache.addAll(PRE_CACHED_RESOURCES);
}

async function returnCachedResource(event) { // Add event parameter here
  const cache = await caches.open(CACHE_NAME);
  const cachedResponse = await cache.match(event.request);

  if (cachedResponse) {
    return cachedResponse;
  } else {
    const fetchResponse = await fetch(event.request);
    await cache.put(event.request, fetchResponse.clone());
    return fetchResponse;
  }
}
