<p align="center">
<a href="https://github.com/crypt4/jantung-laravel/actions"><img src="https://github.com/crypt4/jantung-laravel/actions/workflows/run-tests.yml/badge.svg" alt="Build Status"></a>
</p>

# Jantung Laravel Client

Jantung is a simple issue tracker for monitoring your application crashes. This package developed for Laravel framework.

## Installation
- Requirements
- Installing Jantung

### Requirements
Jantung has a few requirements you should be aware of before installing:

- Composer
- Laravel Framework 7+

### Installing Jantung
```bash
composer require crypt4/jantung-laravel
php artisan jantung:install
```

After running this command, verify that the `jantung.php` was added to the `config/` directory.

Add the following keys in your `.env`

```bash
JANTUNG_ENDPOINT="https://jantung.crypt4.com/api"
JANTUNG_DRIVER=http
JANTUNG_KEY=api-key
JANTUNG_TOKEN=application-token
```

Test connectivity with Jantung API:

```bash
php artisan jantung:test
```

Then create your application [here](https://jantung.zahir.my/applications/create) and copy the application's key and paste in the `JANTUNG_TOKEN` in your `.env` file..

Then create your API Token [here](https://jantung.zahir.my/users/api-tokens) and copy the token and paste in the `JANTUNG_KEY` in your `.env` file.

Once updated your `.env`, you need to run the following command to verify the connection to Jantung API is configured correctly:

```bash
php artisan jantung:verify
```
