# PJAMASC Website

## Installation Instructions
1. Install Apache 2.
	1. Set the document root to `<project_root>/public`.
	2. Ensure Apache's `AllowOverride` is set to `All` for the document root.
2. Install PHP version 7.2 or higher.
3. Install MySQL.
	1. Create a user according to the details speficied in `integration/Database.php`.
	2. Run `pjamasc.sql`.
4. Install [Composer](https://getcomposer.org/download/).
5. Run `composer install` in the project root.
