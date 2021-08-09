<?php

namespace App\Representations;

interface RepresentationInterface
{
    public function toJson();

    public function toArray();
}
