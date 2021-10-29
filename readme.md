# Basic clean url / routing in php object oriented way    
In last video I have shown how we can make clean url in php. In this video, I have just refactor code to object oriented way.  It will help you to learn little about static properties and method in php class.      

## Making a Router.php file
First I have write a Router class and add a static class variable `$routes`. which actually store all my routes with key, value pairs, Key will be url and value will file path for that url.      

~~~php
public static $routes;
~~~

Make a static method for adding new route to `$routes` array. 
~~~php
public static function get($url, $view) {
  self::$routes[$url] = $view;
}
~~~


Since static properties is a class variable not object variable, so we have to access using `self` or `static` keyword.    

~~~php
  self::$routes[$url] = $view;
~~~

make a another static method for returning specific view for specific url. First I check whether that specific url is exists or not in our routes array. If it exists in our array we will return its value other wise we will return not found page.    

~~~php
public static function run ($url) {
  if (array_key_exists($url, self::$routes)) {
    return self::$routes[$url];
  } else {
    return 'views/notfound.php';
  }
}
~~~

## In index.php
to get url path in php file we extract `REQUEST_URI` from `$_SERVER` super global. Trim `/` from request uri using php `trim` function. Thats actually sufficient for clean routing. But when we use get method in form we will have some parameter alongside url. So to get only url we are using `parse_url` function and giving 2nd parameter `PHP_URL_PATH`.    

~~~php
$path = trim( $_SERVER['REQUEST_URI'], '/' );
$path = parse_url($path, PHP_URL_PATH);
~~~

first we need to required `Router.php` file in order to use Router class.    
now we can add as many as route using `get` static method.     

~~~php
Router::get('', 'views/home.php');
Router::get('about', 'views/about.php');
~~~

Finally require return of run method    

~~~php
require Router::run($path);
~~~


Its working fine in my local php server. But in production we have to tweaking our server for clean url. So I have to make a `.htaccess` file. which is configuration file for apache web server. and put following content there and keep in project root   

~~~
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} -s [OR]
RewriteCond %{REQUEST_FILENAME} -l [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^.*$ - [NC,L]
RewriteRule ^.*$ index.php [NC,L]
~~~

I am shibu deb polo
Happy coding. Take care. Please subscribe my channel      









