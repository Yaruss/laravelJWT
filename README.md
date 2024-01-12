## Step 1

####run command to install  
When using the laravelsail/phpXX-composer image, you should use the same version of PHP that you plan to use for your application (80, 81, 82, or 83).
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
    
## Step 2

##### run sail migrate, make front and run app

```
alias sail="./vendor/bin/sail"

sail up -d

sail artisan migrate:fresh --seed

sail npm i

sail npm run dev
```
