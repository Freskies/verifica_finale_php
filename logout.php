<?php
/*
 * Copyright (c) 2022.
 * Giacchini Valerio
 * 5AIN - School Test
 */

//logout.php
session_start();
session_destroy();
header("location:index.php?action=login");
