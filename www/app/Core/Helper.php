<?php

declare (strict_types = 1);

namespace Songfolio\Core;

class Helper
{
    /**
     * @param $targetDirProp
     * @param $name
     * @return string
     */
    public static function uploadImage(string $targetDirProp, string $name)
    {
        $targetDir = $targetDirProp;
        $fileName = basename($_FILES[$name]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if($fileType !== ''){
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES[$name]["tmp_name"], $targetFilePath)) {
                    $statusMsg = 'OK';
                } else {
                    $statusMsg = "Désolé, une erreur se produit.";
                }
            } else {
                $statusMsg = 'Format n\'est pas bon.';
            }

            return $statusMsg === 'OK' ? $targetFilePath : $statusMsg;
        } else {
            return null;
        }
    }

    /**
     * Return label function
     *
     * @param string $value
     * @return string
     */
    public static function getLabelFromMapping(string $value): string
    {
        $conf = yaml_parse_file(__DIR__ . '/../config/back.global.yml');
        return $conf['mapping_header_name'][$value] ?? $conf['mapping_header_name']['admin'] ;
    }

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
     * @param string $classname
     * @return string
     */
    public static function getCalledClass(string $classname): string
    {
        return substr(strrchr($classname, "\\"), 1);
    }

    /**
     * @param string $date
     * @return string
     */
    public static function getFormatedDate($date): string
    {
        if($date !== null)
            return date("d/m/Y", strtotime($date));
        return '';
    }

    public static function getFormatedDateWithTime($date): string
    {
        if($date !== null){
            $dt = date("d/m/Y  H:i", strtotime($date));
            return substr_replace($dt, ' à ', strrpos($dt," "), 0);;
        }
            
        return '';
    }

    /**
     * @param $arr
     * @param $compare
     * @param $return
     * @return bool|string
     */
    public static function searchInArray($arr, $compare, $return)
    {
        foreach ($arr as $item) {
            if( $item['id'] === $compare ){
                return $item[$return];
                break;
            }
        }
        return false;
    }

    public static function getImageName(string $str): string
    {
        return substr(strrchr($str, "/"), 1);
    }

}
