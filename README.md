# Customers Project

### Live ( I have made API for customers and also simple view) 
    View: (http://ec2-44-195-93-94.compute-1.amazonaws.com:8000/customers
    API: http://ec2-44-195-93-94.compute-1.amazonaws.com:8000/api/customers
    
### How to install the project?:
    the project is dockerized so we can easily get it running by those steps 
            1- git clone https://github.com/mostafawafa/customers.git
            2- copy environment file ( cd customers && cp .env.example .env )  
            3- start docker container: (sudo docker-compose up -d --build)
            
    and now everything's alright: 
        Now check
            localhost:8000/customers for the view
            localhost:8000/api/customers for json response
            
     Run unit tests under package: 
        - attach to docker container and run the test "sudo docker exec -it customers_lumen_1 ./vendor/bin/phpunit" 


### Structure: 
    Tech stack: Php7.4, lumen framework, Sqlite, Doctrine as ORM, docker
    
    I believe in modularization so I separate customers logic in it's own package for more reusability: 
    
    Directories under Packages/customers/src:
    
        - Contracts: directory for interfaces.  since we need to depend on abstract not concrete classes so we can decrease the coupling between classes, change the implementations easily  and also to help us in testing by mocking so we don't have to worry about hitting the database,third party,etc.
        
        - Entities
        - Infrastructure: containing the implementation of infrastructure classes like repository and cacheAdapter
        - Providers: containing a service provider which is responsible to wire contracts with implementations for the container.
        - Services
        
       /src/tests: contains our unit tests. 
       
       
    other thoughts: 
        -I don't want to have coupling between entities and between  the representation layer. so we can easily change entities without affecting clients. so I made representations which convert entities to json or array. and I use Factory to choose the right representation.
        
        -I added a cache layer so I can decrease the hits to DB and decrease calculations needed since clients will ask for the same data again and again. of course when we make endpoints for adding new customers we need to invalidate the cache to get the new entries.
        
        -when we need to scale,  I believe it's better to add column "isValidPhone'' to database and index it so we can query by filters easily instead of now as we don't have that column so we need to get all data and filter it in application layer which is redundant every time and if data is big, it'll cause some performance issues. Also even if we used "regex" function in the database  directly it will make a full table scan without using the index which will cause performance issues with big data.. so I believe if we need to scale in future we need to add another indexed column to database
        
        
        
