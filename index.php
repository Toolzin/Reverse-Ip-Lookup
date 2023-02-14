$data = [];

if(!empty($_POST)) {
    $_POST['ip'] = input_clean($_POST['ip']);

    /* Check for any errors */
    $required_fields = ['ip'];
    foreach($required_fields as $field) {
        if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
            Alerts::add_field_error($field, l('global.error_message.empty_field'));
        }
    }

    if(!filter_var($_POST['ip'], FILTER_VALIDATE_IP)) {
        Alerts::add_field_error('ip', l('tools.reverse_ip_lookup.error_message'));
    }

    if(!Alerts::has_field_errors() && !Alerts::has_errors()) {
        $data['result'] = gethostbyaddr($_POST['ip']);
    }
}

$values = [
    'ip' => $_POST['ip'] ?? get_ip(),
    'result' => $data,
];
