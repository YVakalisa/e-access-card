<?php
if (\PHP_SAPI !== 'cli' && \PHP_SAPI !== 'phpdbg') {
    exit(1);
}

eval('?>' . file_get_contents('php://stdin'));
