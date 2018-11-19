# Installation

Generate .env file and setup db info
```
$ cp .env.example .env
```
Generate a Key
```
$ php artisan key:generate
```
Setup link to storage folder
```
$ php artisan storage:link
```
Run migration and seed
```
$ php artisan migrate:fresh --seed
```
## Login with demo user
email: demouser@example.com  
password: password



# Production Requirements
```
$ sudo apt update
$ sudo apt install nodejs
$ sudo apt install npm
$ sudo apt install redis-server
$ sudo apt-get install supervisor
$ sudo apt-get install php-xml
$ sudo apt-get install php7.2-gd
$ sudo apt install curl php-cli php-mbstring git unzip
```
## Install composer
https://getcomposer.org/download/
After install
```
$ sudo mv composer.phar /usr/local/bin/composer
$ sudo chmod 755 /usr/local/bin/composer
$ export PATH="$HOME/.composer/vendor/bin:$PATH"
```

## Requirements for spatie/browsershot Library
https://github.com/spatie/browsershot

```
$ curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
$ sudo apt-get install -y nodejs gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils wget
$ sudo npm install --global --unsafe-perm puppeteer
$ sudo chmod -R o+rx /usr/lib/node_modules/puppeteer/.local-chromium
```

## Redis Setup
```
sudo vi /etc/redis/redis.conf
```
Change supervised config
```
supervised systemd
```
Reload the service
```
sudo systemctl restart redis.service
```

## Supervisor Setup
Create the config file:
```
$ sudo vi /etc/supervisor/conf.d/laravel-worker.conf
```
Setup 
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /PATH-TO-FOLDER/artisan queue:work --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=4
redirect_stderr=true
stderr_logfile=/PATH-TO-FOLDER/storage/logs/laravel.log
```

### Supervisor Command
```
$ sudo supervisorctl reread
$ sudo supervisorctl update
$ sudo supervisorctl start laravel-worker:*
$ sudo supervisorctl restart laravel-worker:*
```

## Setup Crontab
```
* * * * * cd /PATH-TO-FOLDER && php artisan schedule:run >> /dev/null 2>&1
```

# Installation to production
Clone the Project
Install dependencies composer
```
$ composer install
```
Setup file permission:
```
//https://stackoverflow.com/questions/30639174/file-permissions-for-laravel-5-and-others
sudo chown -R my-user:www-data /path/to/your/laravel/root/directory
sudo find /path/to/your/laravel/root/directory -type f -exec chmod 664 {} \;    
sudo find /path/to/your/laravel/root/directory -type d -exec chmod 775 {} \;
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```
[Setup application](#installation)
