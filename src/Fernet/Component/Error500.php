<?php
declare(strict_types=1);
namespace Fernet\Component;

class Error500
{
    public bool $preventWrapper = true;

    public function __toString()
    {
        return '<html><body><h1>Error 500</h1><p>Internal server error</p></body></html>';
    }
}
