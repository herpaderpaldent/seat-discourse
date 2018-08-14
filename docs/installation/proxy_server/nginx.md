![SeAT](https://i.imgur.com/aPPOxSK.png)

# Nginx

If you have chosen to use nginx as proxy-server you need to do a few things:

## Change TCP/IP Ports


To install behind a proxy server, look for this section in the `app.yml` and change the external ports
````bash
## which TCP/IP ports should this container expose?
## If you want Discourse to share a port with another webserver like Apache or nginx,
## see https://meta.discourse.org/t/17247 for details
expose:
  - "80:80"   # http
  - "443:443" # https
````

and change it to something alike:
````bash
expose:
  - "7890:80"   # http
  - "7891:443" # https
````

## Setup nginx proxy-pass

Next we need to tell nginx to proxy pass our pre-defined ports; we do this by creating a configuration file for the forum:

```bash
vi /etc/nginx/sites-available/discourse
```

and set the contents to:

```bash
server {
    listen 80;
    server_name discourse.example.com;

    location / {
        proxy_pass http://127.0.0.1:7890;
    }
}
```

## Enable new site configuration 

```bash
ln -s /etc/nginx/sites-available/discourse /etc/nginx-sites-enabled/discourse
```

## Test nginx

```bash
nginx -t
```

Successful test should yield an output of:

```bash
➜  ~ nginx -t
nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful
```

## Restart nginx to apply new settings

```bash
systemctl restart nginx
```

## Build and launch

After every change to the `app.yml` you need to rebuild your discourse application:

````bash
./launcher rebuild app
./launcher start app
````

!!! success
    Your discourse instance is now available at `discourse.example.com`. 