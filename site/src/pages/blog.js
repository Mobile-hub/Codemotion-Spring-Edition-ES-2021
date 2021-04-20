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