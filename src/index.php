<?php

// load dependencies
require_once __DIR__.'/../vendor/autoload.php';
require_once 'config.php';
require_once 'functions.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;
use mikehaertl\wkhtmlto\Pdf;
use Ramsey\Uuid\Uuid;

// create silex application
$app = new Silex\Application();

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Register Twig provider and define a path for twig templates
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// load composer file so I can use it to extract information
$project = json_decode(file_get_contents(__DIR__.'/../composer.json'));

$app->get('/', function() use($app) {
    return $app['twig']->render('index.html');
})->bind('index');

/**
 * Information endpoint
 * This endpoint just returns some general information about the API
 */
$app->get('/api/', function() use ($project) {
    return new JsonResponse([
        'name' => $project->name,
        'version' => $project->version
    ]);
});

/**
 * Generate PDF
 * Send some HTML source to this endpoint and it will convert it to
 * a PDF file
 * It returns a unique ID as result
 */
$app->post('/api/generate/', function(Request $request) {

    // save html source to local document
    $source = $request->getContent();
    $sourceFile = getFile(Uuid::uuid4()->toString(), 'html');
    file_put_contents($sourceFile, $source);

    // generate destination PDF file
    $id = Uuid::uuid4()->toString();
    $destination = getFile($id, 'pdf');

    // create PDF file
    $pdf = new Pdf($sourceFile);
    if(!$pdf->saveAs($destination)) {
        return error($pdf->getError());
    } else {
        return new JsonResponse([
            'id' => $id
        ]);
    }
});

/**
 * Download PDF
 * Use the ID that was returned in the `generate` endpoint to download the file
 * using this endpoint
 */
$app->get('/api/download/{id}', function($id) {
    $file = getFile($id, 'pdf');

    // make sure the file exists
    if(!file_exists($file))
        return error("file with is '$id' is not found");

    // download the file
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
});

$app->run();

