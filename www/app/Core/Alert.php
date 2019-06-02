<?php
declare (strict_types = 1);

namespace Songfolio\Core;

class Alert
{
    public static function getAlertPropsByAction(string $action, string $name, bool $genderFemale = null)
    {
        $type = '';
        $messsage = '';
        switch ($action) {
            case 'create':
                $type = 'success';
                $messsage = $name . ' ajouté';
                break;
            case 'update':
                $type = 'primary';
                $messsage = $name . ' modifié';

                break;
            case 'delete':
                $type = 'danger';
                $messsage = $name . ' supprimé';
                break;
            default:
                $type = 'info';
                break;
        }

        return [
            'type' => $type,
            'message' => $genderFemale ? self::getLableIfGenderFemale($messsage) : $messsage,
        ];
    }

    /**
     * update message if gender female
     *
     * @param string $str
     * @return string
     */
    private static function getLableIfGenderFemale(string $str): string
    {
        return $str . 'e';
    }

    /**
     * Return erros after Validator function
     *
     * @param array $messages
     * @return array
     */
    public static function setAlertErrors(array $messages): array
    {
        return [
            'type' => 'danger',
            'messages' => $messages
        ];
    }

    /**
     * Return erros after Validator function
     *
     * @param string $messages
     * @return string
     */
    public static function setAlertError(string $message): array
    {
        return [
            'type' => 'danger',
            'message' => $message
        ];
    }

    /**
     * Return erros after Validator function
     *
     * @param string $messages
     * @return string
     */
    public static function setAlertInfo(string $message): array
    {
        return [
            'type' => 'info',
            'message' => $message
        ];
    }
}
