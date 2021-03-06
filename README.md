# Digital Doc
Small web application to help convert paper documents into digital ones.
This project is created as final project for my CS50 course that I did via [edx](http://edx.org)

## Demo

[View demo](https://digital-doc.herokuapp.com/)

## Run
To run this on your computer execute following command:

```
cd src && php -S localhost:8000
```

If you now go to `http://localhost:8000/api/` your should see some `json` that indicates that your API is running.

## Requirements
* wkhtmltopdf: used to create PDF documents
* PHP

## Testing commands
Some commands to test the API without the need for a user interface:

```
curl --data '<html><body>Hello <strong>world</strong></body></html>' http://localhost:8000/api/generate/
```

## Deploy
I use Heroku to host this project and use [multi buildpack](https://github.com/heroku/heroku-buildpack-multi) to add support for `wkthmltopdf`.

The following button makes it possible to deploy this project on your own Heroku instance with a few easy clicks:

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

## Information
* [upload/take pictures](https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL)
