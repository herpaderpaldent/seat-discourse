![SeAT](https://i.imgur.com/aPPOxSK.png)

!!! info "Work in Progress"
    Site is work in progress

#Package installation
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
On the discourse-page settings set the URL accordingly: 
Discourse-URL: `{{base_url}}/discourse/sso`

### For SeAT 3.0, you are done with the Install

The package uses the auto registration feature



## Left to do

* document Discourse configuration
* send `log out` to Discourse when disabling/deleting the user
* failed login redirect