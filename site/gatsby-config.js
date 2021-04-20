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