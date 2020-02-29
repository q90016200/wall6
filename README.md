**sudo vi /etc/hosts**
```
127.0.0.1 wall6.laravel
```

**laravel .env**
```
APP_NAME=wall
APP_ENV=local
APP_KEY=base64:/rhOLnb7dJgHXKU1mbYLc7kqRTbs9I0V+s1MghhscmY=
APP_DEBUG=true
APP_URL=http://wall6.laravel/

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=172.28.0.3
DB_PORT=3306
DB_DATABASE=wall
DB_USERNAME=admin
DB_PASSWORD=admin

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=172.28.0.4
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

**local nginx config**
```
server {
	listen 80;
	listen [::]:80;

	server_name wall6.laravel;
	root /home/code/wall_l6/public;

	# index.php
	index index.php;

	# index.php fallback
	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

	location ~ \.php$ {
		fastcgi_pass   127.0.0.1:9000;
		fastcgi_index  index.php;
		fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
		include        fastcgi_params;
	}
}
```

**軟連結 前端**
```
ln -s /home/code/wall_vue/dist/index.html /home/code/wall_l6/resources/views/index.blade.php

ln -s /home/code/wall_vue/dist/static /home/code/wall_l6/public/static

```

**jwt secret key**
Generate secret key
I have included a helper command to generate a key for you:
```
php artisan jwt:secret
```