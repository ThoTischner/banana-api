<?php

namespace BananaService;

use BananaService\Model\Banana;

/**
 * Class BananaService
 * @package BananaService
 */
class BananaService {
    /**
     * @param float $min
     * @param float $max
     * @return Banana
     */
    function getBananaByLengthRange (float $min, float $max) : Banana {
        $range = range($min, $max);
        return new Banana($range[array_rand($range)]);
    }

    /**
     * @return Banana
     */
    function getExoticBanana() : Banana {
        $exoticColors = ['red', 'blue', 'violet'];
        return new Banana(13.37, $exoticColors[array_rand($exoticColors)]);
    }

    /**
     * @return array
     */
    function getRainbowBananaBunch() : array {
        $range = range(10, 15, 0.3);
        
        return [
            new Banana($range[array_rand($range)], 'red'),
            new Banana($range[array_rand($range)], 'orange'),
            new Banana($range[array_rand($range)], 'yellow'),
            new Banana($range[array_rand($range)], 'green'),
            new Banana($range[array_rand($range)], 'blue'),
            new Banana($range[array_rand($range)], 'violet'),
        ];
    }
}