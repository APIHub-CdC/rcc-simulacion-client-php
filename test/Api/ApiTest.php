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
        $x_full_report = true;
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
            $result = $this->apiInstance->getReporte($this->x_api_key, $request, $x_full_report);
            $this->assertNotNull($result);
            print_r($result);
            echo "testGetFullReporte finished\n";
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetFullReporte: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function testGetReporte()
    {
        $x_full_report = false;
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
            $result = $this->apiInstance->getReporte($this->x_api_key, $request, $x_full_report);
            $this->assertNotNull($result);
            print_r($result);
            echo "testGetReporte finished\n";
            return $result->getFolioConsulta();
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetReporte: ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * @depends testGetReporte
     */
    public function testGetConsultas($folioConsulta)
    {
        try {
            $result = $this->apiInstance->getConsultas($folioConsulta, $this->x_api_key);
            echo "testGetConsultas finished\n";
            $this->assertTrue($result->getConsultas()!==null);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetConsultas: ', $e->getMessage(), PHP_EOL;
        }
        
    }
    
    /**
     * @depends testGetReporte
     */
    public function testGetCreditos($folioConsulta)
    {
        try {
            $result = $this->apiInstance->getCreditos($folioConsulta, $this->x_api_key);
            echo "testGetCreditos finished\n";
            $this->assertTrue($result->getCreditos()!==null);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetCreditos: ', $e->getMessage(), PHP_EOL;
        }
    }
    
    /**
     * @depends testGetReporte
     */
    public function testGetDomicilios($folioConsulta)
    {
        try {
            $result = $this->apiInstance->getDomicilios($folioConsulta, $this->x_api_key);
            echo "testGetDomicilios finished\n";
            $this->assertTrue($result->getDomicilios()!==null);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetDomicilios: ', $e->getMessage(), PHP_EOL;
        }
    }
    
    /**
     * @depends testGetReporte
     */
    public function testGetEmpleos($folioConsulta)
    {
        try {
            $result = $this->apiInstance->getEmpleos($folioConsulta, $this->x_api_key);
            echo "testGetEmpleos finished\n";
            $this->assertTrue($result->getEmpleos()!==null);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetEmpleos: ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * @depends testGetReporte
     */
    public function testGetMensajes($folioConsulta)
    {
        try {
            $result = $this->apiInstance->getMensajes($folioConsulta, $this->x_api_key);
            echo "testGetMensajes finished\n";
            $this->assertTrue($result->getMensajes()!==null);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->testGetMensajes: ', $e->getMessage(), PHP_EOL;
        }
    }
}
