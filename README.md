## Installation
```sh
php artisan migrate:fresh

php artisan db:seed
```
### Login account:
  - test@example.com | password
  - admin@example.com | password

## Template Information

### Client template (EnNo)
Location: `public/enno`

Preview Url: [http://localhost/enno](http://localhost/enno)
### Admin Dashboard template (mantis)
Location: `public/mantis`

Preview Url: [http://localhost/mantis](http://localhost/mantis)

## Command list
### This command will sync all routes with 'check.permission' middleware to permissions table and assign all permissions to admin role.
```sh
php artisan permissions:sync-routes --assign-to-admin --middleware=check.permission
```
