[![Build Status](https://travis-ci.org/Craffft/contao-oauth2-bundle.svg?branch=master)](https://travis-ci.org/Craffft/contao-oauth2-bundle)

Contao OAuth2 Bundle
=============================

Contao OAuth2 Bundle for Symfony

Installation
------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require craffft/contao-oauth2-bundle "~1.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Craffft\ContaoOAuth2Bundle\CraffftContaoOAuth2Bundle(),
        );

        // ...
    }

    // ...
}
```

### Step 3: Config the Bundle

As next add the following configuration to the `app/config/config.yml` file of
your project:

```yml
# app/config/config.yml

# ...
# FOS OAuth2 Server Bundle
fos_oauth_server:
    db_driver: orm
    client_class:        Craffft\ContaoOAuth2Bundle\Entity\OAuth2Client
    access_token_class:  Craffft\ContaoOAuth2Bundle\Entity\OAuth2AccessToken
    refresh_token_class: Craffft\ContaoOAuth2Bundle\Entity\OAuth2RefreshToken
    auth_code_class:     Craffft\ContaoOAuth2Bundle\Entity\OAuth2AuthCode
    service:
        user_provider: craffft.contao_oauth2.user_provider
```

Copy the content of `vendor/contao/core-bundle/src/Resources/config/security.yml`
file and replace `app/config/security.yml` file with it. Than amend it with the
following code:

```yml
# app/config/security.yml

# ...
security:
    encoders:
        Craffft\ContaoOAuth2Bundle\Entity\Member:
            id: craffft.contao_oauth2.contao_password_encoder

    firewalls:
        oauth_token:                                   # Everyone can access the access token URL.
            pattern: ^/oauth/v2/token
            security: false

        api:
            pattern: ^/api                             # All URLs are protected
            fos_oauth: true                            # OAuth2 protected resource
            stateless: true                            # Do no set session cookies
            anonymous: false                           # Anonymous access is not allowed
```
