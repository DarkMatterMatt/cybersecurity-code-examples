#

## Setting up locally

1. Install [PHP](https://www.php.net/downloads.php) (download & extract zip archive)
1. Copy `php.ini-development` to `php.ini`
1. Uncomment (remove the leading `;`) the line which sets `extension_dir`
1. Uncomment the `extension=sqlite3` line
1. Run the webserver `/path/to/php -S localhost:8080 -t /path/to/this/repository`
1. Open your browser and navigate to [http://localhost:8080](http://localhost:8080)

## Moving forward

There are countless resources on the internet to help you get started.

A few are listed below:

- [hackthissite.org](hackthissite.org)
- [OWASP JuiceShop]()
- [PentesterLabs]()
