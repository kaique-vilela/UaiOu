<?php

use App\Models\UsuarioModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getUserRequest($request){
    
    $authenticationHeader = $request->getServer('HTTP_AUTHORIZATION');
    $encodedToken = getJWTFromRequest($authenticationHeader);
    $key = Services::getSecretKey();
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
    $userModel = new UsuarioModel();
    return $userModel->where('email', $decodedToken->email)->first();
}

function getJWTFromRequest($authenticationHeader): string
{
    if (is_null($authenticationHeader)) { //JWT está ausente
        throw new Exception('O token JWT é inválido ou está ausente nessa requisição');
    }
    //JWT é enviado do cliente no formato Bearer XXXXXXXXX
    return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
    $key = Services::getSecretKey();
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
    $userModel = new UsuarioModel();
    $userModel->findUserByEmailAddress($decodedToken->email);
}

function getSignedJWTForUser(string $email)
{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
    $payload = [
        'email' => $email,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration,
    ];
    
    $jwt = JWT::encode($payload, Services::getSecretKey(), 'HS256');
    return $jwt;
}