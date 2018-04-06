# Hepraderp Aldent's - SeAT Discourse

This SeAT-Package is based upon [SPINEN's Discourse SSO for Laravel](https://github.com/spinen/laravel-discourse-sso). 
Extendend with [richp10/discourse-api-php](https://github.com/richp10/discourse-api-php) to be able to create users and 
topics based on roles in SeAT.

## Prerequisite

There are two dependencies.

* ["cviebrock/discourse-php": "^0.9.3"](https://github.com/cviebrock/discourse-php)
* ["richp10/discourse-api-php": "^1.2"](https://github.com/richp10/discourse-api-php)

## Install

Install Discourse SSO for Laravel:

```bash
    $ composer require herpaderpaldent/seat-discourse
```

### For SeAT 3.0, you are done with the Install

The package uses the auto registration feature



## Left to do

* document Discourse configuration
* send `log out` to Discourse when disabling/deleting the user
* badges to user
* support for [`custom_fields`](https://meta.discourse.org/t/custom-user-fields-for-plugins/14956)
* failed login redirect
* `return_paths` support
