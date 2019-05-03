<?php

declare (strict_types = 1);

namespace app\Core;

class Helper
{

    public static function uploadImage($targetDirProp): string
    {
        $targetDir = $targetDirProp;
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $statusMsg = 'OK';
            } else {
                $statusMsg = "Désolé, une erreur se produit.";
            }
        } else {
            $statusMsg = 'Format n\'est pas bon.';
        }

        return $statusMsg === 'OK' ? $targetFilePath : $statusMsg;
    }

    /**
     * Return label function
     *
     * @param string $value
     * @return string
     */
    public static function getLabelFromMapping(string $value): string
    {
        $conf = yaml_parse_file(__DIR__ . '/../config/back.global.php');
        return $conf['mapping_header_name'][$value];
    }

    public static function getAlertPropsByAction(string $action, string $name, bool $genderFemale = null)
    {
        \debug($genderFemale);

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
        if ($genderFemale) {
            $message = self::getLableIfGenderFemale($message);
        }

        return [
            'type' => $type,
            'message' => $messsage,
        ];
    }

    /**
     * update message if gender female
     *
     * @param string $str
     * @return string
     */
    private function getLableIfGenderFemale(string $str): string
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
     * @param string $classname
     * @return string
     */
    public static function getCalledClass(string $classname): string
    {
        return substr(strrchr($classname, "\\"), 1);
    }
}
