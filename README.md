# Docker-compose를 이용한 lrs-api

현재 리조지토리는 docker-compose를 이용하여 laravel 환경을 구성하는 프로젝트입니다.

현재 nginx를 시스템에서 `80`포트를 사용하고 있다는 가정하에 작성하였습니다.

각 포트는 아래와 같습니다.

## port

- php80-fpm : 9000
- nginx : 8081
- jenkin : 8080

# docker-compose

## docker-compose.yml

php80-fpm, nginx, jenkins를 설치하는 파일이다.

```bash
version: "3.3"

services:
  php:
    build:
      context: .
      dockerfile: Dockerfile
    restart: always
    expose:
      - "9000"
    # links:
    #   - mysql:mysql
    # depends_on:
    #   - mysql
    volumes:
       - ./rest-api:/var/www/html:z
  nginx:
    image: nginx:latest
    # build:
    #   context: .
    #   dockerfile: Dockerfile-nginx
    restart: always
    ports:
      - "8081:80"
    links:
      - php:php
    # depends_on:
    #   - php

    volumes:
      - ./nginx/test.conf:/etc/nginx/conf.d/default.conf
      - ./rest-api:/var/www/html:z
  jenkins:
    build:
      context: .
      dockerfile: Dockerfile-jenkins
    container_name: jenkins
    restart: always
    user: root
    ports:
      - "8080:8080"
    volumes:
      - ./jenkins_home:/var/jenkins_home
```

```bash
$ docker-compose up -d
```

# nginx

nginx는 시스템에서 `80`를 사용한다는 가정하에 `8081 → 80`으로 포트포워딩을 시키는 구조로 구성하였습니다.

기존에 설치되어있는 시스템 nginx에서 `newlrs-api-dev.bubblecon.io`를 호출시 `reverse proxy` 를 이용하여 `0.0.0.0:8081`로 리다이렉트 해주는 구조입니다.

### system nginx default

아래는 `jenkins` 와 `php80-fpm`에 대한 `reverse proxy`구성 내용입니다.

```bash
server {
    listen 80;
    server_name newlrs-api-dev.bubblecon.io;

    location / {
        proxy_pass http://0.0.0.0:8081;

        proxy_connect_timeout 600;
        proxy_send_timeout 600;
        proxy_read_timeout 600;

        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-Host $host;
        proxy_set_header X-Forwarded-Server $host;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    }
}

server {
    listen 80;
    server_name jenkins.bubblecon.io;

    location / {
        proxy_pass http://0.0.0.0:8080;

        proxy_connect_timeout 600;
        proxy_send_timeout 600;
        proxy_read_timeout 600;

        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-Host $host;
        proxy_set_header X-Forwarded-Server $host;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    }
}
```

### test.conf

```bash
server {
    listen      80;
    server_name newlrs-api-dev.bubblecon.io;

    root "/var/www/html/public";
    index index.html index.htm index.php;
    charset utf-8;

    location / {
        add_header 'Access-Control-Allow-Origin' "*";
        add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS, DELETE, PUT';
        add_header 'Access-Control-Allow-Credentials' 'true';
        add_header 'Access-Control-Allow-Headers' 'User-Agent,Keep-Alive,Content-Type';
        add_header 'Access-Control-Max-Age' 1728000;
        add_header Access-Control-Allow-Headers "X-Requested-With, X-Prototype-Version, X-CSRF-Token, x-csrftoken, Origin, Accept, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization";
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    access_log /var/log/nginx/1gram.app-access.log;
    error_log  /var/log/nginx/1gram.app-error.log error;

    sendfile off;

    client_max_body_size 0;
    location /img/ {
        alias /data/convert/;
    }
    location /org/ {
        alias /data/upload/;
    }
    location /storage/image/ {
        alias /nas/;
    }
    location ~ ^/(crossdomain.xml) { alias /home/vagrant/kk.xml; }
    location /vod/ {
        alias /data/convert/;

    }
    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;

        fastcgi_intercept_errors off;
        fastcgi_buffer_size 16k;
        fastcgi_buffers 4 16k;
        fastcgi_connect_timeout 300;
        fastcgi_send_timeout 300;
        fastcgi_read_timeout 300;
    }

    location ~ /\.ht {
        deny all;
    }

}
```

# rest-api 설치 구성법

## rest-api 구성

`./rest-api`라는 폴터를 생성하여 해당 위치에 깃을 받아줍니다.

```bash
$ mkdir rest-api
$ cd rest-api 

# git clone으로 프로젝트 구성
$ git clone http://repo.bubblecon.io/solution/rest-api.git .

# npm install을 이용하여 패키지 구성
$ npm i
```

## php package 설치

php8은 `docker`를 이용하여 설치하였기 때문에 `compsoer package` 는 `docker`안에서 설치하여야 합니다.

```bash
# docker를 이용하여 php80-fpm 컨테이너 접속
$ sudo docker exec -it restapi_php_1 bash

# composer를 이용하여 php package install
$ composer install
```

## Laravel Stroage Permission 설정

laravel은 웹에서 접근할 수 있도록 `stoage`경로에 `php.ini`에 설정된 유저로 권한을 변경해주어야 합니다.

해당 프로젝트는 `php.ini`를 따로 수정하지 않았기 때문에 유저를 `www-data`로 변경해주어야 합니다.

```bash
$ chown -R www-data:www-data storage
```
