<?

class Anagram
{
    private $arFactors = [];
    private $curNumber = 1;
    private $maxFirstDigit = 1;

    /**
     * Anagram constructor.
     * @param array $arFactors Массив множетелей [1,2,3]
     */
    public function __construct($arFactors = [])
    {
        sort($arFactors);
        $this->arFactors = $arFactors;
        $this->_calculateMaxFirstDigit();
    }

    /**
     * Вычисляет максимальную первую цифру числа аннаграмы
     */
    private function _calculateMaxFirstDigit()
    {
        $maxFactor = end($this->arFactors);

        for ($i = 2; $i < 10; $i++) {
            if ($maxFactor * $i >= 10) {
                break;
            }
            $this->maxFirstDigit = $i;
        }
    }

    /**
     * @return string - Найденное число аннаграмма
     */
    public function search()
    {
        if (sizeof($this->arFactors) == 0) {
            return "";
        }

        $this->curNumber = 1;

        while (true) {
            $found = true;
            foreach ($this->arFactors as $factor) {
                $curNumberFactor = $this->curNumber * $factor;

                if (!$this->_check($this->curNumber, $curNumberFactor)) {
                    $found = false;
                    break;
                }
            }

            if ($found) {
                break;
            }

            $this->_increment();
        }

        return $this->curNumber;
    }

    private function _increment()
    {
        $arCurNumber = str_split($this->curNumber);
        $firstDigit = $arCurNumber[0];

        if ($firstDigit <= $this->maxFirstDigit) {
            $this->curNumber++;
        } else {
            $this->curNumber = pow(10, sizeof($arCurNumber));
        }
    }

    /**
     * @param int $a - Первое число
     * @param int $b - Второе число
     * @return bool - true если числа являются анаграмами по отношению друг к другу
     */
    private function _check($a, $b)
    {
        $arA = str_split($a);
        $arB = str_split($b);

        if (sizeof($arA) != sizeof($arB)) {
            return false;
        }

        if (sizeof($arA) != sizeof(array_unique($arA))) {
            return false;
        }

        if (sizeof($arB) != sizeof(array_unique($arB))) {
            return false;
        }

        return sizeof(array_diff($arA, $arB)) == 0;
    }

    /**
     * @return array - Массив представлений как выглядит число A умноженное на B
     */
    public function represent()
    {
        $arStrRepresents = [];

        foreach ($this->arFactors as $factor) {
            $arStrRepresents[] = sprintf(
                "%s умноженное на %s = %s",
                $this->curNumber,
                $factor,
                $this->curNumber * $factor
            );
        }

        return $arStrRepresents;
    }
}


?>