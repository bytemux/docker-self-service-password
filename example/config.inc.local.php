<?php
#==============================================================================
# Configuration
#==============================================================================
# Debug mode
# true: log and display any errors or warnings (use this in configuration/testing)
# false: log only errors and do not display them (use this in production)
$debug = false;

# LDAP
$ldap_url = "ldaps://INSERT_DATA";
$ldap_starttls = false;
$ldap_binddn = "CN=INSERT_DATA,OU=INSERT_DATA,DC=INSERT_DATA,DC=INSERT_DATA";
$ldap_bindpw = "INSERT_DATA";
$ldap_base = "OU=INSERT_DATA,OU=INSERT_DATA,DC=INSERT_DATA,DC=INSERT_DATA";
$ldap_login_attribute = "uid";
$ldap_fullname_attribute = "cn";
#AD user
$ldap_filter = "(&(objectClass=user)(sAMAccountName={login})(!(userAccountControl:1.2.840.113556.1.4.803:=2)))";
#AD user@domain.org
#$ldap_filter = "(&(objectClass=user)(UserPrincipalName={login})(!(userAccountControl:1.2.840.113556.1.4.803:=2)))";
#LDAP
#$ldap_filter = "(&(objectClass=person)($ldap_login_attribute={login}))";

# Active Directory mode
    # true: use unicodePwd as password field
    # false: LDAPv3 standard behavior
    $ad_mode = true;
    # Force account unlock when password is changed
    $ad_options['force_unlock'] = false;
    # Force user change password at next login
    $ad_options['force_pwd_change'] = false;
    # Allow user with expired password to change password
    $ad_options['change_expired_password'] = true;

# Samba mode
    # true: update sambaNTpassword and sambaPwdLastSet attributes too
    # false: just update the password
    $samba_mode = false;
    # Set password min/max age in Samba attributes
    #$samba_options['min_age'] = 5;
    #$samba_options['max_age'] = 45;

# Shadow options - require shadowAccount objectClass
    # Update shadowLastChange
    $shadow_options['update_shadowLastChange'] = true;
    $shadow_options['update_shadowExpire'] = true;

    # Default to -1, never expire
    $shadow_options['shadow_expire_days'] = -1;

# Hash mechanism for password:
    # SSHA, SSHA256, SSHA384, SSHA512
    # SHA, SHA256, SHA384, SHA512
    # SMD5
    # MD5
    # CRYPT
    # clear (the default)
    # auto (will check the hash of current password)
    # This option is not used with ad_mode = true
    $hash = "clear";

    # Prefix to use for salt with CRYPT
    $hash_options['crypt_salt_prefix'] = "$6$";
    $hash_options['crypt_salt_length'] = "6";

# Local password policy
# This is applied before directory password policy
    # Minimal length
    $pwd_min_length = 12;
    # Maximal length
    $pwd_max_length = 0;
    # Minimal lower characters
    $pwd_min_lower = 0;
    # Minimal upper characters
    $pwd_min_upper = 1;
    # Minimal digit characters
    $pwd_min_digit = 1;
    # Minimal special characters
    $pwd_min_special = 1;
    # Definition of special characters
    $pwd_special_chars = "^a-zA-Z0-9";
    # Forbidden characters
    #$pwd_forbidden_chars = "@%";
    # Don't reuse the same password as currently
    $pwd_no_reuse = true;
    # Check that password is different than login
    $pwd_diff_login = true;
    # Complexity: number of different class of character required
    $pwd_complexity = 0;
    # use pwnedpasswords api v2 to securely check if the password has been on a leak
    $use_pwnedpasswords = false;
    # Show policy constraints message:
    # always
    # never
    # onerror
    $pwd_show_policy = "always";
    # Position of password policy constraints message:
    # above - the form
    # below - the form
    $pwd_show_policy_pos = "above";

# Who changes the password?
# Also applicable for question/answer save
# user: the user itself
# manager: the above binddn
$who_change_password = "manager";

## Standard change
# Use standard change form?
$use_change = false;

## SSH Key Change
    # Allow changing of sshPublicKey?
    $change_sshkey = false;
    # What attribute should be changed by the changesshkey action?
    $change_sshkey_attribute = "sshPublicKey";
    # Who changes the sshPublicKey attribute?
    # Also applicable for question/answer save
    # user: the user itself
    # manager: the above binddn
    $who_change_sshkey = "user";
    # Notify users anytime their sshPublicKey is changed
    ## Requires mail configuration below
    $notify_on_sshkey_change = false;

## Questions/answers
    # Use questions/answers?
    # true (default)
    # false
    $use_questions = false;
    # Answer attribute should be hidden to users!
    $answer_objectClass = "extensibleObject";
    $answer_attribute = "info";
    # Crypt answers inside the directory
    $crypt_answers = true;
    # Extra questions (built-in questions are in lang/$lang.inc.php)
    #$messages['questions']['ice'] = "What is your favorite ice cream flavor?";

## Token
    # Use tokens?
    # true (default)
    # false
    $use_tokens = true;     #Reset by mail tokens
    # Crypt tokens?
    # true (default)
    # false
    $crypt_tokens = true;
    # Token lifetime in seconds
    $token_lifetime = "3600";

## Mail
    # LDAP mail attribute
    $mail_attribute = "mail";
    #$mail_attribute = "UserPrincipalName";
    # Get mail address directly from LDAP (only first mail entry)
    # and hide mail input field
    # default = false
    $mail_address_use_ldap = true;
    # Who the email should come from
    $mail_from = "INSERT_DATA";
    $mail_from_name = "Сброс пароля INSERT_DATA";
    $mail_signature = "";
    # Notify users anytime their password is changed
    $notify_on_change = true;
    # PHPMailer configuration (see https://github.com/PHPMailer/PHPMailer)
    $mail_sendmailpath = '/usr/sbin/sendmail';
    $mail_protocol = 'smtp';
    $mail_smtp_debug = 0;
    $mail_debug_format = 'error_log';
    $mail_smtp_host = 'smtp.yandex.ru';
    $mail_smtp_auth = true;
    $mail_smtp_user = 'INSERT_DATA';
    $mail_smtp_pass = 'INSERT_DATA';
    $mail_smtp_port = 587;
    $mail_smtp_timeout = 30;
    $mail_smtp_keepalive = false;
    $mail_smtp_secure = 'tls';
    $mail_smtp_autotls = true;
    $mail_contenttype = 'text/plain';
    $mail_wordwrap = 0;
    $mail_charset = 'utf-8';
    $mail_priority = 3;
    $mail_newline = PHP_EOL;

## SMS
    # Use sms
    $use_sms = false;
    # SMS method (mail, api)
    $sms_method = "mail";
    $sms_api_lib = "lib/smsapi.inc.php";
    # GSM number attribute
    $sms_attribute = "mobile";
    # Partially hide number
    $sms_partially_hide_number = true;
    # Send SMS mail to address
    $smsmailto = "{sms_attribute}@service.provider.com";
    # Subject when sending email to SMTP to SMS provider
    $smsmail_subject = "Provider code";
    # Message
    $sms_message = "{smsresetmessage} {smstoken}";
    # Remove non digit characters from GSM number
    $sms_sanitize_number = false;
    # Truncate GSM number
    $sms_truncate_number = false;
    $sms_truncate_number_length = 10;
    # SMS token length
    $sms_token_length = 6;
    # Max attempts allowed for SMS token
    $max_attempts = 3;

# Encryption, decryption keyphrase, required if $crypt_tokens = true
# Please change it to anything long, random and complicated, you do not have to remember it
# Changing it will also invalidate all previous tokens and SMS codes
$keyphrase = "INSERT_DATA";

# Reset URL (if behind a reverse proxy)
$reset_url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . "://" . $_SERVER['HTTP_X_FORWARDED_HOST'] . $_SERVER['SCRIPT_NAME'];

# Display help messages
$show_help = true;

# Default language
$lang = "ru";

# List of authorized languages. If empty, all language are allowed.
# If not empty and the user's browser language setting is not in that list, language from $lang will be used.
$allowed_lang = array();
$allowed_lang[] = "ru";

# Display menu on top
$show_menu = false;

# Logo
$logo = "images/logo.png";

# Background image
$background_image = "images/background.jpg";

# Where to log password resets - Make sure apache has write permission
# By default, they are logged in Apache log
#$reset_request_log = "/var/log/self-service-password";

# Invalid characters in login
# Set at least "*()&|" to prevent LDAP injection
# If empty, only alphanumeric characters are accepted
$login_forbidden_chars = "*()&|";

## CAPTCHA
# Use Google reCAPTCHA (http://www.google.com/recaptcha)
$use_recaptcha = true;
# Go on the site to get public and private key
$recaptcha_publickey = "INSERT_DATA";
$recaptcha_privatekey = "INSERT_DATA";
# Customization (see https://developers.google.com/recaptcha/docs/display)
$recaptcha_theme = "light";
$recaptcha_type = "image";
$recaptcha_size = "normal";
# reCAPTCHA request method, null for default, Fully Qualified Class Name to override
# Useful when allow_url_fopen=0 ex. $recaptcha_request_method = '\ReCaptcha\RequestMethod\CurlPost';
$recaptcha_request_method = null;

## Default action
# change
# sendtoken
# sendsms
$default_action = "sendtoken";

## Extra messages
# They can also be defined in lang/ files
#$messages['passwordchangedextramessage'] = NULL;
#$messages['changehelpextramessage'] = NULL;

# Launch a posthook script after successful password change
#$posthook = "/usr/share/self-service-password/posthook.sh";

