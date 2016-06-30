<?php

ini_set('memory_limit', '512M');

$data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/cpu.pretty.json');

$data = json_decode($data, true);