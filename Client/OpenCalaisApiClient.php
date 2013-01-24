<?

namespace Jnonon\OpenCalaisBundle\Client;
use Guzzle\Http\Client;

class OpenCalaisApiClient
{
    /**
     *
     * @var string Api Key
     */
    private $apiKey;

    /**
     *
     * @var string Service Url
     */
    private $serviceUrl = 'http://api.opencalais.com/tag/rs/enrich';
    /**
     *
     * @var array
     */
    protected $defaultHeaders = array("x-calais-licenseID" => null,
            "Content-Type" => "text/xml; charset=UTF-8",
            "Accept" => "application/json",
            "enableMetadataType" => "SocialTags");

    protected $headers;

    private $outputFormat = 'json';

    private $inputFormat = 'text';

    /**
     * Constructor
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->headers = $this->defaultHeaders;

        $this->setHeader('x-calais-licenseID', $this->apiKey);
    }

    public function setOutputDataFormat($format)
    {
        $outputFormats = array('json' => 'application/json',
                'xml' => 'xml/rdf', 'text' => 'text/simple',
                'text-microformats' => 'text/microformats',
                'text-n3' => 'text/n3');

        if (!isset($outputFormats[$format])) {
            //TODO Add exeption
            throw new \Exception(
                    'Invalid output format. Valid values are '
                            . implode(', ', array_keys($outputFormats)));
        }

        $this->setHeader('Accept', $outputFormats[$format]);
        $this->outputFormat = $format;

    }

    public function getOutputDataFormat()
    {
        return $this->outputFormat;
    }

    public function setInputDataFormat($format)
    {
        $inputFormats = array('xml' => "text/xml; charset=UTF-8",
                'html' => "text/html; charset=UTF-8",
                'txt' => "text/raw; charset=UTF-8");

        if (!isset($inputFormats[$format])) {
            //TODO Add exeption
            throw new \Exception(
                    'Invalid input format. Valid values are '
                            . implode(', ', array_keys($inputFormats)));
        }

        $this->setHeader('Content-Type', $inputFormats[$format]);

    }

    private function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function categorize($data)
    {
        $client = new Client($this->serviceUrl);

        $response = $client->post($this->serviceUrl, $this->headers, $data)
                ->send();

        switch ($this->getOutputDataFormat()) {
            case 'xml':
                return $response->xml();
            case 'json':
                return $response->json();
            default:
                return $response->getBody(true);
        }

    }

}
