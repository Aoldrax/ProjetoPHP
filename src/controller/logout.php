<?php
session_start();
session_destroy();
header('Location: ../view/?success=' . urlencode("Logout efetuado com sucesso!"));