<?php

namespace Jnonon\OpenCalaisBundle\Test\Client;
use Jnonon\OpenCalaisBundle\Client\OpenCalaisApiClient;

class OpenCalaisApiClientTest extends \PHPUnit_Framework_TestCase
{

    //TODO: Put this into a fixture file
    private $textFixture = 'Increase RAM memory usage
      By default Eclipse got some configuration to limit the amount of RAM memory, this configurations works fine for most users but if you 2GB of ram or more you should consider set this values to improve Eclipse IDE performance.
      First you got to locate the "eclipse.ini" file that contains some few Eclipse IDE configurations.
      If you downloaded Eclipse IDE manually from internet the "eclipse.ini" file is just inside the unpacked folder
      If you installed Eclipse via terminal or software center the location of the file is "/etc/eclipse.ini"
      In some Linux versions the file can be found at "/usr/share/eclipse/eclipse.ini"
      NOTE: If you found a config file at "/etc/eclipse.ini" then don\'t edit the file at "/usr/share/eclipse/eclipse.ini"
      This is the content of the original "eclipse.ini" file';

    public function testXmlOutput()
    {
        $client = new OpenCalaisApiClient('xxxxxxxxxxxxxxx');

        $client->setOutputDataFormat('xml');

        $response = $client->categorize($this->textFixture);

        $this->assertTrue($response instanceof \SimpleXMLElement);
    }

    /**
     * @expectedException        Exception
     */
    public function testInvalidOuputFormat()
    {
        $client = new OpenCalaisApiClient('234');

        $client->setOutputDataFormat('noformat');

    }

    /**
     * @expectedException        Exception
     */
    public function testInvalidInputFormat()
    {
        $client = new OpenCalaisApiClient('234');

        $client->setInputDataFormat('noformat');

    }

}
