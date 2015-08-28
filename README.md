NetGalley ApiClientBundle
=========================

This bundle integrates the [NetGalley API Client](https://github.com/fbng/netgalley-api-client) into Symfony2.

# Installation

## Get the Composer package

To install with [Composer](https://getcomposer.org/), run:

```sh
composer require fbng/netgalley-api-client-bundle
```

Alternatively, add the following to your `composer.json` file:

```yaml
    "require": {
        ...
        "fbng/netgalley-api-client-bundle": "*",
        ...
    },
```

Then run `composer update`.

## Set your configurations

Depending on the API authentication credentials provided, set either the `auth` or `oauth` credentials in your configuration:

```yaml
# NetGalley API Client configuration
net_galley_api_client:
    auth:
        key: %my_api_key%
        secret: %my_api_secret%
        user: %my_api_user_name%
    oauth:
        client: %my_oauth_client_id%
        secret: %my_oauth_secret%
```

While developing your application, you will also need to target the staging server to make sandbox requests:

```yaml
net_galley_api_client:
    options:
        test_mode: true
```

If a different server needs to be targeted for your sandbox requests, you can override the default staging server URL with:

```yaml
net_galley_api_client:
    options:
        test_domain: %alternate_api_test_domain%
```

## Add the ApiClientBundle to your Symfony kernel

```php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new NetGalley\ApiClientBundle\NetGalleyApiClientBundle(),
        // ...
    );
}
```

# Usage

Request the service according to your authentication method:

```php
// to authenticate by hash / key
$client = $this->get('netgalley_api_client');

// to authenticate by Oauth2 client
$client = $this->get('netgalley_oauth_client');

// make an API request; see the relevant documentation
// for details of the API you are requesting; here we
// are creating a new widget for a customer
$response = $client->makeRequest('/widgets', 'POST', array(
    'email' => 'customer@gmail.com',
    'isbn' => '1234567890123',
    'market' => 'US',
    'temporaryDrm' => false,
    'firstName' => 'Some',
    'lastName' => 'Customer'
));

// the response will be a JSON-encoded string, so decode it
$response = json_decode($response, true);

// do something with the response
echo 'Response was: ' . print_r($response, true) . PHP_EOL;
```

That's it!

# API Documentation

See the [API Documentation](http://htmlpreview.github.com/?https://github.com/fbng/netgalley-api-client/blob/master/documentation/index.html) within this repository for up-to-date information on each REST API.
