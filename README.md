# NSM Asset Rev plugin for Craft CMS 3.x

Rev asset urls with date modified timestamps. Its simple… just call the 
function and pass the asset and an optional transform.

Before:

    Template: {{ asset.url(transform) }}
    Output: https://local.craft3/uploads/hqdefault.jpg

After:

    Template: {{ nsm_rev_asset_url(asset, transform) }}
    Output: https://local.craft3/uploads/hqdefault.1496670969.jpg

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require newism/craft3-asset-rev
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Install

Install plugin in the Craft Control Panel under Settings > Plugins.

## Usage

This plugin provides a single twig function:

    {{ nsm_rev_asset_url(asset, transform) }}

### Server Configuration

**Important**: This plugin doesn't actually change the the filename on the server. 
You'll need to implement rewrite rules in your apache conf or nginx access.

#### Apache

See: https://github.com/h5bp/server-configs-apache/blob/master/dist/.htaccess#L968-L984

    # ----------------------------------------------------------------------
    # | Filename-based cache busting                                       |
    # ----------------------------------------------------------------------

    # If you're not using a build process to manage your filename version
    # revving, you might want to consider enabling the following directives
    # to route all requests such as `/style.12345.css` to `/style.css`.
    #
    # To understand why this is important and even a better solution than
    # using something like `*.css?v231`, please see:
    # http://www.stevesouders.com/blog/2008/08/23/revving-filenames-dont-use-querystring/

    # <IfModule mod_rewrite.c>
    #     RewriteEngine On
    #     RewriteCond %{REQUEST_FILENAME} !-f
    #     RewriteRule ^(.+)\.(\d+)\.(bmp|css|cur|gif|ico|jpe?g|js|png|svgz?|webp|webmanifest)$ $1.$3 [L]
    # </IfModule>
    
#### NGINX

See: https://github.com/h5bp/server-configs-nginx/blob/master/h5bp/location/cache-busting.conf#L1-L10

    # Built-in filename-based cache busting

    # This will route all requests for /css/style.20120716.css to /css/style.css
    # Read also this: github.com/h5bp/html5-boilerplate/wiki/cachebusting
    # This is not included by default, because it'd be better if you use the build
    # script to manage the file names.
    location ~* (.+)\.(?:\d+)\.(bmp|css|cur|gif|ico|jpe?g|js|png|svgz?|webp|webmanifest)$ {
      try_files $uri $1.$2;
    }

## Road Map

Some things to do, and ideas for potential features:

### 1.0

* Release it

### Future

* Add manfiest based revving
* Integrate other 3rd party image manipulation plugins as they become available

## Credits

Brought to you by [Newism](http://newism.com.au)

[<img src="http://newism.com.au/uploads/content/newism-logo.png" width="150px" />](http://newism.com.au/)
