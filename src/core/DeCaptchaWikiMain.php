<?php

namespace jumper423\decaptcha\core;

/**
 * Class DeCaptchaWikiMain.
 */
class DeCaptchaWikiMain extends DeCaptchaWiki
{
    protected $classes = [];

    public function __construct($class)
    {
        parent::__construct($class);
        $this->texts['slug_menu_desc'] = [
            'ru' => 'Описание',
            'en' => 'Description',
        ];
        $this->texts['readme_main_desc'] = [
            'ru' => 'Пакет создан для стандартизации всех сервисов по разгадыванию капч. 
            У каждого сервиса есть свои особенности и теперь Вам надо будет всего лишь взглянуть на документацию конкретного сервиса чтобы правильно всё сделать.
            Так же пакет покрывает всю функциональсть сервисов. Если же Вам будет чего-то нехватать или будут предложения, я буду только рад их услышать.',
            'en' => 'Package created to standardize all services for solving captcha.
            Each service has its own features and now You will have to look at the documentation for the specific service to do everything right. 
            The package covers the entire functionality services. If You will be something lacking or suggestions, I\'ll be glad to hear them.',
        ];
        $this->texts['slug_menu_services'] = [
            'ru' => 'Сервисы',
            'en' => 'Services',
        ];
        $this->texts['readme_main_services'] = [
            'ru' => 'Распознавание капч для всех популярных сервисов',
            'en' => 'Recognition captchas for all popular services',
        ];
        $this->texts['slug_menu_features'] = [
            'ru' => 'Особенности',
            'en' => 'Features',
        ];
        $this->texts['readme_main_features'] = [
            'ru' => [
                '+ Подходит для всех сервисов по распознаванию капч',
                '+ Можно легко добавить новый сервис, используя уже готовый движок',
                '+ Быстрая и интуительно понятная настройка',
                '+ Распознавание как по пути до файла, так и по ссылки',
                '+ ReCaptcha v2 без браузера',
                '+ Полная документация',
                '+ Покрыт тестами',
            ],
            'en' => [
                '+ Suitable for all recognition services captcha',
                '+ You can easily add a new service using the existing engine',
                '+ Intuitable fast and straightforward setup',
                '+ Recognition as the path to the file and links',
                '+ ReCaptcha v2 without a browser',
                '+ Full documentation',
                '+ Covered by tests',
            ],
        ];
    }

    public function addClass($class)
    {
        $this->classes[] = $class;
    }

    protected function viewHeader()
    {
        return 'DeCaptcha
================
[![Latest Stable Version](https://poser.pugx.org/jumper423/decaptcha/v/stable)](https://packagist.org/packages/jumper423/decaptcha)
[![Total Downloads](https://poser.pugx.org/jumper423/decaptcha/downloads)](https://packagist.org/packages/jumper423/decaptcha)
[![License](https://poser.pugx.org/jumper423/decaptcha/license)](https://packagist.org/packages/jumper423/decaptcha)

[![Build Status](https://travis-ci.org/jumper423/decaptcha.svg?branch=master)](https://travis-ci.org/jumper423/decaptcha)
[![Dependency Status](https://www.versioneye.com/user/projects/5849f365a662a5004c110a29/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5849f365a662a5004c110a29)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jumper423/decaptcha/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jumper423/decaptcha/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/jumper423/decaptcha/badges/build.png?b=master)](https://scrutinizer-ci.com/g/jumper423/decaptcha/build-status/master)
[![Code Climate](https://codeclimate.com/github/jumper423/decaptcha/badges/gpa.svg)](https://codeclimate.com/github/jumper423/decaptcha)
[![Issue Count](https://codeclimate.com/github/jumper423/decaptcha/badges/issue_count.svg)](https://codeclimate.com/github/jumper423/decaptcha)
[![codecov](https://codecov.io/gh/jumper423/decaptcha/branch/master/graph/badge.svg)](https://codecov.io/gh/jumper423/decaptcha)
[![HHVM Status](http://hhvm.h4cc.de/badge/jumper423/decaptcha.svg)](http://hhvm.h4cc.de/package/jumper423/decaptcha)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d485629c-1830-440d-82ab-a567bfa5ddc5/mini.png)](https://insight.sensiolabs.com/projects/d485629c-1830-440d-82ab-a567bfa5ddc5)
[![StyleCI](https://styleci.io/repos/75013766/shield?branch=master)](https://styleci.io/repos/75013766)'.PHP_EOL;
    }

    protected function viewMenu($master = '')
    {
        $str = "+ [{$this->getText(['slug', 'menu', 'another'])}](../{$master}docs/".$this->getFileName($this->lang == 'ru' ? 'en' : 'ru').')'.PHP_EOL;
        foreach ([
                     ['slug', 'menu', 'desc'],
                     ['slug', 'menu', 'features'],
                     ['slug', 'menu', 'services'],
                     ['install'],
                     ['example'],
                 ] as $anchor) {
            $str .= "+ [{$this->getText($anchor)}](#".implode('-', explode(' ', ($this->lang === 'en' ? mb_strtolower($this->getText($anchor)) : $this->getText($anchor)))).')'.PHP_EOL;
        }

        return $str;
    }

    public function viewServices($master = '')
    {
        $str = '';
        $tt = [];
        foreach ($this->classes as $class) {
            if (isset($tt[$class->getWiki($this->lang)->getFileName()])) {
                continue;
            }
            $tt[$class->getWiki($this->lang)->getFileName()] = true;
            $fromServiceObjectWiki = $class->getWiki($this->lang);
            $str .= "+ [{$fromServiceObjectWiki->getText(['service', 'name'])}](../{$master}docs/{$fromServiceObjectWiki->getFileName()})".PHP_EOL;
        }

        return $str;
    }

    public function view($master = '')
    {
        $str = $this->viewHeader().PHP_EOL;

        $str .= "{$this->getText(['slug', 'menu'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= $this->viewMenu($master).PHP_EOL.PHP_EOL;

        $str .= "{$this->getText(['slug', 'menu', 'desc'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= $this->getText(['readme', 'main', 'desc']).PHP_EOL.PHP_EOL;

        $str .= "{$this->getText(['slug', 'menu', 'features'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= $this->getText(['readme', 'main', 'features'], PHP_EOL).PHP_EOL.PHP_EOL;

        $str .= "{$this->getText(['slug', 'menu', 'services'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->getText(['readme', 'main', 'services'])}".PHP_EOL.PHP_EOL;
        $str .= "{$this->viewServices($master)}".PHP_EOL.PHP_EOL;

        $str .= "{$this->getText(['install'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->viewInstall()}".PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['example'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->viewExamples()}".PHP_EOL.PHP_EOL;

        return $str;
    }

    public function getFileName($lang = null)
    {
        if (is_null($lang)) {
            $lang = $this->lang;
        }

        return 'README-'.$lang.'.md';
    }

    public function save()
    {
        file_put_contents(__DIR__.'/../../docs/'.$this->getFileName(), $this->view());
        file_put_contents(__DIR__.'/../../README.md', $this->view('master/'));
    }
}
