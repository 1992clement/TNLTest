# TNLTest
TNL interview test

### Project requirements
- php 7+
- docker
- docker-compose

### Setup
```
$ git clone https://github.com/1992clement/TNLTest.git
$ cd TNLTest/app
$ composer install
$ cd ..
$ docker-compose up -d
```
It might take some time depending on your internet connexion / computer power, so feel free to grab a coffee.

**WAIT 30s to 1min after starting containers.**\
Servers take a little more time to start up, even if the containers are up.

The app will get the json from https://neos.lu/Get-Json.json, and insert them in base as soon as you hit localhost.\
If you hit localhost a second time, the app will throw an error (catched), as you are trying to insert twice the same primary key. (id) \
If you want to test it again, just `docker stop` and `docker rm` the containers, and rerun `docker-compose up -d`

### Url and ports
- symfony app : http://localhost:8000
- adminer : http://localhost:8080
- mysql : mysql://root:root@localhost:3306/TNLdb

### Database
The database is automaticaly generated and populated with the 'event' table as soon as the 'db' service starts up.\
The data are not persisted locally, so if you stop and remove the container, you will reset the db.\
The sql script generating the database can be found at `TNLTest/database-env/dbinit.sql`

I added an adminer container, which is a simple php database manager interface. I figured it would be easier to check if the datas are indeed persisted in the db.\
Credentials are :
- System = Mysql
- Server = db
- User = root
- Password = root
- database = TNLdb

### Logs
logs can be found at `TNLTest/app/var/log/`

### Architecture
The app works with 5 classes. They can all be found in `TNLTest/app/src/`.

1) The request passes through the **HomeController**. The controller lets another service handle all the business logic to stay light. It only catches and logs the errors.
2) The **HomeBusinessService** handles the logic. It gets the json data using a function from the **Utils** service, validates the data using a custom validator service : **EventDataValidator**, creates a Doctrine object **Event**, and persist it in the database.
3) Response is sent to the client.




