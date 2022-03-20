<?php

namespace App\Infrastructure\Service;

use Dejurin\GoogleTranslateForFree;

/**
 *
 */
class TranslateService
{

    /**
     * @var string
     */
    private string $source = 'ru';

    /**
     * @var int
     */
    private int $attempts = 5;


    /**
     * @var string
     */
    private string $target = 'en';

    /**
     * @var GoogleTranslateForFree
     */
    private GoogleTranslateForFree $translate;

    /**
     * @param GoogleTranslateForFree $translate
     */
    public function __construct(GoogleTranslateForFree $translate)
    {
        $this->translate = $translate;
    }

    /**
     * @param $text
     * @return array|string
     */
    public function defaultTranslate($text)
    {
        return $this->translate->translate($this->getSource(), 'ru', $text, $this->getAttempts());
    }

    /**
     * @param $source
     * @param $text
     * @return array|string
     */
    public function translate($target, $text)
    {
        return $this->translate->translate($this->getSource(), $target, $text, $this->getAttempts());
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return int
     */
    public function getAttempts(): int
    {
        return $this->attempts;
    }

    /**
     * @param int $attempts
     */
    public function setAttempts(int $attempts): void
    {
        $this->attempts = $attempts;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget(string $target): void
    {
        $this->target = $target;
    }
}