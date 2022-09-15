<?
$input = "Hakim";

$encrypted = encryptIt( $input );
$decrypted = decryptIt( $encrypted );

echo $encrypted . '<br />' . $decrypted;

function encryptIt( $q ) {
    $cryptKey  = '0k8gwV8RBljhx2cxYMWVnhsUig+S9/p6JA1g';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = '0k8gwV8RBljhx2cxYMWVnhsUig+S9/p6JA1g';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}
?>