<?php

declare(strict_types=1);

require __DIR__.'/../fernet.bootstrap.php';

use App\Component\App;
use Fernet\Framework;

Framework::getInstance()->run(App::class)->send();
