<?php
// Local development database configuration. Do not commit real credentials.
$host = getenv('DB_HOST') ?: '127.0.0.1';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD');
if ($password === false) {
    $password = '';
}
$db_name = getenv('DB_NAME') ?: 'iwp';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $db = new mysqli($host, $username, $password, $db_name);
    $db->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log('Movie booking database connection failed: ' . $exception->getMessage());
    http_response_code(500);
    exit('Database connection is unavailable.');
}
?>
