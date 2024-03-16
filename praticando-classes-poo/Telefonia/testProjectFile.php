<?php
require_once 'Fixo.php';
require_once 'PrePago.php';
require_once 'PosPago.php';

use pooWithPhp\Telefonia\Fixo;
use pooWithPhp\Telefonia\PosPago;
use pooWithPhp\Telefonia\PrePago;

$fixo = new Fixo('018', '997455265', 1);

$prePago = new PrePago('018', '18997455265', 'vivo', 1);
$posPago = new PosPago('018', '18997455265', 'tim', 1);

echo "Custo de ligação (fixo): " . $fixo->calculaCusto(10) . PHP_EOL;
echo "Custo de ligação (posPago): " . $posPago->calculaCusto(10) . PHP_EOL;
echo "Custo de ligação (prePago): " . $prePago->calculaCusto(10) . PHP_EOL;
