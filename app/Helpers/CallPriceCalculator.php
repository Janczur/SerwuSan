<?php


namespace App\Helpers;


class CallPriceCalculator
{
    /** @var string */
    public const NO_MARGIN_DISPLAY = '(Uzupełnij marżę)';

    /** @var array */
    private $providersMargins;

    /** @var array */
    private $countryCallPrices;

    /** @var array */
    private $calculatedCallPrices;

    /**
     * CallPriceCalculator constructor.
     * @param array $providersMargins
     */
    public function __construct(array $providersMargins)
    {
        $this->providersMargins = $providersMargins;
    }

    public function calculateCallPrices(): void
    {
        $calculatedCallPrice = [];
        foreach ($this->getCountryCallPrices() as $country => $callPrices){
            foreach($callPrices as $callPrice){
                if(array_key_exists($country, $this->providersMargins)){
                    $calculatedCallPrice[$country][] = $this->calculateCallPriceFor($callPrice, $country);
                }else{
                    $calculatedCallPrice[$country][] = self::NO_MARGIN_DISPLAY;
                }
            }
        }
        $this->setCalculatedCallPrices($calculatedCallPrice);
    }

    /**
     * @param float $callPrice
     * @param string $country
     * @return float|int
     */
    private function calculateCallPriceFor(float $callPrice, string $country)
    {
        $calculated = $callPrice * $this->providersMargins[$country] + $callPrice;
        return number_format(round($calculated, 5), 5);
    }

    /**
     * @return array
     */
    public function getCountryCallPrices(): array
    {
        return $this->countryCallPrices;
    }

    /**
     * @param array $countryCallPrices
     */
    public function setCountryCallPrices(array $countryCallPrices): void
    {
        $this->countryCallPrices = $countryCallPrices;
    }

    /**
     * @return array
     */
    public function getCalculatedCallPrices(): array
    {
        return $this->calculatedCallPrices;
    }

    /**
     * @param array $calculatedCallPrices
     */
    public function setCalculatedCallPrices(array $calculatedCallPrices): void
    {
        $this->calculatedCallPrices = $calculatedCallPrices;
    }


}
