<?php
$subdomains = [
    "dc", "api", "irc", "irix", "fileserver", "backup", "agent", "c2c", "login",
    "mssql", "mysql", "localhost", "nameserver", "netstats", "mobile", "mobil",
    "ftp", "webadmin", "uploads", "transfer", "tmp", "support", "smtp0#", "smtp#",
    "smtp", "sms", "shopping", "sandbox", "proxy", "manager", "cpanel", "webmail",
    "forum", "driect- connect", "vb", "forums", "pop#", "pop", "home", "direct",
    "mail", "access", "admin", "oracle", "monitor", "administrator", "email",
    "downloads", "ssh", "webmin", "paralel", "parallels", "www0", "www", "www1",
    "www2", "www3", "www4", "www5", "autoconfig.admin", "autoconfig",
    "autodiscover.admin", "autodiscover", "sip", "msoid", "lyncdiscover"
];

$url = $_GET['url'];

foreach ($subdomains as $row) {
    $host = $row . '.' . $url;
    $ip = gethostbyname($host);
    if ($ip !== $host) {
        echo ''. $host . ' | ' . $ip . "\n";
    }
}
?>
