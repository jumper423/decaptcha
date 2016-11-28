<?php

namespace jumper423;

interface CaptchaInterface
{
    public function run($filename);

    public function result();

    public function error();
}