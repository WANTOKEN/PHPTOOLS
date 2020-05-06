<?php
interface RateConverter
{
    /**
     * 输入由币种价格组成的字符串，输出人民币的实时价格
     * @param string $price
     * @return float
     */
    public function convertToCNY(string $price): float;
}
class Rates implements RateConverter{
    private $jsonStr = '{"rates":{"AED":3.672995,"AFN":75.97197,"ALL":117.51162,"AMD":498.51118,"ANG":1.776519,"AOA":536.679848,"ARS":64.310102,"AUD":1.6418,"AWG":1.8,"AZN":1.699831,"BAM":1.772846,"BBD":2.00388,"BDT":84.30478,"BGN":1.77437,"BHD":0.376993,"BIF":1875.3042,"BMD":1,"BND":1.414929,"BOB":6.842999,"BRL":5.205401,"BSD":0.992467,"BTN":74.82607,"BWP":11.836368,"BYR":19600,"BZD":2.000526,"CAD":1.4175,"CDF":1710.999748,"CHF":0.961675,"CLF":0.031102,"CLP":858.206681,"CNY":7.0958,"COP":4059,"CRC":577.12372,"CUP":26.5,"CVE":99.94788,"CZK":24.916801,"DJF":177.720459,"DKK":6.781165,"DOP":53.46374,"DZD":124.70871,"EGP":15.744863,"ERN":15.000089,"ETB":32.874507,"EUR":0.9084,"FJD":2.28735,"FKP":0.808641,"GAG":2.2231034804516,"GAU":0.019563932692607,"GBP":0.8086,"GEL":3.30982,"GHS":5.726536,"GIP":0.808641,"GMD":50.950215,"GNF":9469.480964,"GTQ":7.644406,"GYD":207.34852,"HKD":7.7522,"HNL":24.557443,"HRK":6.92678,"HTG":94.358495,"HUF":328.528005,"IDR":16661.5,"ILS":3.559599,"INR":75.832501,"IQD":1184.7991,"IRR":42104.999989,"ISK":142.000364,"JMD":134.30896,"JOD":0.709002,"JPY":107.32,"KES":104.909561,"KGS":82.199242,"KHR":4031.581805,"KMF":447.650384,"KPW":900.087884,"KRW":1231.63,"KWD":0.313037,"KYD":0.82703,"KZT":445.24009,"LAK":8940.000026,"LBP":1500.600497,"LKR":187.82188,"LRD":198.050408,"LSL":17.80229,"LTL":2.95274,"LVL":0.60489,"LYD":1.397921,"MAD":10.066306,"MDL":18.161934,"MGA":3746.068301,"MKD":55.922409,"MMK":1382.011198,"MNT":2774.841061,"MOP":7.9963943,"MRO":357.000307,"MUR":39.196445,"MVR":15.403383,"MWK":731.032201,"MXN":23.98617,"MYR":4.344993,"MZN":66.719875,"NAD":17.818268,"NGN":366.999803,"NIO":33.481845,"NOK":10.459395,"NPR":119.72281,"NZD":1.688495,"OMR":0.384459,"PAB":0.992463,"PEN":3.410124,"PGK":3.443803,"PHP":50.9055,"PKR":164.79926,"PLN":4.15326,"PYG":6530.941497,"QAR":3.640503,"RON":4.389101,"RSD":106.745011,"RUB":78.79594,"RWF":945.1109,"SAR":3.764735,"SBD":8.261159,"SCR":13.762943,"SDG":55.291712,"SEK":9.97139,"SGD":1.430895,"SHP":0.808641,"SLL":9724.999919,"SOS":583.000122,"SRD":7.457985,"STD":22052.77227,"SVC":8.683632,"SYP":514.451454,"SZL":17.688291,"THB":33.003501,"TJS":10.118063,"TMT":3.5,"TND":2.86299,"TOP":2.348604,"TRY":6.627302,"TTD":6.705704,"TWD":30.316,"TZS":2310.704494,"UAH":27.536008,"UGX":3761.460797,"USD":1,"UYU":43.538716,"UZS":9482.102706,"VEF":9.987496,"VND":23439.83,"VUV":123.264162,"WST":2.788517,"XAF":594.581339,"XAG":0.071475,"XAU":0.000629,"XCD":2.70255,"XDR":0.724069,"XOF":594.58943,"XPF":108.10125,"YER":250.349912,"ZAR":17.986703,"ZMK":9001.202826,"ZMW":17.938833,"ZWL":322.000001,"XPT":0.00137648,"MXV":3.079749,"IEP":0.699154,"ITL":1700.272217,"FRF":1700.272217,"SIT":216.486755,"DEM":1.71745,"ECS":25000,"CYP":0.51955,"CNH":6.9777,"NIS":3.559599},"base":"USD","last_data_at":1585722122}';
    private $rateData = null;
    private $conf = [
        '$'=>'USD',
        '£'=>'GBP',
        '€'=>'EUR',
        'HK$'=>'HKD',
        'JPY'=>'¥',
    ];
    public function __construct()
    {
        $this->rateData = json_decode($this->jsonStr,true);
    }

    public function convertToCNY(string $price): float
    {
        $rateData = $this->rateData['rates'];
        $confRate =  $this->conf;
        $res = preg_split("/([0-9,.]+)/",$price);
        $prfix =  $res[0];
        $prfixIndex = strpos($price,$prfix);
        $prfixIndex+=strlen($prfix);
        $num = substr($price,$prfixIndex);//string 1,999,00
        $floatPrice =  floatval(str_replace(',','',$num));
        $char = isset($confRate[$prfix])? $confRate[$prfix]:'';
        if(isset($rateData[$char])){
            $rateChange = floatval($rateData[$char]);
            echo "{$char}汇率:".$rateChange.PHP_EOL;
            echo "输入金额:".$floatPrice.PHP_EOL;
            $resPrice = $rateChange * $floatPrice;
        } else{
            $resPrice = $floatPrice;
        }
        echo "运算结果：".$resPrice.PHP_EOL;
        $res = number_format($resPrice,2);
        echo "最终返回：".$res.PHP_EOL;
        return $res;
    }
}

$retes = new Rates();
$res = $retes->convertToCNY('€499.99');
echo $res;
