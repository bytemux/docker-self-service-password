# LDAP Tool Box Self Service Password with Docker
Self Service Password is a PHP application that allows users to change their password in an LDAP directory. See links:
[ltb-ssp website](https://github.com/ltb-project/self-service-password)
[ltb-ssp  github](http://ltb-project.org/wiki/documentation/self-service-password)

## How to use this image

### Run demo with default config
```bash
docker run -d \
       -p 8080:80 \
       --name ssp \
       n3tdom/docker-self-service-password:latest
```
---

### Run with example configuration
Config example contains settings for:
- Active Directory as LDAP provider using LDAPS
- Yandex.ru as email provider
- Email token as the only way of resetting password
- Some fixes in russian localization

### Prepare for install
[docs source](https://ltb-project.org/documentation/self-service-password/latest/start)

### 1. Set permissions on OU with users
Use Delegate control wizard within “User and computers”, then place checkbox:
[x]  User Object
[x]  Reset Password
[x]  Write shadowlastchange
[x]  Write lockoutTime (if you need accounts to unlock on password reset)

### 2. Enable LDAPS, for example with self signed certificate
- **On linux machine.** Create CA key pair
    openssl genrsa -des3 -out ca.key 4096
    openssl req -new -x509 -sha256 -days 3650 -key ca.key -out ca.crt
- **On active directory server**
  - Add the generated ca.crt to the certificate path Trusted Root Certification Authorities\Certificates
  - Create request: ```certreq -new request.inf client.csr```
- **On linux machine.**
  - Create dc client cert: ```openssl x509 -req -days 3650 -in client.csr -CA ca.crt -CAkey ca.key -extfile v3ext.txt -set_serial 01 -out client.crt```
  - Check cert, X509v3 extensions must be present (like in v3ext.txt): ```openssl x509 -in ca.crt -text -noout```
- **On active directory server**
  - accept dc client cert (will show up in computer certs -> personal): ```certreq -accept client.crt```
  - restart ad specific service / or just reboot server: ```ldifde -i -f ldap-renew-cert```
- **On linux machine.**
  - Try to connect to LDAPS: ```nc -zv dc.example.local 636```

### 3. Install with example config
```bash
# 1. Prepare container: get latest ltb & change config
curl -sSL https://github.com/ltb-project/self-service-password/archive/v1.3.tar.gz -o temp.tar.gz && \
  mkdir -p ./ssp && \
  tar zxf temp.tar.gz --strip 1 -C ./ssp && \
  rm temp.tar.gz
cp example/config.inc.local.php ./ssp/conf/config.inc.local.php

# 2. Set secrets, CTRL+F INSERT_DATA

# 3. Launch
docker run -d \
  -p 8080:80 \
  --restart=always \
  --name ssp \
  -v ./ssp:/var/www/html \
  -v ./openldap:/etc/openldap \
  n3tdom/docker-self-service-password
```
---

### Troubleshoot
```docker logs ssp```


And optionally:
```php
$debug = false;
$mail_smtp_debug = 1;
$mail_debug_format = 'error_log';
```
