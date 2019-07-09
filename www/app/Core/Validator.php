<?php

declare(strict_types=1);

namespace Songfolio\Core;

use Songfolio\Core\View;
use Songfolio\Models\Slug;

class Validator
{

    private $errors = [];

    public function __construct($config, $data)
    {
        foreach ($config["data"] as $name => $input) {
            //required

            if ( ($input["required"] ?? false) && empty($data[$input['name']]) ) {
                View::show404("Tentative de Faille XSS");
            } elseif ( ($input["required"] ?? false) || !empty($data[$input['name']]) ) {
                //Minlength
                if (isset($input["minlength"]) && !self::checkMinLength($data[$input['name']], $input["minlength"])) {
                    $this->errors[] = $input["error"];
                    continue;
                }
                //Maxlength
                if (isset($input["maxlength"]) && !self::checkMaxLength($data[$input['name']], $input["maxlength"])) {
                    $this->errors[] = $input["error"];
                    continue;
                }
                //Email
                if ($input["type"] == "email" && !self::checkEmail($data[$input['name']])) {
                    $this->errors[] = $input["error"];
                    continue;
                }
                //Mot de passe
                if ($input["type"] == "password" && !self::checkPwd($data[$input['name']])) {
                    $this->errors[] = $input["error"];
                    continue;
                }
                //Confirm
                if (isset($input["confirm"]) && $data[$name] != $data[$input["confirm"]]) {
                    $this->errors[] = $input["error"];
                    continue;
                }
                //Slug
                if ($input["type"] === 'slug') {

                    switch ($config['config']['action_type']) {
                        case 'update':
                            $obj =  $config['config']['current_object'];
                            $values =  $obj->getByCustomQuery(['id' => $obj->__get('id')], 'id, slug');
                            if ($values['slug'] !== $data['slug']) $this->checkSlug($data['slug']);

                            continue;

                        case 'create':
                            $this->checkSlug($data['slug']);
                            continue;

                        default:
                            continue;
                    }
                }
            }
        }

        if (isset($data['new_pwd']) && !self::checkNewPwd($data['new_pwd'], $data['valid_new_pwd'])) {
            $this->errors[] = $input["error_not_same"];
        }
    }

    /**
     * Return errors arrya function
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function checkSlug($slug)
    {
        if (Slug::checkIfExist($slug))
            $this->errors[] = 'Slug existe déjà';
    }

    public static function checkMinLength($string, $length)
    {
        return strlen(trim($string)) >= $length;
    }
    public static function checkMaxLength($string, $length)
    {
        return strlen(trim($string)) <= $length;
    }
    public static function checkEmail($string)
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL);
    }
    public static function checkPwd($string)
    {
        return (preg_match("#[A-Z]#", $string) &&
            preg_match("#[a-z]#", $string) &&
            preg_match("#[0-9]#", $string));
    }
    public static function checkNewPwd($new_pwd, $valid_new_pwd)
    {
        return $new_pwd == $valid_new_pwd;
    }
}
