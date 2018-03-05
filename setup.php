<?php
include_once 'bootstrap.php';

$pdo = new PdoSqlite('db/pastebin.sq3');

$sql = <<<'SQL_STATEMENT'
CREATE TABLE pastes
(
  id TEXT PRIMARY KEY,
  name TEXT NOT NULL,
  content TEXT NOT NULL,
  password_hash TEXT NOT NULL,
  encryption_iv TEXT NOT NULL,
  retries_left INTEGER NOT NULL,
  expires INTEGER NOT NULL
);
SQL_STATEMENT;
$pdo->exec($sql);
