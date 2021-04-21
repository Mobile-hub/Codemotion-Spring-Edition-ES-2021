# JAM Stack | Creando sitios con Gatsby.js

## Capítulo 2: La iniciación
Todo héroe tienen un mentor que le guía, alguien que le dice lo que necesita oír para combatir el miedo.
Neo finalmente se encuentra con Morfeo. Es el momento de decidir, tomar la pastilla azul y seguir en su vida normal,
o pastilla roja y cruzar el umbral. Neo elige la pastilla roja. Entra en el mundo especial.

### Preparación

1) A partir del site funcionando en el paso anterior.

2) Instalamos gatsby-transformer-remark con ``` npm i --save gatsby-transformer-remark ```

3) Descargamos el boilerplate skeleton:

- http://getskeleton.com/
- https://github.com/dhg/Skeleton/releases/download/2.0.4/Skeleton-2.0.4.zip

### Objetivo

* Añadir estilos como estáticos en "formato sass"
* Añadir contenidos a partir de ficheros markdown que se renderizarán como páginas.

### Ejercicio

1) Vamos a añadir una hoja de estilos global

1.1 Creamos un directorio static en la raíz del proyecto
1.2 Descomprimimos el contenido del zip del Skeleton-2.0.4.zip en site/static debería quedar así:

````bash
├── css
│   ├── normalize.css
│   └── skeleton.css
├── images
│   └── favicon.png
└── styles.sass
````

1.3 Creamos un fichero en **static/styles.sass** con el siguiente contenido:

````scss
  @import "css/normalize.css"
  @import "css/skeleton.css"
````

1.4 Creamos un fichero: **gatsby-browser.js** en la raíz del proyecto con el siguiente contenido:

````javascript
    import "./static/styles.sass"
````
Más info: https://www.gatsbyjs.com/docs/how-to/styling/global-css/

2) Vamos a añadir un directorio estático con pdf que se renderizarán como webs

2.1 Creamos una carpeta **docs** en el raiz del proyecto.

2.2 Creamos un fichero llamado **matrix.md** con el siguiente contenido:

````markdown
---
slug: "/quotes/matrix"
date: "1999-03-31"
title: "The Matrix Quotes"
---

# THE MATRIX QUOTES:

**Morpheus:** If real is what you can feel, smell, taste and see, then 'real' is simply electrical signals interpreted by your brain.

**Switch:** Listen to me, Coppertop. We don't have time for 20 Questions.

````

2.3 Actualizamos el fichero de configuración: **gatsby-config.js** con el siguiente contenido:

(recuerda instalar y salvar el paquete adicinal gatsby-transformer-remark)

````javascript

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
  ],
};

````

2.4 Crea el fichero **src/templates/docTemplate.js** con el siguiente contenido:

````javascript
import React from "react"
import { graphql } from "gatsby"

export default function Template({
                                     data, // this prop will be injected by the GraphQL query below.
                                 }) {
    const { markdownRemark } = data // data.markdownRemark holds your post data
    const { frontmatter, html } = markdownRemark
    return (
        <div className="blog-post-container">
            <div className="blog-post">
                <h1>{frontmatter.title}</h1>
                <h2>{frontmatter.date}</h2>
                <div
                    className="blog-post-content"
                    dangerouslySetInnerHTML={{ __html: html }}
                />
            </div>
        </div>
    )
}

export const pageQuery = graphql`
  query($slug: String!) {
    markdownRemark(frontmatter: { slug: { eq: $slug } }) {
      html
      frontmatter {
        date(formatString: "MMMM DD, YYYY")
        slug
        title
      }
    }
  }
`
````

2.5 Crea el fichero **gatsby-node.js** en el raíz del proyecto, con el siguiente contenido:

````javascript
exports.createPages = async ({ actions, graphql, reporter }) => {
    const { createPage } = actions

    const blogPostTemplate = require.resolve(`./src/templates/docTemplate.js`)

    const result = await graphql(`
    {
      allMarkdownRemark(
        sort: { order: DESC, fields: [frontmatter___date] }
        limit: 1000
      ) {
        edges {
          node {
            frontmatter {
              slug
            }
          }
        }
      }
    }
  `)

    // Handle errors
    if (result.errors) {
        reporter.panicOnBuild(`Error while running GraphQL query.`)
        return
    }

    result.data.allMarkdownRemark.edges.forEach(({ node }) => {
        createPage({
            path: node.frontmatter.slug,
            component: blogPostTemplate,
            context: {
                // additional data can be passed via context
                slug: node.frontmatter.slug,
            },
        })
    })
}
````

Más info: https://www.gatsbyjs.com/docs/how-to/routing/adding-markdown-pages/

### Comprobación

````bash 
    $> gatsby develop
    
    # Accede a http://localhost:8000/quotes/matrix para ver el fichero markdown convertido a html
    
````

Construye y prueba el artefacto final:
````bash 
    $> gatsby build
    $> cd public
    $> hs
    
    # Accede a http://localhost:8080/quotes/matrix para comprobarlo en objeto final 
    
```` 
