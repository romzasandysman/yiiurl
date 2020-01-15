<?php


namespace app\models;

use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\models\db\Shorturls;

class UrlShortView
{
    private $objShortUrl = null;
    private $dbTableUrls = null;

    public function __construct($url = '')
    {
        if (!$url) return;

        if (strlen($url) < 10){
            throw new InvalidArgumentException('Url "' . $url . '" is not long enough');
        }

        $this->dbTableUrls = new Shorturls();

        if (!$this->checkExistUrl($url)){
            $this->makeShortUtl($url);
            $this->insertNewUrlInTable($url);
        }
        unset($this->dbTableUrls);
    }

    public function getShortUrl()
    {
        return $this->objShortUrl;
    }

    public function insertNewUrlInTable($url)
    {
        $dbInsertNewElement = new Shorturls();
        $dbInsertNewElement->url = $url;
        $dbInsertNewElement->shortUrl = $this->getShortUrl();
        $dbInsertNewElement->save();
        unset($dbInsertNewElement);
    }

    private function checkExistUrl($url)
    {
        $url = $this->dbTableUrls->find()->where(['url' => $url])->one();

        if (!empty($url)){
            $this->objShortUrl = $url->shortUrl;
            return true;
        }else {
            return null;
        }
    }

    private function getShortUrlOfLastElementInDb()
    {
        $lastUrl = $this->dbTableUrls->find()->orderBy('id DESC')->one();

        if (!empty($lastUrl)){
            return $lastUrl->shortUrl;
        }else {
            return null;
        }
    }

    private function makeShortUtl($url)
    {
        $cntForWhile = $lengthOfShortName = 6;
        $shortOfLastElement = $this->getShortUrlOfLastElementInDb();

        if (!empty($shortOfLastElement)){
            $prepareShortUrl = substr(md5($shortOfLastElement),0, $lengthOfShortName);
        }else{
            $prepareShortUrl = substr(md5($url),0, $lengthOfShortName);
        }

        if (preg_match('/\D/',$prepareShortUrl)) {
            while ($cntForWhile > 0) {
                $randUpper = rand(0, $lengthOfShortName);

                if (isset($prepareShortUrl[$randUpper]) && rand(0, 1)) {
                    $prepareShortUrl[$randUpper] = strtoupper($prepareShortUrl[$randUpper]);
                }

                $cntForWhile--;
            }
        }

        $this->objShortUrl = $prepareShortUrl;
    }

}