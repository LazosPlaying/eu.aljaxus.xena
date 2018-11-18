# eu.aljaxus.xena

NGINX Config
```
server {
    listen    	80;
    listen	  	443;

    ssl    		on;
    ssl_certificate        	/cert.crt;
    ssl_certificate_key   	/cert.key;

		server_name your.domain.tld;

		root /var/www/eu.aljaxus.xena;
		index index.php;

		error_page 404 /error_404;
		error_page 500 502 503 504 /error_50x;
    client_max_body_size 16m;


    location ~ /(inc) {
      deny all;
      rewrite ^ https://xena.aljaxus.eu;
      return 403;
    }

		location /api {
			add_header Cache-Control 'no-store, no-cache, must-revalidate, max-age=0';
			add_header Cache-Control 'post-check=0, pre-check=0';
			add_header Pragma 'no-cache';
			autoindex on;
    }
		location /src {
      allow all;

      autoindex on;

			access_log off;
			error_log off;

			add_header Cache-Control 'public';
      try_files $uri $uri/ =404;
		}
		location / {

			try_files $uri $uri/ @extensionless-php;

      rewrite ^\/s\/([^\/?]+)\/([a-zA-Z0-9]+)((\/|\?).*)?$ /site.php?area=site&par1=$1&par2=$2 last;
      rewrite ^\/s\/([^\/?]+)((\/|\?).*)?$ /site.php?area=site&par1=$1 last;
      rewrite ^\/site\/([^\/?]+)\/([a-zA-Z0-9]+)((\/|\?).*)?$ /site.php?area=site&par1=$1&par2=$2 last;
      rewrite ^\/site\/([^\/?]+)((\/|\?).*)?$ /site.php?area=site&par1=$1 last;

      rewrite ^\/me\/([^\/?]+)((\/|\?).*)?$ /me.php?area=me&par1=$1 last;
      rewrite ^\/me((\/|\?).+)?$ /me.php?area=me last;

      rewrite ^\/(.+)?$ /index.php?area=index&par1=$1 last;

		}

		location @extensionless-php {
      rewrite ^(.*)$ $1.php last;
		}
		location ~ \.php$ {
			try_files $uri =404;
			fastcgi_pass unix:/run/php/php7.2-fpm.sock;
			fastcgi_split_path_info ^(.+\.php)(/.+)$;
			fastcgi_index index.php;
			fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
			include fastcgi_params;
		}
}

```
