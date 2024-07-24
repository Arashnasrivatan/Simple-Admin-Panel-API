<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed  $args
     * @return void
     */
    function dd(...$args)
    {
        echo '<pre style="background-color: #1a1a1a; color: #e5f2ff; padding: 15px; border-radius: 15px; font-family: Arial, sans-serif;">';
        foreach ($args as $arg) {
            echo '<code>';
            var_dump($arg);
            echo '</code>';
        }
        echo '</pre>';
        die(1);
    }
}

function getPostDataInput()
{
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
    $secretKey = $_ENV['SECRET_KEY'];

    $jsonData = file_get_contents('php://input');
    $postData = (object)json_decode($jsonData, true);

    $request_token = getTokenFromRequest();
    $token = $request_token->headers ?? $request_token->query ?? $request_token->body ?? null;

    if($token){
        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

            if($decoded){
                $postData->user_detail = $decoded;
            }
        } catch (\Exception $e) {
            // If token is invalid or expired, return false
            return false;
        }
    }

    return $postData;
}

function getPath($version = true)
{
    $requestUri = explode('?', str_replace('/restapi/crud/', '', strtolower($_SERVER["REQUEST_URI"])))[0];
    if(!$version) $requestUri = explode('?', str_replace(['v1/', 'v2/'], '', $requestUri))[0];

    return $requestUri;
}

function getApiVersion(){
    $requestUri = getPath();
    $uriParts = explode('/', $requestUri);
    $version = $uriParts[0];

    return $version;
}

function getTokenFromRequest(){
    $jsonData = file_get_contents('php://input');
    $postData = (object)json_decode($jsonData, true);

    return (object) [
        "headers" => $_SERVER['HTTP_TOKEN'] ?? null,
        "query"   => $_GET['token'] ?? null,
        "body"    => $postData->token ?? null
    ];
}

function uploadBase64($base64string, $folderPath = 'uploads'){
    $data = explode(',', $base64string);
    $base64 = $data[1];
    $format = explode(';', (explode('/', $data[0])[1]))[0];

    $fileName = RandomString(15) . '-' . time() . '.' . $format;
    $path = $folderPath . '/' . $fileName;

    // saving image
    $image = base64_to_jpeg($base64string, $path);

    return $fileName;
}

function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' );

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp );

    return $output_file;
}

function RandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
