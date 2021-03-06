<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Faker\Factory;
use Fernet\Config;
use Fernet\Framework;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require __DIR__.'/vendor/autoload.php';

Dotenv::createImmutable(__DIR__)->load();
$fernet = Framework::setUp([
    'rootPath' => __DIR__,

]);

$whoops = new Run();
$prettyPageHandler = new PrettyPageHandler();
$prettyPageHandler->setEditor($fernet->getConfig('editor'));
$prettyPageHandler->addResourcePath($fernet->getConfig('resourcesPath'));
$whoops->pushHandler(new PlainTextHandler());
$whoops->pushHandler($prettyPageHandler);
$whoops->register();
$fernet->getContainer()->add(Run::class, $whoops);

$faker = Factory::create($fernet->getContainer()->get(Config::class)->faker['lang'] ?? 'en_US');
if (isset($_ENV['FAKER_SEED'])) {
    $faker->seed($_ENV['FAKER_SEED']);
}
Framework::getInstance()->getContainer()->add($faker::class, $faker);
