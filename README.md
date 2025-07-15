# Autoloading issue with PHPStan

This project is a minimal example of an autoloading issue in PHPStan.
When a project uses a custom autoloader in addition to the default Composer autoloader, only the custom autoloader
seems to be used to discover classes, which can lead to incorrect results in some cases.

The purpose of the autoloader in this project is to allow model classes to be used for any table without having to
define a class. It is based on a legacy project which uses this functionality.

Any class starting with `Model` will be automatically defined by the autoloader as an empty class extending `Model`,
note that in the actual project it also does things like setting the table name, but that isn't relevant for this example.

Running `php public/index.php` shows "Hello, world!", showing the ModelX class is loaded correctly.

However running `vendor/bin/phpstan` returns an error. If we edit the custom autoloader to explicitly exclude the 
`Model` class, we no longer get a fatal error however the `ModelX::MY_PROP` property is not recognized by PHPStan.