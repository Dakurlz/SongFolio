<?php

declare (strict_types = 1);


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
}
