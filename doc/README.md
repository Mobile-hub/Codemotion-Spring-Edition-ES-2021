# JAM Stack | Creando sitios con Gatsby.js

## Capítulo 3: La guía interior
El mundo especial te obliga a aprender rápido si quieres sobrevivir. Los desafíos y los enemigos son parte del camino,
pero solo podrás superarlos con la ayuda de tus aliados. Neo empieza su preparación con duros entrenamientos.
Después se embarca con compañeros a bordo de una nave, donde son perseguidos y atacados constantemente.
Su principal aliada es Trinity, y en Matrix su enemigo final, es el malvado Agente Wordpress y las bases de datos.

### Preparación

A partir del resultado del proyecto en la fase anterior.

Arrancar en otra consola el wordpress con el siguiente comando:

````bash
    
    $> cd wordpress
    $> docker-compose up -d
    
    # Cuando ya no se necesite, en ese mismo directorio lanzar
    $> docker-compose down

````

### Objetivo

Conectar con el WP y descargar su contenido y renderizarlo como hicimos con los markdown.

### Ejercicio

1. Activar el docker-compose y probarlo:

```bash
    $> docker-compose up -d
     
    # Los detalles de accceso están en la imagen: doc/installation_data.png 
    # site  http://localhost:8888/wp-login.php
    # user admin
    # pass admin
    
```

1. Creamos un fichero:


Connect to WP
http://localhost:8888/index.php?graphql

````graphql
    query MyQuery {
        posts {
            nodes {
                id
                date
                content(format: RAW)
            }
        }
    }
````



### Comprobación

### Recursos adicionales

* https://graphql.org/
* https://www.wpgraphql.com/docs/posts-and-pages/
* https://www.gatsbyjs.com/docs/glossary/wpgraphql/
* https://www.youtube.com/watch?v=h2Qo3Pbf3Yg