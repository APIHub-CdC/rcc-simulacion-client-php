<?php

namespace RCC\Simulacion\MX\Client;

use \GuzzleHttp\Client;

use \RCC\Simulacion\MX\Client\Configuration;
use \RCC\Simulacion\MX\Client\ApiException;
use \RCC\Simulacion\MX\Client\ObjectSerializer;
use \RCC\Simulacion\MX\Client\Api\RCCApi as Instance;
use \RCC\Simulacion\MX\Client\Model\PersonaPeticion;
use \RCC\Simulacion\MX\Client\Model\DomicilioPeticion;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $config = new Configuration();
        $config->setHost('the_url');
        $this->x_api_key = "your_x_api_key";
        $client = new Client();
        $this->apiInstance = new Instance($client,$config);
    }    

    public function testGetFullReporte()
    {
        $request = new PersonaPeticion();
        
        $request->setPrimerNombre("JUAN");
        $request->setApellidoPaterno("SESENTAYDOS");
        $request->setApellidoMaterno("PRUEBA");
        $request->setRfc("SEPJ650809JG1");
        $request->setFechaNacimiento("1965-08-09");
        $request->setNacionalidad("MX");

        $domicilio = new DomicilioPeticion();
        $domicilio->setDireccion("PASADISO ENCONTRADO 58");
        $domicilio->setColoniaPoblacion("MONTEVIDEO");
        $domicilio->setCiudad("CIUDAD DE MÉXICO");
        $domicilio->setCp("07730");
        $domicilio->setDelegacionMunicipio("GUSTAVO A MADERO");
        $domicilio->setEstado("CDMX");
        $request->setDomicilio($domicilio);

        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $request);
            $this->assertNotNull($result);
            print_r($result);
            echo "testGetFullReporte finished\n";
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetFullReporte: ', $e->getMessage(), PHP_EOL;
        }
    }
}
