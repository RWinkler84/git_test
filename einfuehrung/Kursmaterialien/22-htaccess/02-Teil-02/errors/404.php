<?php
http_response_code(404);

echo '<h1>404 Not found</h1>';

echo '<pre>';
print_r($_SERVER);
echo '</pre>';