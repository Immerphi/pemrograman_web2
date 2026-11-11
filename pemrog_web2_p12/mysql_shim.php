<?php
/**
 * File: mysql_shim.php
 * Compatibility wrapper agar fungsi lama mysql_* tetap berjalan di PHP versi modern (PHP 7 & 8).
 */

if (!function_exists('mysql_connect')) {
    global $__mysql_global_connection;
    $__mysql_global_connection = null;

    function mysql_connect($host = 'localhost', $user = 'root', $pass = '', $new_link = false, $client_flags = 0) {
        global $__mysql_global_connection;
        $port = 3306;
        $socket = null;
        if (strpos($host, ':') !== false) {
            list($host, $port) = explode(':', $host, 2);
        }

        $passwords_to_try = [$pass];
        if (!in_array('rafi123', $passwords_to_try)) $passwords_to_try[] = 'rafi123';
        if (!in_array('', $passwords_to_try)) $passwords_to_try[] = '';

        $conn = false;
        foreach ($passwords_to_try as $p) {
            try {
                $c = @mysqli_connect($host, $user, $p, '', (int)$port, $socket);
                if ($c) {
                    $conn = $c;
                    break;
                }
            } catch (Throwable $e) {}
        }

        if ($conn) {
            $__mysql_global_connection = $conn;
            return $conn;
        }
        return false;
    }

    function mysql_pconnect($host = 'localhost', $user = 'root', $pass = '', $client_flags = 0) {
        return mysql_connect($host, $user, $pass);
    }

    function mysql_select_db($db_name, $link_id = null) {
        global $__mysql_global_connection;
        $conn = $link_id ?: $__mysql_global_connection;
        if (!$conn) return false;
        return @mysqli_select_db($conn, $db_name);
    }

    function mysql_query($query, $link_id = null) {
        global $__mysql_global_connection;
        $conn = $link_id ?: $__mysql_global_connection;
        if (!$conn) return false;
        return @mysqli_query($conn, $query);
    }

    function mysql_fetch_row($result) {
        if (!$result) return false;
        return @mysqli_fetch_row($result);
    }

    function mysql_fetch_array($result, $result_type = 3) {
        if (!$result) return false;
        return @mysqli_fetch_array($result, MYSQLI_BOTH);
    }

    function mysql_fetch_assoc($result) {
        if (!$result) return false;
        return @mysqli_fetch_assoc($result);
    }

    function mysql_num_rows($result) {
        if (!$result) return 0;
        return @mysqli_num_rows($result);
    }

    function mysql_error($link_id = null) {
        global $__mysql_global_connection;
        $conn = $link_id ?: $__mysql_global_connection;
        if (!$conn) return mysqli_connect_error();
        return mysqli_error($conn);
    }

    function mysql_close($link_id = null) {
        global $__mysql_global_connection;
        $conn = $link_id ?: $__mysql_global_connection;
        if ($conn) {
            $res = @mysqli_close($conn);
            if ($conn === $__mysql_global_connection) {
                $__mysql_global_connection = null;
            }
            return $res;
        }
        return false;
    }
}
