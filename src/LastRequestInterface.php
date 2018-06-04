<?php

namespace Mobly\LinxMicrovix;

interface LastRequestInterface
{
    public function setLastRequest($request);

    public function getLastRequest();
}
