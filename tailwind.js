module.exports = {
    mode: "jit",
    purge: {
        enabled: true,
        content: [
            './**/*.php',
            './dist/**/*.js'
        ]
    },
    theme: {
        extend : {
        }
    },
    variants: {},
    plugins: [],
}