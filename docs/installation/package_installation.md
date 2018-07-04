![SeAT](https://i.imgur.com/aPPOxSK.png)


#SeAT-Discourse Installation

In order to install SeAT-Discourse you must prepare some things and finally install the plugin:

## Preparation

### Create API key

Navigate to `discourse.example.com` and log on. Top right press the 3 lines and select `Admin`. Go to API tab and press `Generate Master API Key`.

Add the following values to your SeAT `.env` file:

* `DISCOURSE_URL`: `https://discourse.example.com` (do not add a trailing slash!)
* `DISCOURSE_API_USERNAME`: the username of the admin account you generated the API key with
* `DISCOURSE_API_KEY`: the key you just generated

### Configure SSO

Navigate to `discourse.example.com` and log in. Back to the admin site, scroll down to find SSO settings and set the following:
 
 * `enable_sso`: True
 * `sso_url`: `http://seat.example.com/discourse/sso`
 * `sso_secret`: some secure key

Save, now set `DISCOURSE_SECRET` in your SeAT `.env` file to the secure key you just put in Discourse.

## Package installation
Install Discourse SSO for Laravel:

<section class="mdc-tabs">
<ul class="mdc-tab-bar">
  <li class="mdc-tab active"><a role="tab" data-toggle="tab">Docker</a></li>
  <li class="mdc-tab"><a role="tab" data-toggle="tab">Non-Docker</a></li>
</ul>
<div class="mdc-panels">
<div role="tabpanel" class="mdc-panel active">

    <p>Add <code class="bash hljs">herpaderpaldent/seat-discourse</code> to SeAT Plugins list to install inside your <code class="bash hljs">.env</code></p>

    <pre><code class="bash hljs"># SeAT Plugins
    # This is a list of the all of the third party plugins that you
    # would like to install as part of SeAT. Package names should be
    # comma seperated if multiple packages should be installed.
    SEAT_PLUGINS=herpaderpaldent/seat-discourse
    </code></pre>

</div>
<div role="tabpanel" class="mdc-panel">
    <p>Inside your SeAT Folder run the following:</p>

    <pre><code class="bash hljs">composer require herpaderpaldent/seat-discourse</code></pre>

</div>
</section>


add the following to your SeAT `.env` file:

* `DISCOURSE_URL` (do not add a trailing slash!)
* `DISCOURSE_API_USERNAME` the username of the admin account you generated the API key with
* `DISCOURSE_API_KEY` the key you just generated

```bash
DISCOURSE_URL=https://discourse.example.com
DISCOURSE_API_USERNAME=username
DISCOURSE_API_KEY=key
DISCOURSE_SECRET=secret
```

!!! hint 
    If you use Docker you need to run `docker-compose up -d` in your `opt/seat-docker` folder.

!!! success 
    Now you got SeAT-Discourse installed. 

### For SeAT 3.0, you are done with the Install

The package uses the auto registration feature



## Left to do

* document Discourse configuration
* send `log out` to Discourse when disabling/deleting the user
* failed login redirect