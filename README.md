# Laravel RESTful API (Spy)

## Set the application 
- Make a folder (spy) at xampp for example, and download the project with this command:
  
```
git clone https://github.com/lenatsekoura/spy.git .
```

- Make the necessary adjustmnets at .env file 
  
- Run the migrations by running this command:

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
By this endpoint a user can use the credentials to make login and get the token for the authentication calls. When we get the access_token we go to the Spy create endpoint at Authorization tab and choose Type: No Auth and paste the token value to the input.

### Spy create endpoint
By this endpoint an authenticated user can create a spy record. Acceptable fields at body section: name(required), surname(required), agency(optional), country_opearation(optional), dob(required), dod(optional)

### Spy list endpoint
By this endpoint a user can get all the spies paginated. It is also supported filter, and sorting options at Params tab. 
- filter[surname] search by surname value
- filter[name] search by name value
- filter[unsupported_case] for testing purposes
- filter[age_range] by setting this to 1 it returns groupped records by age range
- filter[age_exact_match] search by name value
- sort[fullname] by setting this to 1 it returns sorted records by fullname
- sort[surname] by setting this to 1 it returns sorted records by surname
- sort[dob] by setting this to 1 it returns sorted records by dob

filter[surname], filter[name] and sort[fullname], sort[surname] and sort[dob] can work combined

filter[age_range] and filter[age_exact_match] work autonomously

### Spy random endpoint
By this endpoint a user can get 5(this value is hardcoded) random spies list.

## Improvements
It could be used a test database connection for the Feature tests, so the original database would not changed at all.
More tests for spies list endpoint.

