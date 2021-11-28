# Microservices using PHP Symfony

Microservice communication proof of concept using PHP 8.0 (Symfony) with a sprinkle of some DDD (Domain driven design).
Main goal was to learn about communication between two contexts: identity access and blog.

  - PHP 8.0 (Symfony)
  - Persistence: MariaDB
  - Messaging: RabbitMQ
#
### Identity Access context
##### Register user
```
php bin/console app:register-user "Aleksa Jovanovic" "aleksa@mail.com" "password"
```
##### Create role
```
php bin/console app:create-role "Administrator"
```
##### Assign role to user
```
php bin/console app:assign-role-to-user "uuid of user" "uuid of role"
```
#
### Blog context
##### Create blog category
```
php bin/console app:create-category "Category name"
```
##### Write blog
```
php bin/console app:write-blog "title" "content" "uuid of category" "uuid of author"
```
##### Get all authors
```
php bin/console app:get-all-authors
```
