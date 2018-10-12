<?php

namespace BananaService\Essentials\Model;

/** Decoupled imports inserted by prophet **/
    use BananaService\Essentials\Model\Exportable;
/** ---------------------------------- **/

class Banana implements Exportable {
    /**
     * @var $length float
     */
    private $length;
    /**
     * @var $color string
     */
    private $color;

    /**
     * Banana constructor.
     * @param float $length
     * @param string $color
     */
    public function __construct (float $length, string $color = 'yellow') {
        $this->length = $length;
        $this->color = $color;
    }

    /**
     * @return float
     */
    public function getLength (): float {
        return $this->length;
    }

    /**
     * @return string
     */
    public function getColor (): string {
        return $this->color;
    }

    function export (): array {
        return [
            'length' => $this->length,
            'color' => $this->color
        ];
    }
}