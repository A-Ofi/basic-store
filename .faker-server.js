const http = require('http')
const faker = require('faker')

const SERVER = http.createServer((req, res) => {
    switch (req.url) {
        case '/item/name':
            res.end(
                faker.commerce.productName()
            )
            break;

        case '/item/description':
            res.end(
                faker.commerce.productDescription()
            )
            break;
        case '/test':
            res.end(
                'OK'
            )
            break;
    
        default:
            res.end('')
            break;
    }
})
let regex = new RegExp('https?://')
const HOST = process.env.FAKER_SERVER.replace(regex, '') || 'localhost'
const PORT = process.env.FAKER_SERVER_PORT || 7000

SERVER.listen(PORT, HOST)