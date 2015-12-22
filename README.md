# Digital Doc
Small web application to help convert paper documents into digital ones.

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
curl --data '<html><body>Hello <strong>world</strong></body></html>' http://localhost:8000/api/test/
```

## Deploy
I use Heroku to host this project and use [multi buildpack](https://github.com/heroku/heroku-buildpack-multi) to add support for `wkthmltopdf`.

```
$ heroku buildpacks:set 'https://github.com/heroku/heroku-buildpack-multi.git'
$ echo 'https://github.com/heroku/heroku-buildpack-ruby.git' >> .buildpacks
$ echo 'https://github.com/dscout/wkhtmltopdf-buildpack.git' >> .buildpacks
$ git add .buildpacks
$ git commit -m 'Add multi-buildpack'
```

This makes it possible to deploy this project on your own Heroku instance with a few easy clicks:

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)
