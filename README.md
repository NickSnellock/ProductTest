#Product Test System

This system uses a test api found at https://www.itccompliance.co.uk/recruitment-webservice/api/ to demonstrate good OO 
PHP programming techniques and knowledge of sanitising strings. 
A docker-compose.yml file is provided, together with associated dockerfiles to create a working web server. 
The pre-requisite for this is to have docker intalled on your machine.
Once the docker containers are running, you need to update the packages used with the command

docker exec -it producttest_app bash -c "development/composer_setup.sh && php composer.phar update"

The system can then be accessed at http://localhost:8080

The code is written to the PSR-2 standard.