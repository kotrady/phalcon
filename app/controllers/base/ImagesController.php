<?php
namespace Action\Controllers\Base;

use Phalcon\Mvc\View;
use Web\Action;
use Phalcon\Http\Response as Response;

class ImagesController extends Action {

    public function indexAction() {
        $media = require APP_PATH . '/config/media.php';
        $imageParam = $this->dispatcher->getParam("image");
        $imageExplode = explode('/', $imageParam);
        $imageName = end($imageExplode);
        $imagePath = implode('/', array_slice($imageExplode, 0, -1));
        $imageMedia = $imageExplode[0];

        $fileExist = BASE_PATH . '/public/media/' . implode('/', array_slice($imageExplode, 1));
        $cacheExist = BASE_PATH . '/cache/media/' . $imageParam;

        if (!file_exists($cacheExist) && file_exists($fileExist) && isset($media['images'][$imageMedia])) {

            $newWidth = $media['images'][$imageMedia]['width'] ?: null;
            $newHeight = $media['images'][$imageMedia]['height'] ?: null;

            list($fileExistWidth, $fileExistHeight, $fileExistType) = getimagesize($fileExist);
            switch ($fileExistType) {
                case IMAGETYPE_GIF:
                    $createImage = imagecreatefromgif($fileExist);
                    break;
                case IMAGETYPE_JPEG:
                    $createImage = imagecreatefromjpeg($fileExist);
                    break;
                case IMAGETYPE_PNG:
                    $createImage = imagecreatefrompng($fileExist);
                    break;
            }

            if ($createImage === false) { return false; }

            if(isset($media['images'][$imageMedia]['ratio']) && $media['images'][$imageMedia]['ratio']){

                $newImageWidth = $newWidth;
                $newImageHeight = ($newImageWidth / $fileExistWidth) * $fileExistHeight;

                if ($newImageHeight > $newHeight) {
                    $newImageHeight = $newHeight;
                    $newImageWidth = ($newImageHeight / $fileExistHeight) * $fileExistWidth;
                }

            }
            else {
                $newImageHeight = $newHeight;
                $newImageWidth  = $newWidth;
            }

            @mkdir(BASE_PATH . '/cache/media/' . $imagePath, 0777, true);

            $mediaGdImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
            imagecopyresampled($mediaGdImage, $createImage, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $fileExistWidth, $fileExistHeight);
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            $backgroundColor = imagecolorallocatealpha($newImage, 0, 0, 0, 127);

            imagesavealpha($newImage, true);
            imagealphablending($newImage, false);

            imagefill($newImage, 0, 0, $backgroundColor);
            imagecopy($newImage, $mediaGdImage, (imagesx($newImage) / 2) - (imagesx($mediaGdImage) / 2), (imagesy($newImage) / 2) - (imagesy($mediaGdImage) / 2), 0, 0, imagesx($mediaGdImage), imagesy($mediaGdImage));

            if(isset($media['images'][$imageMedia]['cache']) && $media['images'][$imageMedia]['cache']) {
                imagepng($newImage, $cacheExist);
            }
            else {
                imagepng($newImage);
            }

            file_exists($cacheExist) ? $finalFile = $cacheExist : $finalFile = $newImage;

            imagedestroy($createImage);
            imagedestroy($mediaGdImage);
            imagedestroy($newImage);

        }

        file_exists($cacheExist) ? $finalFile = $cacheExist : $finalFile = $fileExist;

        header('Content-Type: image/jpeg');
        readfile($finalFile);
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }

}