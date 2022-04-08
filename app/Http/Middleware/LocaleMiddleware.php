<?php

namespace App\Http\Middleware;

use Closure;
use App;
//use Illuminate\Support\Facades\App;
use Request;

class LocaleMiddleware
{
    public static $mainLanguage = 'uk'; //основной язык, который не должен отображаться в URl

    public static $languages = ['en', 'uk']; // Указываем, какие языки будем использовать в приложении.


    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        $uri = Request::path(); //получаем URI


        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"


        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {

            if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0];

        }
        return null;

    }

    public static function printLink()
    {
        $locale = self::getLocale();
        if(!$locale) return '/'.$_SERVER['SERVER_NAME'] ;
        return $locale;
    }

    /*
    * Устанавливает язык приложения в зависимости от метки языка из URL
    */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if($locale) App::setLocale($locale);
        //если метки нет - устанавливаем основной язык $mainLanguage
        else App::setLocale(self::$mainLanguage);

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }

}
