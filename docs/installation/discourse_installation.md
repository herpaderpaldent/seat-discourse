![SeAT](https://i.imgur.com/aPPOxSK.png)

# Discourse

This is a purely optional guide and serves only for reference. Please have a look at the [official discourse documentation](https://github.com/discourse/discourse/blob/master/docs/INSTALL.md).

## Install Docker

!!! info "Not necessarily for SeAT-Docker Installations"
    If you are running a dockerized SeAT Instance you do not need to do this step
    
````bash
wget -qO- https://get.docker.io/ | sh
````

## Install Discourse

### Download Discourse
````bash
mkdir /opt/discourse
git clone https://github.com/discourse/discourse_docker.git /opt/discourse
````
### Configure

Copy the sample configuration into the `/containers` folder 
````bash
cd /opt/discourse
cp samples/standalone.yml containers/app.yml
````
then edit the `app.yml` with a text editor (`nano`, `vi`, etc.)

````bash
nano containers/app.yml
````

Change the following:

!!! warning 
    Warning Discourse will not work from an IP address, you must own a domain name such as `example.com` to proceed.


* `DISCOURSE_HOSTNAME` should be `discourse.example.com` or something similar.

!!! warning 
    **Email is CRITICAL for account creation and notifications in Discourse.** If you do not properly configure email before bootstrapping YOU WILL HAVE A BROKEN SITE!
    
* `DISCOURSE_DEVELOPER_EMAILS` should be a list of admin account email addresses separated by commas.
* `DISCOURSE_SMTP_ADDRESS`
* `DISCOURSE_SMTP_USER_NAME`
* `DISCOURSE_SMTP_PASSWORD`

!!! hint
    No existing mail server? Checkout discourse's [Recommended Email Providers for Discourse](https://github.com/discourse/discourse/blob/master/docs/INSTALL-email.md) 



### Build and launch

````bash
./launcher bootstrap app
./launcher start app
````

!!! success
    Your discourse instance is now available at `discourse.example.com`

!!! hint
    After every change to the `app.yml` you need to rebuild your discourse application: `./launcher rebuild app`
