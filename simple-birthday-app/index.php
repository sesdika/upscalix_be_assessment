<?php
    require_once('vendor/autoload.php');

    use Spatie\Async\Pool;


    function send_get_request($ch, $url) {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt ($curl, CURLOPT_CAINFO, dirname(__FILE__)."/cacert.pem");
        $curl_response = curl_exec($ch);
        if ($curl_response === false) {
            echo 'Curl error: ' . curl_error($ch);
            curl_close($curl);
            die('error occured during curl exec.');
        }

        return json_decode($curl_response);
    }

    function send_birthday_greeting($ch, $url, $customer_data) {
        
        $pool = Pool::create();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept: application/json", "Content-Type: application/json"]);
        foreach ($customer_data as $cust) {
            $pool[] = async(function () use ($cust, $ch) {
                $curl_post_data = '{
                    "email" : "'.$cust->cust_email.'",
                    "message" : "Hey, '.$cust->first_name.' '.$cust->last_name.' it\'s your birthday"
                }';
                curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
                return curl_exec($ch);
            })->then(function (String $curl_response) use ($cust) {
                if ($curl_response)
                    echo "<br>\nSent $curl_response : Hey, $cust->first_name $cust->last_name it's your birthday";
            })->catch(function (Exception $e) {
                $info = curl_getinfo($ch);
                curl_close($ch);
                die('<br>\nError occured during curl exec. Additional info: ' . var_export($info));
            });
        }
        await($pool);
    }

    $curl = curl_init();

    $get_response = send_get_request($curl, 'https://localhost/restapi_ci/api/customer');
    echo 'Response GET OK!<br>\n';
    var_export($get_response);

    send_birthday_greeting($curl, 'https://email-service.digitalenvision.com.au/send-email', $get_response);

    curl_close($curl);

?>

