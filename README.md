<p align="center">UNIVERSIDAD MARIANO GÁLVEZ DE GUATEMALA</p>
<p align="center">CENTRO UNIVERSITARIO DE RETALHULEU</p>
<p align="center">INGENIERÍA EN SISTEMAS DE INFORMACIÓN Y CIENCIAS DE LA COMPUTACIÓN</p>

<p align="center"><img src="https://ministerioshadainf.org/wp-content/uploads/2019/06/cropped-Logo_Fix.jpg" width="200"></p>

## ASILO "SHADDAI NUEVA FAMILIA"

_..._  

### Pre-requisitos 📋

_A continuación, se presentan las herramientas de software necesarias para poder clonar el proyecto y ponerlo en funcionamiento._

* [xampp](https://www.apachefriends.org/es/index.html) - es un paquete de software libre, que consiste principalmente en el sistema de gestión de bases de datos MySQL, el servidor web Apache y los intérpretes para lenguajes de script PHP y Perl.
* [composer](https://getcomposer.org/) - manejador de paquetes de PHP.
* [nodejs](https://nodejs.org/es/) - es un entorno JavaScript de lado de servidor que utiliza un modelo asíncrono y dirigido por eventos.
* [npm](https://www.npmjs.com/get-npm) - es el sistema de gestión de paquetes por defecto para Node.js, un entorno de ejecución para JavaScript, bajo Artistic License 2.0.

### Instalación 🚀

_A continuación, se presenta paso a paso los comandos que se deben de ejecutar para clonar el proyecto y ponerlo en marcha._

Clonar el proyecto.
```
git clone https://github.com/miltong261/asilo.git
```
Resuelve las dependencias e instala los paquetes (PHP).
```
composer install 
```
Resuelve las dependencias e instala los paquetes (JavaScript).
```
npm install 
```
Se crea el archivo para el almacenamiento de variables de entorno. 
```
cp .env.example .env 
```
Genera la clave en el archivo de entorno de la aplicación.
```
php artisan key:generate
```
Generar las migraciones.
```
php artisan migrate:refresh --seed
```
Se ejecuta el manejador de paquetes de node en entorno de desarrollo.
```
npm run dev o npm run watch
```
Se inicia el servidor de desarrollo.
```
php artisan serve
```


## Despliegue 📦
...

## Construido con 🛠️

* [Laravel](https://laravel.com/) - Framework PHP.
* [VueJS](https://vuejs.org/) - Framework progresivo de JavaScript para construir interfaces de usuario. 

## Contribuyendo 🖇️

...

## Wiki 📖

...

## Versionado 📌

...

## Autores ✒️

_A continuación, se presentan los responsables de llevar a cabo el desarrollo y la documentación del proyecto._

* **Milton Girón** - *Desarrollador backend* - [miltong261](https://github.com/miltong261)
* **María José Werner** - *Desarrolladora frontend* - [mariajo1011](https://github.com/mariajo1011)
* **Angel Ajanel** - *Desarrollador frontend* - [angel2304](https://github.com/angel2304)
* **Jorge Espada** - *Diseñador y maquetador* - [Joryus](https://github.com/Joryus)
* **Selvin Zuñiga** - *Base de datos e infraestructura* - [Szunigau](https://github.com/Szunigau)
* **Juan Alvarado** - *Documentación y análisis* - [JuanGuillermoAM](https://github.com/JuanGuillermoAM)
* **Jorge Calderon** - *Documentación y análisis* - [jrgcalderon](https://github.com/Jrgcalderon)
* **Yonathan Calderón** - *Documentación y cableado estructurado* - [yonathan10](https://github.com/yonathan10)


## Licencia 📄

...

## Expresiones de Gratitud 🎁

...

---
Desarrollado y donado con ❤️ por estudiantes del décimo semestre de la carrera de Ingeniería en Sistemas de Información y Ciencias de la Computación de la Universidad Mariano Gálvez de Retalhuleu. 
