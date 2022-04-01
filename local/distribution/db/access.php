<?php
$capabilities = array(
    'local/distribution' => array(
        'riskbitmask' => RISK_SPAM | RISK_PERSONAL | RISK_XSS | RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'student' => CAP_PROHIBIT,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        )
    ),
);