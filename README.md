# Progressive
Craft CMS plugin to aide in creating progressive sites.

## Installation
Download the master zip from github.

## Configuration

Configure the plugin using default Craft CMS configuration.

Afterwards, add the following code to your main template (_layout.twig)
```html
<link rel="manifest" href="/manifest.json">
<script>
    if('serviceWorker'in navigator){
        navigator.serviceWorker.register('serviceworker.js').then(function(){
        console.log("Service Worker Registered");
        });
    }
</script>
```



