# WordPress Environment Setup
Install the last WordPress version and dependencies with Bash and Composer help.

### Project Dependency
+ wordpress

### WordPress Dependencies
+ advanced-custom-fields/advanced-custom-fields-pro

### Installation
``` bash
$ cd project-directory
```

``` bash
$ git clone git@github.com:alexmigf/wp-env.git
```
> Open **wp-dependencies-bk.php** and add your preferred WordPress Dependencies.
> 
> Open **.env** and add your ACF Pro Key (ACF Key is required for the installation) and other project settings like database and environment (production or development).
``` bash
$ cd wp-env
$ chmod +x setup.sh
$ ./setup.sh
```

### Update Dependencies
> Open **public/composer.json** and edit your dependencies. Run the setup again.
``` bash
$ ./setup.sh
```

### NGINX Configuration
``` nginx
server {
  listen 80;
  server_name example.com;

  root /srv/www/example.com/public;
  index index.php index.htm index.html;

  location ~* /wp-content/uploads/.*.php$ {
    deny all;
  }

  location / {
    try_files $uri $uri/ /index.php?$args;
  }
}
```
