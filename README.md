# cpremier test session

# Requirements
* [docker](https://docs.docker.com/engine/installation/)
* [docker-compose](https://docs.docker.com/compose/install/)

# Run
Once installed docker and docker-compose we need clone this repo and run over project path
* `docker-compose up -d`
This comand download the nginx-php-fpm image and create one docker container.
For check if this works we can type `docker ps` and we can see the docker container runs

This site is available in `localhost:8000`.

# Secret key configure

For test the sessión we must add the secret key to `php fpm config file`
```
docker exec -it cpremierTest bash

# go to config folder
vi /etc/php5/php-fpm.conf

# add secret_key in the line 513
env[SECRET_KEY] = {secret-key-value}

# save and quit with :x
```
Once configured secret key we need exit from container
And restart the container with `docker restart cpremierTest`

# Configure vhost
For test the session we need configure this site with host `clubpremier.info`. For this requirement we need the docker container ip.
For this we need to enter the container with 
```
docker exec -it cpremierTest bash

# get the ip with

ifconfig

#copy the inet_addr from eth0, in my case is 172.17.0.2
```

We need map this address to a vhost in our machine with
```
# in our machine
vi /etc/hosts
# add the address to hosts 
172.17.0.2  test.clubpremier.info
```
We nust save as sudo user.

# Test
We logged to member.clubpremier.info and open in other window our container test.clubpremier.info and check the results.
The `salir.php` is the script that used ClubPremierSSO.class::logout method.

