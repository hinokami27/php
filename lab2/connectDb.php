<?php
function connect():SQLite3{
    return new SQLite3(__DIR__."/database/movies.sqlite");
}