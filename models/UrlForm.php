<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class UrlForm extends Model
{
    public $url;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['url'], 'required'],
            // email has to be a valid email address
            ['url', 'url'],
        ];
    }
}
