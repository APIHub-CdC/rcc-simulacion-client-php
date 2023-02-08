# rcc-simulacion-client-php

Esta API simula el reporte del historial crediticio, el cumplimiento de pago de los compromisos que la persona ha adquirido con entidades financieras, no financieras e instituciones comerciales que dan crédito o participan en actividades afines al crédito. En esta versión se retornan los campos del Crédito Asociado a Nomina (CAN) en el nodo de créditos. <br/><img src='https://github.com/APIHub-CdC/imagenes-cdc/blob/master/circulo_de_credito-apihub.png' height='37' width='160'/></p><br/>

## Requisitos

PHP 7.1 ó superior

### Dependencias adicionales
- Se debe contar con las siguientes dependencias de PHP:
    - ext-curl
    - ext-mbstring
- En caso de no ser así, para linux use los siguientes comandos

```sh
#ejemplo con php en versión 7.3 para otra versión colocar php{version}-curl
apt-get install php7.3-curl
apt-get install php7.3-mbstring
```
- Composer [vea como instalar][1]

## Instalación

Ejecutar: `composer install`

## Guía de inicio

### Paso 1. Agregar el producto a la aplicación

Al iniciar sesión seguir os siguientes pasos:

 1. Dar clic en la sección "**Mis aplicaciones**".
 2. Seleccionar la aplicación.
 3. Ir a la pestaña de "**Editar '@tuApp**' ".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/edit_applications.jpg" width="900">
    </p>
 4. Al abrirse la ventana emergente, seleccionar el producto.
 5. Dar clic en el botón "**Guardar App**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/selected_product.jpg" width="400">
    </p>

### Paso 2. Capturar los datos de la petición

Los siguientes datos a modificar se encuentran en ***test/Api/ApiTest.php***

Es importante contar con el setUp() que se encargará de inicializar la url. Modificar la URL ***('the_url')*** de la petición del objeto ***$config***, como se muestra en el siguiente fragmento de código:

```php
<?php
public function setUp()
{
    $config = new Configuration();
    $config->setHost('the_url');
    $this->x_api_key = "your_x_api_key";
    $client = new Client();
    $this->apiInstance = new Instance($client,$config);
}   
```
```php

<?php
/**
* Este es el método que se será ejecutado en la prueba ubicado en path/to/repository/test/Api/ApiTest.php
*/
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
?>
```
## Pruebas unitarias

Para ejecutar las pruebas unitarias:

```sh
./vendor/bin/phpunit
```

---
[CONDICIONES DE USO, REPRODUCCIÓN Y DISTRIBUCIÓN](https://github.com/APIHub-CdC/licencias-cdc)

[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
