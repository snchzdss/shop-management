<?php
    function sanitize_input($input) {
        if (is_array($input)) {
            return array_map('sanitize_input', $input);
        }

        $cleaned = trim($input);


        if ($cleaned === 'on') {
            return '1';
        }

        return $cleaned === '' ? null : $cleaned;
    }


    function gen_code($prefix) {
        return str_replace('.', '', uniqid($prefix, true));
    }

    function valid_code ($input) {
        $parts = explode('_', $input);
        if (count($parts) !== 2) {
            return false;
        }
        if (!preg_match('/^[a-zA-Z]+$/', $parts[0])) {
            return false;
        }
        if (strlen($parts[1]) !== 22 || !preg_match('/^[a-zA-Z0-9]+$/', $parts[1])) {
            return false;
        }
        return true;
    }