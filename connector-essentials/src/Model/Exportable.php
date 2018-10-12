<?php

namespace BananaService\Essentials\Model;

/**
 * Interface Exportable
 */
interface Exportable {
    /**
     * @return array
     */
    function export() : array;
}