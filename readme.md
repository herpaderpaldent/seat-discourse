# Hepraderp Aldent's - SeAT Discourse

This SeAT-Package is based upon [SPINEN's Discourse SSO for Laravel](https://github.com/spinen/laravel-discourse-sso). 
Extendend with [richp10/discourse-api-php](https://github.com/richp10/discourse-api-php) to be able to create users and 
topics based on roles in SeAT.

## Prerequisite

There are is one dependency.

* ["cviebrock/discourse-php": "^0.9.3"](https://github.com/cviebrock/discourse-php)

## Install

Install Discourse SSO for Laravel:

```bash
    $ composer require herpaderpaldent/seat-discourse
```

add following to the `.env`:



* DISCOURSE_URL (do not add a trailing slash!)
* DISCOURSE_API_USERNAME the username of the admin account you generated the API key with
* DISCOURSE_API_KEY the key you just generated
```
DISCOURSE_URL=https://discourse.example.com
DISCOURSE_API_USERNAME=username
DISCOURSE_API_KEY=key
DISCOURSE_SECRET=secret
```
Discourse-URL {{base_url}}/discourse/sso

### For SeAT 3.0, you are done with the Install

The package uses the auto registration feature



## Left to do

* document Discourse configuration
* send `log out` to Discourse when disabling/deleting the user
* failed login redirect

