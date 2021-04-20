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

1. Creamos un fichero **src/pages/blog.js** con el siguiente contenido:

Esta página nueva será visible desde /blog sólo por el mero hecho de existir en /src/pages, pero además le vamos
a asignar una query para que muestre los post del wordpress.

```javascript

import React from "react"
import { graphql } from "gatsby"

export default function Home({ data }) {
    //highlight-line
    return (
        <>
            {/* highlight-start */}
            <h1>My WordPress Blog</h1>
            <h4>Posts</h4>
            {data.allWpPost.nodes.map(node => (
                <div>
                    <p>{node.title}</p>
                    <div dangerouslySetInnerHTML={{ __html: node.excerpt }} />
                </div>
            ))}
            {/* highlight-end */}
        </>
    )
}

//highlight-start
export const pageQuery = graphql`
  query {
    allWpPost(sort: { fields: [date] }) {
      nodes {
        title
        excerpt
        slug
      }
    }
  }
`
//highlight-end

```

2. Ampliamos el fichero de configuración de Gatsby.js: **gatsby-config.js**

```javascript
module.exports = {
  siteMetadata: {
    title: "Site",
    siteUrl: "https://localhost:8000"
  },
  plugins: [
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        path: `${__dirname}/src/docs`,
        name: `markdown-pages`,
      },
    },
    `gatsby-transformer-remark`,
    "gatsby-plugin-sass",
    "gatsby-plugin-image",
    "gatsby-plugin-react-helmet",
    "gatsby-plugin-sharp",
    "gatsby-transformer-sharp",
    {
      resolve: "gatsby-source-filesystem",
      options: {
        name: "images",
        path: "./src/images/",
      },
      __key: "images",
    },
    {
      resolve: `gatsby-source-wordpress`,
      options: {
        url: "http://localhost:8888/index.php?graphql",
        verbose: true,
      },
    }
  ],
};

```

### Comprobación


````bash 
    $> gatsby develop
    
    # Accede a http://localhost:8080/blog para ver el listado de post resumidos en gatsby
    
````

Construye y prueba el artefacto final:
````bash 
    $> gatsby build
    $> cd public
    $> hs
    
    # Accede a http://localhost:8080/blog para verlo en el objeto final 
    
```` 


### Recursos adicionales

* https://graphql.org/
* https://github.com/gatsbyjs/gatsby/blob/master/packages/gatsby-source-wordpress/docs/tutorials/building-a-new-site-wordpress-and-gatsby.md
* https://www.wpgraphql.com/docs/posts-and-pages/
* https://www.gatsbyjs.com/docs/glossary/wpgraphql/
* https://www.youtube.com/watch?v=h2Qo3Pbf3Yg