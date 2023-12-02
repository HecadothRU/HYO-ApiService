<?php
// ISSUE: DOES NOT GRAB SLL DATA (DOESNT RETURN ANYTHING + DATES ARE BROKEN)
  function get_website_certificate($url) {
    try
    {
      $domain = parse_url($url, PHP_URL_HOST);
      $get = stream_context_create([
        'ssl' => [
          'capture_peer_cert' => TRUE,
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        ]
      ]);
      $read = @stream_socket_client('ssl://' . $domain . ':443', $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
      if(!$read || $errstr) return false;
      $cert = stream_context_get_params($read);
      $certInfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
      return empty($certInfo) ? false : $certInfo;
    } catch (\Exception $exception) {
      return false;
      }
    }
    function ssl_lookup($response) {
      $data = [];
      /* Check for an SSL certificate */
      $certificate = get_website_certificate($response); // FORMAT -> https://site.com/ | Input: $_GET['domain']>https://site.com{/}
        /* Create the new SSL object */
        $ssl = [
          'organization' => $certificate['issuer']['O'],
          'country' => $certificate['issuer']['C'],
          'common_name' => $certificate['issuer']['CN'],
          'start_datetime' => (new \DateTime())->setTimestamp($certificate['validFrom_time_t'])->format('Y-m-d H:i:s'),
          'end_datetime' => (new \DateTime())->setTimestamp($certificate['validTo_time_t'])->format('Y-m-d H:i:s'),
        ];
        $data['result'] = $ssl;
        $values = [
          'domain' => $_GET['domain'] ?? '',
        ];
        return $ssl;
      }
      if (isset($_GET['domain'])){
        $response = ssl_lookup($_GET['domain']);
        echo nl2br("Organization: ".$response['organization']."\nCountry: ".$response['country']."\nCommonName: ".$response['common_name']."\nValid Since: ".$response['start_datetime']."\nValid To: ". $response['end_datetime']."");
      } else {
        die("Missing GET Parameter | Set and Retry | [domain] ~> [https://site.com/]");
      }
