## Bypass strict input validation to exploit RCE

please read the related article here (add link)

### Run challenge
```bash
docker run -ti --rm -p 9123:80 -v "$PWD":/var/www/html php:7.2-apache
```