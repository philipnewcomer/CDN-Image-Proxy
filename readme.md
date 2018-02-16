# CDN Image Proxy

*Use Jetpack Image CDN (formerly Photon) to proxy image uploads from another site.*

When developing locally, it's common to use a database dump from a production site. With large sites, it's also common that the production site's image uploads cannot be easily copied to the local environment, because there are simply too many of them.

While local environments like [Pilothouse](https://github.com/Pilothouse-App/pilothouse) allow you to easily proxy image uploads to your local environment from the production site, that doesn't work so well if you add or change one of the registered thumbnail sizes in your local copy of the theme, since the new thumbnail size can't be proxied from production as it doesn't exist there. You're also not able to regenerate the needed thumbnail sizes locally, because the original image file is not present locally.

*CDN Image Proxy* solves this problem by using [Jetpack Image CDN](https://jetpack.com/support/photon/) (formerly Photon) to proxy image uploads from your production site. Jetpack Image CDN will automatically generate and serve any required thumbnail size on-the-fly, but *CDN Image Proxy* will tell it to look for the original image on your production server, rather than on your local URL.

The result is that you can add or change registered image sizes locally whenever you want, and Jetpack Image CDN will generate and provide a CDN URL for whatever thumbnail size is required, sourced from the original image file located on the production site.

## Installation

1. Install and activate *CDN Image Proxy* on your local site
2. Install and activate *Jetpack* on your local site
3. Go to `Settings > Media` and save your production site's URL in the field provided.

You can also define your production site's URL as a constant in `wp-config.php`, like so:
```
define( 'CDN_IMAGE_PROXY_REMOTE_URL', 'http://example.com' );
```

## Frequently Asked Questions

 - **I thought Jetpack Image CDN (Photon) doesn't work on local sites, and required a wordpress.com connection!**  
   That's not a question, but *CDN Image Proxy* will force the Jetpack Image CDN module to be active on local sites, and will disable the wordpress.com connection requirement for that module.
 - **Are other magic image services supported besides Jetpack Image CDN (Photon)?**  
   Not at this time, but I'd be open to adding support for other services. 

## Changelog

### 1.0
- Inital release
