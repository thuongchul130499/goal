# Goal
## Clone project
### cd backend 
### cp .env.example .env
### composer install
### php artisan key:generate
### npm install

# Factory
### php artisan tinker
### factory(App\User::class)->create(); /email: thuong@gmail.com/password: password

# Docker
### docker-compose up
### docker exec -it container_id(backend) bash:/ chown -R www-data:www-data *
