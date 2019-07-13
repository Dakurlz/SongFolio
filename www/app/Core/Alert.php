<?php
declare (strict_types = 1);

namespace Songfolio\Core;

class Alert
{

    public static function getAlertMessage()
    {
        debug($_SESSION);
        debug(View::addModal('alert',$_SESSION['alert']));
        return isset($_SESSION['alert']) ? (View::addModal('alert',$_SESSION['alert'])) : null;
    }


    public static function setAlertPropsByAction(string $action, string $name, bool $genderFemale = null)
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

        $_SESSION['alert'] = [
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
     * @param string $messages
     * @return string
     */
    public static function setAlertError(string $message)
    {
        $_SESSION['alert'] = [
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
    public static function setAlertInfo(string $message)
    {
        $_SESSION['alert'] = [
            'type' => 'info',
            'message' => $message
        ];
    }
}
