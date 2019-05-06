# LDAP Tool Box Self Service Password with Docker

A lightweight Self Service Password Docker image built from source atop [Alpine Linux](https://store.docker.com/images/alpine).

Self Service Password is a PHP application that allows users to change their password in an LDAP directory. See http://ltb-project.org/wiki/documentation/self-service-password.

## How to use this image

The easiest way is to create your own configuration file and modify it according to your settings. Download the latest version of the `config.inc.php` file from https://github.com/ltb-project/self-service-password/tree/master/conf/config.inc.php.

## Run demo with default config
```bash
docker run -d \
       -p 8080:80 \
       --name self-service-password \
       n3tdom/docker-self-service-password:latest
```

## Run with local customized config
```bash
curl -sSL https://github.com/ltb-project/self-service-password/archive/v1.3.tar.gz -o temp.tar.gz && \
  mkdir -p /example_ssp && \
  tar zxf temp.tar.gz --strip 1 -C /example_ssp && \
  rm temp.tar.gz;

docker run -d \
       -p 8080:80 \
       --restart=always \
       --name self-service-password \
       -v $(pwd)/example_ssp:/var/www/html n3tdom/docker-self-service-password
```

## Example configuration
Config example contains settings for:
- Active Directory as LDAP provider
- Yandex.ru as email provider
- Email token as the only way of resetting password
- Some fixes in russian localization

## Documentation for LTB Self-Service-Password

Documentation is available on http://ltb-project.org/wiki/documentation/self-service-password
