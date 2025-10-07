<?php
// db_init.php - jalankan sekali untuk inisialisasi database
require 'db.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$db->exec("CREATE TABLE IF NOT EXISTS users (
id INTEGER PRIMARY KEY AUTOINCREMENT,
username TEXT UNIQUE NOT NULL,
password TEXT NOT NULL,
created_at TEXT DEFAULT CURRENT_TIMESTAMP
);");


$db->exec("CREATE TABLE IF NOT EXISTS tasks (
id INTEGER PRIMARY KEY AUTOINCREMENT,
user_id INTEGER NOT NULL,
title TEXT NOT NULL,
description TEXT,
is_done INTEGER DEFAULT 0,
created_at TEXT DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(user_id) REFERENCES users(id)
);");


echo "Database initialized. File: data.mysql";