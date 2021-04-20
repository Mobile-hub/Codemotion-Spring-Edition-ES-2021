# JAM Stack | Creando sitios con Gatsby.js

## Capítulo 2: La iniciación
Todo héroe tienen un mentor que le guía, alguien que le dice lo que necesita oír para combatir el miedo.
Neo finalmente se encuentra con Morfeo. Es el momento de decidir, tomar la pastilla azul y seguir en su vida normal,
o pastilla roja y cruzar el umbral. Neo elige la pastilla roja. Entra en el mundo especial.

### Preparación

1) A partir del site funcionando en el paso anterior.
   
2) Descargamos el boilerplate skeleton

- http://getskeleton.com/
- https://github.com/dhg/Skeleton/releases/download/2.0.4/Skeleton-2.0.4.zip

### Objetivo

* Añadir estilos como estáticos en "formato sass"
* Añadir contenidos a partir de ficheros markdown que se renderizarán como páginas.

### Ejercicio

1) Vamos a añadir una hoja de estilos global

1.1 Creamos un directorio static en la raíz del proyecto
1.2 Descomprimimos el contenido del zip del Skeleton-2.0.4.zip en site/static debería quedar así:

├── css
│   ├── normalize.css
│   └── skeleton.css
├── images
│   └── favicon.png
└── styles.sass

1.3 Creamos un fichero en **static/styles.sass** con el siguiente contenido:

````scss
  @import "css/normalize.css"
  @import "css/skeleton.css"
````

1.4 Creamos un fichero: **gatsby-browser.js** en la raíz del proyecto con el siguiente contenido:

````javascript
    import "./static/styles.sass"
````

1.5 Añadimos 

2) Vamos a añadir un directorio estático con pdf que se renderizarán como webs

### Comprobación

