<?php
session_start();
session_destroy();
header('Location: ../View/?success=' . urlencode("Logout efetuado com sucesso!"));