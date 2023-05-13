const prod = {
    url: {
        API_URL: "https://product-test-jr.herokuapp.com"
    }
}

const development = {
    url: {
        API_URL: "http://localhost:80"
    }
}

export const apiUrl = process.env === 'production' ? prod : development