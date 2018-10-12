<?php

    namespace BananaService;

    interface BananaService {
    
        function getBananaByLengthRange (float $min, float $max) : \BananaService\Model\Banana;
    
        function getExoticBanana () : \BananaService\Model\Banana;
    
        function getRainbowBananaBunch () : array;
    
    }