
<?php
// Your webhook signing key
//$webhook_signing_key = 'test_h3n9EV55r09TBybNpDqP94B2EuzkTHky';
echo "hello";
// Set the response header to JSON
header('Content-Type: application/json');

// Read the raw POST data from the input stream
$input = file_get_contents('php://input');

// Retrieve the signature from the request headers
$signature = isset($_SERVER['HTTP_X_CHARGEBEE_SIGNATURE']) ? $_SERVER['HTTP_X_CHARGEBEE_SIGNATURE'] : '';
// Decode the JSON data
error_log('inpute-data=>' . $input);
$event = json_decode($input, true);

// Log the received event (for debugging)
file_put_contents('webhook_log.txt', print_r($event, true), FILE_APPEND);
$customer_id=$event['content']['customer']['billing_address']['city'];
echo json_encode([$customer_id]);
//$event['content']['customer']['billing_address']['city'];
// Handle the event
if ($event) {
    switch ($event['event_type']) {
        case 'customer_changed':
        error_log('customer chnaged');
            // Handle subscription created event
            break;
        case 'invoice_generated':
            // Handle invoice generated event
            break;
        // Add more cases to handle other event types
        default:
            // Handle other event types
            break;
    }
}
// Respond with a 200 status code to acknowledge receipt of the webhook
http_response_code(200);
echo json_encode(['status' => 'success']);
?>
