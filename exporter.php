<?php

include 'functions.php';

$config = loadConfig();

$posts = getPosts($config->url);

verifyOutputFolder($config->path);

serializePostCollection($config->path, $posts);

echo "Task completed with " . count($posts) . " posts";
