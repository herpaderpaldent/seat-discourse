![SeAT](https://i.imgur.com/aPPOxSK.png)

# Traefik

If you have chosen to use traefik as proxy-server you need to do a few things:

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
docker_args:
  - "--network=web"
  - "--expose=80"
  - "-l traefik.backend=forum"
  - "-l traefik.frontend.rule=Host:discourse.example.com"
  - "-l traefik.docker.network=web"
  - "-l traefik.port=80"
````


## Build and launch

After every change to the `app.yml` you need to rebuild your discourse application:

````bash
./launcher rebuild app
./launcher start app
````

!!! success
    Your discourse instance is now available at `discourse.example.com`. If you have setup your `.toml` correctly your discourse instance will be available via `https://`