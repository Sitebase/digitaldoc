<?php

/**
 * Generate a file path
 */
function getFile($name, $extension) {
    // should we do any exta sanitization of the $name (.., /, ...)
    return realpath(STORAGE_PATH) . '/' . STORAGE_PREFIX . $name . '.' . $extension;
}

/**
 * Helper to ouput a JSON error
 * when something goes wrong
 */
function error($message) {
    return new JsonResponse([
        'status' => 'error',
        'error' => $message
    ]);
}
