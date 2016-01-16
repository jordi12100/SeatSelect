Installation
============

Install composer packages
-------------------------

> php composer.phar install


Build database
-------------------------
 * Modify `Cinema/src/Cinema/Factory/EntityManager.php`
 * Execute doctrine schema
 
> ./vendor/bin/doctrine orm:schema-tool:create

Run tests
============
 * ./vendor/bin/phpunit

Author
============
 * Jordi Kroon
