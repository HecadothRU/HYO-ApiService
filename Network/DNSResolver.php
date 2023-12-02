<?php
header('Content-Type: application/json');

function dns_resolver($domain, $recordType = 'A') {
    $dnsRecords = dns_get_record($domain, $recordType);

    if ($dnsRecords === false) {
        return ['error' => 'An error occurred while trying to retrieve DNS records.'];
    }

    if (count($dnsRecords) == 0) {
        return ['error' => 'No records found for the specified domain and record type.'];
    }

    $result = [];
    foreach ($dnsRecords as $record) {
        if (isset($record['ip'])) {
            $result[] = ['type' => $record['type'], 'ip' => $record['ip']];
        } elseif (isset($record['target'])) {
            $result[] = ['type' => $record['type'], 'target' => $record['target']];
        }
    }

    return $result;
}

$domain = $_GET['domain'] ?? '';
$recordType = $_GET['record_type'] ?? 'A';

if (empty($domain)) {
    http_response_code(400);
    echo json_encode(['error' => 'A domain name is required.']);
    exit;
}

$response = dns_resolver($domain, $recordType);
echo json_encode($response);
