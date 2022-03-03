<?php

namespace PHWolfCMS\Kernel\Modules\Libs;

class SkinViewer {
    private static array $slimDetectPixel = array(42, 51);

    private static array $skinProps = array(
        0 => array('base' => 64, 'ratio' => 2),
        1 => array('base' => 64, 'ratio' => 1),
    );

    private static array $cloakProps = array(
        0 => array('base' => 64, 'ratio' => 2),
        1 => array('base' => 22, 'ratio' => 1.29),
    );

    public static function createPreview($way_skin, $way_cloak = false, $side = false, $size = 224): \GdImage|bool {
        if (!$info = self::isValidSkin($way_skin)) return false;
        $skin = @imagecreatefrompng($way_skin);
        if (!$skin) return false;
        $mp = $info['scale'];
        $size_x = (($side) ? 16 : 32);
        $preview = imagecreatetruecolor($size_x * $mp, 32 * $mp);
        $transparent = imagecolorallocatealpha($preview, 255, 255, 255, 127);
        imagefill($preview, 0, 0, $transparent);
        $armWidth = 4;
        $slim = false;
        if ($info['ratio'] == 1) {
            $color = imagecolorat($skin, self::$slimDetectPixel[0], self::$slimDetectPixel[1]);
            $colors = imagecolorsforindex($skin, $color);
            if ((int)$colors['alpha'] == 127) {
                $slim = true;
                $armWidth = 3;
            }
        }
        if (!$side or $side === 'front') {
            imagecopy($preview, $skin, 4 * $mp, 0 * $mp, 8 * $mp, 8 * $mp, 8 * $mp, 8 * $mp);
            imagecopy($preview, $skin, 4 * $mp, 0 * $mp, 40 * $mp, 8 * $mp, 8 * $mp, 8 * $mp);
            imagecopy($preview, $skin, (4 - $armWidth) * $mp, 8 * $mp, 44 * $mp, 20 * $mp, $armWidth * $mp, 12 * $mp);
            if ($info['ratio'] == 2) {
                self::imageFlip($preview, $skin, 12 * $mp, 8 * $mp, 44 * $mp, 20 * $mp, 4 * $mp, 12 * $mp);
            } else {
                imagecopy($preview, $skin, 12 * $mp, 8 * $mp, 36 * $mp, 52 * $mp, $armWidth * $mp, 12 * $mp);
            }
            imagecopy($preview, $skin, 4 * $mp, 8 * $mp, 20 * $mp, 20 * $mp, 8 * $mp, 12 * $mp);
            imagecopy($preview, $skin, 4 * $mp, 20 * $mp, 4 * $mp, 20 * $mp, 4 * $mp, 12 * $mp);
            if ($info['ratio'] == 2) {
                self::imageFlip($preview, $skin, 8 * $mp, 20 * $mp, 4 * $mp, 20 * $mp, 4 * $mp, 12 * $mp);
            } else {
                imagecopy($preview, $skin, 8 * $mp, 20 * $mp, 20 * $mp, 52 * $mp, 4 * $mp, 12 * $mp);
            }
            if ($info['ratio'] == 1) {
                imagecopy($preview, $skin, (4 - $armWidth) * $mp, 8 * $mp, 44 * $mp, 36 * $mp, $armWidth * $mp, 12 * $mp);
                imagecopy($preview, $skin, 12 * $mp, 8 * $mp, 52 * $mp, 52 * $mp, $armWidth * $mp, 12 * $mp);
                imagecopy($preview, $skin, 4 * $mp, 8 * $mp, 20 * $mp, 36 * $mp, 8 * $mp, 12 * $mp);
                imagecopy($preview, $skin, 4 * $mp, 20 * $mp, 4 * $mp, 36 * $mp, 4 * $mp, 12 * $mp);
                imagecopy($preview, $skin, 8 * $mp, 20 * $mp, 4 * $mp, 52 * $mp, 4 * $mp, 12 * $mp);
            }
        }
        if (!$side or $side === 'back') {
            $mp_x_h = ($side) ? 0 : imagesx($preview) / 2;
            $backArmPos = ($armWidth * 2);
            if ($armWidth < 4) {
                $backArmPos += 4 - $armWidth;
            }
            imagecopy($preview, $skin, $mp_x_h + 4 * $mp, 0 * $mp, 24 * $mp, 8 * $mp, 8 * $mp, 8 * $mp);
            imagecopy($preview, $skin, $mp_x_h + 4 * $mp, 0 * $mp, 56 * $mp, 8 * $mp, 8 * $mp, 8 * $mp);
            imagecopy($preview, $skin, $mp_x_h + 4 * $mp, 8 * $mp, 32 * $mp, 20 * $mp, 8 * $mp, 12 * $mp);
            imagecopy($preview, $skin, $mp_x_h + 12 * $mp, 8 * $mp, (44 + $backArmPos) * $mp, 20 * $mp, $armWidth * $mp, 12 * $mp);
            if ($info['ratio'] == 2) {
                self::imageFlip($preview, $skin, $mp_x_h + 0 * $mp, 8 * $mp, 52 * $mp, 20 * $mp, 4 * $mp, 12 * $mp);
            } else {
                imagecopy($preview, $skin, $mp_x_h + (4 - $armWidth) * $mp, 8 * $mp, (36 + $backArmPos) * $mp, 52 * $mp, $armWidth * $mp, 12 * $mp);
            }
            if ($info['ratio'] == 2) {
                self::imageFlip($preview, $skin, $mp_x_h + 4 * $mp, 20 * $mp, 12 * $mp, 20 * $mp, 4 * $mp, 12 * $mp);
            } else {
                imagecopy($preview, $skin, $mp_x_h + 4 * $mp, 20 * $mp, 28 * $mp, 52 * $mp, 4 * $mp, 12 * $mp);
            }
            imagecopy($preview, $skin, $mp_x_h + 8 * $mp, 20 * $mp, 12 * $mp, 20 * $mp, 4 * $mp, 12 * $mp);
            if ($info['ratio'] == 1) {
                imagecopy($preview, $skin, $mp_x_h + 4 * $mp, 8 * $mp, 32 * $mp, 36 * $mp, 8 * $mp, 12 * $mp);
                imagecopy($preview, $skin, $mp_x_h + 12 * $mp, 8 * $mp, (44 + $backArmPos) * $mp, 36 * $mp, $armWidth * $mp, 12 * $mp);
                imagecopy($preview, $skin, $mp_x_h + (4 - $armWidth) * $mp, 8 * $mp, (52 + $backArmPos) * $mp, 52 * $mp, $armWidth * $mp, 12 * $mp);
                imagecopy($preview, $skin, $mp_x_h + 8 * $mp, 20 * $mp, 12 * $mp, 36 * $mp, 4 * $mp, 12 * $mp);
                imagecopy($preview, $skin, $mp_x_h + 4 * $mp, 20 * $mp, 12 * $mp, 52 * $mp, 4 * $mp, 12 * $mp);
            }
        }
        if ($way_cloak and !$info = self::isValidCloak($way_cloak)) {
            $way_cloak = null;
        } else {
            $mp_cloak = $info['scale'];
        }
        $cloak = @imagecreatefrompng($way_cloak);
        if (!$cloak) $way_cloak = null;
        if ($way_cloak) {
            if ($mp_cloak > $mp) {
                $mp_x_h = ($side) ? 0 : ($size_x * $mp_cloak) / 2;
                $mp_result = $mp_cloak;
            } else {
                $mp_x_h = ($side) ? 0 : ($size_x * $mp) / 2;
                $mp_result = $mp;
            }
            $preview_cloak = imagecreatetruecolor($size_x * $mp_result, 32 * $mp_result);
            $transparent = imagecolorallocatealpha($preview_cloak, 255, 255, 255, 127);
            imagefill($preview_cloak, 0, 0, $transparent);
            if (!$side or $side === 'front')
                imagecopyresized(
                    $preview_cloak,
                    $cloak,
                    round(3 * $mp_result),
                    round(8 * $mp_result),
                    round(12 * $mp_cloak),
                    round(1 * $mp_cloak),
                    round(10 * $mp_result),
                    round(16 * $mp_result),
                    round(10 * $mp_cloak),
                    round(16 * $mp_cloak)
                );
            imagecopyresized($preview_cloak, $preview, 0, 0, 0, 0, imagesx($preview_cloak), imagesy($preview_cloak), imagesx($preview), imagesy($preview));
            if (!$side or $side === 'back')
                imagecopyresized(
                    $preview_cloak,
                    $cloak,
                    $mp_x_h + 3 * $mp_result,
                    round(8 * $mp_result),
                    round(1 * $mp_cloak),
                    round(1 * $mp_cloak),
                    round(10 * $mp_result),
                    round(16 * $mp_result),
                    round(10 * $mp_cloak),
                    round(16 * $mp_cloak)
                );
            $preview = $preview_cloak;
        }
        $size_x = ($side) ? $size / 2 : $size;
        $fullsize = imagecreatetruecolor($size_x, $size);
        imagesavealpha($fullsize, true);
        $transparent = imagecolorallocatealpha($fullsize, 255, 255, 255, 127);
        imagefill($fullsize, 0, 0, $transparent);
        imagecopyresized($fullsize, $preview, 0, 0, 0, 0, imagesx($fullsize), imagesy($fullsize), imagesx($preview), imagesy($preview));
        imagedestroy($preview);
        imagedestroy($skin);
        if ($way_cloak) imagedestroy($cloak);
        return $fullsize;
    }

    public static function isValidSkin($way_skin): bool|array {
        if (!file_exists($way_skin)) return false;
        if (!$imageSize = self::getImageSize($way_skin)) return false;
        for ($i = 0; $i < sizeof(self::$skinProps); $i++) {
            if (round(self::$skinProps[$i]['ratio'], 2) != self::getRatio($imageSize)) continue;
            return array(
                'ratio' => self::getRatio($imageSize),
                'scale' => self::getScale($imageSize, self::$skinProps[$i]['base']),
            );
        }
        return false;
    }

    private static function getImageSize($file): bool|array {
        $imageSize = @getimagesize($file);
        if (empty($imageSize)) return false;
        return $imageSize;
    }

    private static function getRatio($inputImg): float|bool {
        if (!is_array($inputImg) and !$inputImg = self::getImageSize($inputImg)) return false;
        return round($inputImg[0] / $inputImg[1], 2);
    }

    private static function getScale($inputImg, $size): float|bool|int {
        if (!is_array($inputImg) and !$inputImg = self::getImageSize($inputImg)) return false;
        return $inputImg[0] / $size;
    }

    private static function imageFlip(&$result, &$img, $rx = 0, $ry = 0, $x = 0, $y = 0, $size_x = null, $size_y = null) {
        if ($size_x < 1) $size_x = imagesx($img);
        if ($size_y < 1) $size_y = imagesy($img);
        imagecopyresampled($result, $img, $rx, $ry, ($x + $size_x - 1), $y, $size_x, $size_y, 0 - $size_x, $size_y);
    }

    public static function isValidCloak($way_cloak): bool|array {
        if (!file_exists($way_cloak)) return false;
        if (!$imageSize = self::getImageSize($way_cloak)) return false;
        for ($i = 0; $i < sizeof(self::$cloakProps); $i++) {
            if (round(self::$cloakProps[$i]['ratio'], 2) != self::getRatio($imageSize)) continue;
            return array(
                'ratio' => self::$cloakProps[$i]['ratio'],
                'scale' => self::getScale($imageSize, self::$cloakProps[$i]['base']),
            );
        }
        return false;
    }

    public static function createHead($way_skin, $size = 151): \GdImage|bool {
        if (!$info = self::isValidSkin($way_skin)) return false;
        $img = @imagecreatefrompng($way_skin);
        if (!$img) return false;
        $p = array('face' => array(8, 8), 'hat' => array(40, 8));
        $av = imagecreatetruecolor($size, $size);
        $mp = $info['scale'];
        imagecopyresized($av, $img, 0, 0, $p['face'][0] * $mp, $p['face'][1] * $mp, $size, $size, 8 * $mp, 8 * $mp);
        imagecopyresized($av, $img, 0, 0, $p['hat'][0] * $mp, $p['hat'][1] * $mp, $size, $size, 8 * $mp, 8 * $mp);
        imagedestroy($img);
        return $av;
    }
}