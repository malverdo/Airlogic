<?php

namespace App\Infrastructure\Repository\BaseRepository;

use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Service\TranslateService;
use Dejurin\GoogleTranslateForFree;

abstract class AbstractEntity implements EntityInterface
{


    public function getTranslate(): TranslateService
    {
        return new TranslateService($this->GoogleTranslateForFree());
    }

    private function GoogleTranslateForFree(): GoogleTranslateForFree
    {
        return new GoogleTranslateForFree();
    }


}