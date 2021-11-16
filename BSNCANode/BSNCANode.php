<?php

class BSNCANode
{
  private $host = 'http://195.210.47.13:14579';
  private $certBase64 = '';
  private $certPassword = '';

  function __construct($certBase64 = '', $certPassword = '')
  {
    $this->certBase64 = $certBase64;
    $this->certPassword = $certPassword;
  }

  public function NODE_info()
  {
    return $this->sendCurl($this->host, [
      'version' => '2.0',
      'method' => 'node.info',
    ]);
  }

  public function PKCS12_info()
  {
    return $this->sendCurl($this->host, [
      'version' => '2.0',
      'method' => 'info.pkcs12',
      'params' => [
        'p12' => $this->certBase64,
        'password' => $this->certPassword,
        'checkOcsp' => true,
        'checkCrl' => true,
        'alias' => '',
      ],
    ]);
  }

  public function RAW_sign($raw)
  {
    return $this->sendCurl($this->host, [
      'version' => '2.0',
      'method' => 'cms.sign',
      'params' => [
        'data' => $raw,
        'createTsp' => true,
        'tspInCms' => true,
        'p12array' => [
          [
            'alias' => '',
            'p12' => $this->certBase64,
            'password' => $this->certPassword,

          ]
        ]
      ]
    ]);
  }

  public function RAW_verify($cms)
  {
    return $this->sendCurl($this->host, [
      'version' => '2.0',
      'method' => 'cms.verify',
      'params' => [
        'checkCrl' => true,
        'checkOcsp' => true,
        'cms' => $cms,
      ],
    ]);
  }

  public function convertBase64ToFile($base64_string, $output_file)
  {
    // open the output file for writing
    $ifp = fopen($output_file, 'wb');
    // we could add validation here with ensuring count( $data ) > 1
    fwrite($ifp, base64_decode($base64_string));
    // clean up the file resource
    fclose($ifp);
    return $output_file;
  }

  public function convertFileToBase64($filePath)
  {
    $data = file_get_contents($filePath);
    return base64_encode($data);
  }

  private function sendCurl($url, $body, $header = ['Content-Type: application/json'], $withoutSlash = false)
  {
    $body = $withoutSlash ? json_encode($body, JSON_UNESCAPED_SLASHES) : json_encode($body);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    $server_output = curl_exec($ch);
    if (curl_errno($ch)) {
      $error_msg = curl_error($ch);
      print_r($error_msg);
    }
    curl_close($ch);
    return $this->jsonDecode($server_output, true);
  }

  private function jsonDecode($json, $assoc = false)
  {
    $ret = json_decode($json, $assoc);
    if ($error = json_last_error()) {
      $errorReference = [
        JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
        JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
        JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
        JSON_ERROR_SYNTAX => 'Syntax error.',
        JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
        JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
        JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
        JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
      ];
      $errStr = isset($errorReference[$error]) ? $errorReference[$error] : "Unknown error ($error)";
      throw new \Exception("JSON decode error ($error): $errStr");
    }
    return $ret;
  }
}
