#WordpressExporter

Hello, this is a simple script that I have created to export my posts from Wordpress in an easy way and avoiding the Wordpress xml file that Wordpress generates.

When I am creating some post for Wordpress, I usually use an external HTML editor or IDE to be able to create well formated HTML code, and then I copy and paste all the content in the Wordpress new post screen editor.

With this script, and a little help of a Wordpress plugin (I will explain which one later), you can use this script to export all of them to your local machine.

##Requirements

###Install Wordpress Plugin
In order to be able to use the JSON Api, you need to install the [JSON API](https://wordpress.org/plugins/json-api/) from the Wordpress Plugin directory (Im not the creator)

###Configure ***config.json***
To be able to let fetch the content from the wordpress, you need to fill the ```config.json``` with your Wordpress base url and the path where the html files will be placed

````
{
	"url":"YOUR_WORDPRESS_MAIN_URL",
	"path":"PATH_WHERE_YOUR_POSTS_WILL_BE_LOCATED/"
}
````
###Execute script
To run the script, execute it with the terminal:

```
php exporter.php
```

Depending on the quantity of posts in your site, this operation could take some time.

Hope it helps somebody ;)