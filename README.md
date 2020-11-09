<p align="center">UNIVERSIDAD MARIANO GÁLVEZ DE GUATEMALA</p>
<p align="center">CENTRO UNIVERSITARIO DE RETALHULEU</p>
<p align="center">INGENIERÍA EN SISTEMAS DE INFORMACIÓN Y CIENCIAS DE LA COMPUTACIÓN</p>

<p align="center"><img src="https://i.pinimg.com/originals/34/22/90/3422900cb9e9bd4ce803847129eb6c9f.jpg" width="200"></p>

## ASILO "SHADDAI NUEVA FAMILIA"
<p align="center"><img src="https://ministerioshadainf.org/wp-content/uploads/2019/06/cropped-Logo_Fix.jpg" width="200"></p>

### Misión
    Gestionar mediante programas de alimentación, albergue y salud para que les permita a las personas del Adulto Mayor especialmente a las personas de escaso recurso económico gozar de una mejor calidad de vida. 

#### Visión
    Como institución privada dar un beneficio social sin interés de lucrar, sin distinción de origen, sexo o creo y erradicar el maltrato físico y psicológico en todas las personas de la Tercera Edad de nuestra querida Patria.

#### Valores
    Sevicio
    Lealtad
    Responsabilidad
    Solidaridad

#### Metas
    Poder crear un hospital con atención médica geriátrica y gerontológica.
    
    Dar un servicio de guardería a los ancianos   cuyas familias tengar que trabajar, trayéndolos por la mañana y devolviendolos por la tarde, en un vehiculo exclusivo. 

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
Crear la base de datos en MySQL.
```
create database nombre_base_de_datos; 
```
Se modifica el archivo .env. 
```
DB_DATABASE=nombre_base_de_datos
DB_USERNAME=usuario (por defecto = root)
DB_PASSWORD=contraseña de usuario (por defecto = vacía)  
```
Genera la clave en el archivo de entorno de la aplicación.
```
php artisan key:generate
```
Generar las migraciones.
```
php artisan migrate:fresh --seed
```
Se ejecuta el manejador de paquetes de node en entorno de desarrollo.
```
npm run dev o npm run watch
```
Se inicia el servidor de desarrollo.
```
php artisan serve
```
Ejecutar el proyecto en el navegador.
```
localhost:8000
```
Autenticación.
```
usuario: administrador-0001 y contraseña: asilo
```

## Construido con 🛠️

* [Laravel](https://laravel.com/) - Framework PHP.
* [VueJS](https://vuejs.org/) - Framework progresivo de JavaScript para construir interfaces de usuario. 

## Mini-Wiki 📖
 
* **Infraestructura:** Conjunto de hardware, software, redes, instalaciones, etc. Usado para desarrollar, probar, entregar, monitorear, controlar y dar soporte a los servicios de las tecnologías de información.
* **Modelo:** contiene una representación de los datos que maneja el sistema, su lógica de negocio, y sus mecanismos de persistencia.
* **Vista:** nterfaz de usuario, que compone la información que se envía al cliente y los mecanismos interacción con éste.
* **Controlador:** actúa como intermediario entre el Modelo y la Vista, gestionando el flujo de información entre ellos y las transformaciones para adaptar los datos a las necesidades de cada uno.
* **Patrón repositorio:** consiste en separar la lógica que recupera los datos y los asigna a un modelo de entidad de la lógica de negocios que actúa sobre el modelo, esto permite que la lógica de negocios sea independiente del tipo de dato que comprende la capa de origen de datos.
* **Plugin:** Es un software que se relaciona con otra para agregarle una función nueva o específica.
* **Vue-Router:** Paquete oficial de vuejs, que extiende el alacance de un sistema con la creación de rutas. 
* **Props:** Sirven para pasar parámetros o información al propio web component para poder personalizarlo y ajustarlo dependiendo de las necesidades.

## Versionado 📌

V 1.0

## Autores ✒️

_A continuación, se presentan los responsables de llevar a cabo el desarrollo y la documentación del proyecto._

* **Milton Girón** - *Desarrollador backend e infraestructura* - [miltong261](https://github.com/miltong261)
* **María José Werner** - *Desarrolladora frontend* - [mariajo1011](https://github.com/mariajo1011)
* **Angel Ajanel** - *Desarrollador frontend* - [angel2304](https://github.com/angel2304)
* **Jorge Espada** - *Diseñador y maquetador* - [Joryus](https://github.com/Joryus)
* **Selvin Zuñiga** - *Base de datos e infraestructura* - [Szunigau](https://github.com/Szunigau)
* **Juan Alvarado** - *Documentación y análisis* - [JuanGuillermoAM](https://github.com/JuanGuillermoAM)
* **Jorge Calderon** - *Documentación y análisis* - [jrgcalderon](https://github.com/Jrgcalderon)
* **Yonathan Calderón** - *Documentación y cableado estructurado* - [yonathan10](https://github.com/yonathan10)


## Licencia 📄

El código fuente de este proyecto es *OpenSource*, disponible para que pueda ser utilizado, copiado y distribuido. También está abierto al público para que puedan enviar sus *Pull Requests*, con el objetivo de contribuir y mejorar el software en sus próximas versiones.

## Expresiones de Gratitud 🎁

Durante los últimos cinco meses, nos hemos dado la tarea en aportar un granito de arena al Asilo de Ancianos "SHADAI NUEVA FAMILIA". Nuestro objetivo ha sido de mejorar y digitalizar algunos de los procesos administrativos para la optimización en la atención del adulto mayor. Creemos en la importancia de brindar un buen servicio a las personas que  necesitan del apoyo de nuestros conocimientos.

Agradecemos a Dios Todopoderoso por la bendición de poder ayudar a nuestra comunidad, que sin Él esto no hubiera sido posible. A la Universidad Mariano Gálvez de Retalhuleu por estos cinco años de educación superior, especialmente al catedrático José Eduardo Echeverría Ruíz que nos brindó las herramientas para llevar a cabo este proyecto. Al Asilo de Ancianos por abrirnos sus puertas y brindarnos su confianza y permitirnos trabajar con la información de la organización.

---
Desarrollado y donado con ❤️ por estudiantes del décimo semestre de la carrera de Ingeniería en Sistemas de Información y Ciencias de la Computación de la Universidad Mariano Gálvez de Retalhuleu. 
