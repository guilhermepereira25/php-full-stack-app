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

export const apiUrl = process.env.NODE_ENV === 'production' ? prod : development