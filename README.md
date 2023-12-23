# Laravel RESTful API (Spy)

## Set the application 
- Make a folder (spy) at xampp for example, and download the project with this command:
  
```
git clone https://github.com/lenatsekoura/spy.git .
```

- Make the necessary adjustmnets at .env file 
  
- Run the migrations by ruuning this command:

```
php artisan migrate
```

## Run the application
Coommand:

```
php artisan serve
```
## Test
Test the application by running this command:

```
php artisan test
```

## Postman Collection
In the project it is included a folder named Postman, there is located the postman collection. Included: 

### User register endpoint 
This endpoint creates a user so can use the credentials to make login and get the token for the authentication calls
### User login endpoint
### Spy Create endpoint
## Spy Create endpoint
### Spy Create endpoint


## Improvements
It could be used a test database connection for the Feature tests, so the original database would not changed at all

