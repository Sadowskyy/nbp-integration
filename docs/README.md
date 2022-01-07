# nbp-integration

## Description

In application, we can notice the
division into directories like Domain, Infrastructure, Application, Presentation. It's called
[DDD](https://pl.wikipedia.org/wiki/Domain-driven_design) </br></br>
In domain layer we specify what we do, in infrastructure we make domain specified rules and in presentation we connect
to our application for example via HTTP.

In app we don't use HTTP, we use CLI - terminal

App was developed only for recreations reasons
Main target of app was integration with [NBP API](http://api.nbp.pl/)


# Run app and start docker containers
```
$ make up
```
# Run tests
```
$ make test
```

App is only demonstration of my tech skills, I have not enough 
time to configure Doctrine with MySQL. So funcionality runs only in tests ;( <br>

Sorry I can do it better but it costs time ;/ <br>

# Get stored in DB currencies
```
$ bin/console get-currencies
```

# Update currencies in DB
```
$ bin/console update-currencies
```
