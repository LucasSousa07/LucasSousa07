<?php
require_once __DIR__ . '/../src/dao/vagadao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? 0;

$dao = new VagaDAO();
$result = $dao->delete($id);

if ($result > 0) {
    header('location: index.php?delete=sucesso');
} else {
    header('location: index.php?delete=erro');
}