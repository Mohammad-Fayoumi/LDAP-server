<?php
// Test xdebug
// echo (extension_loaded('xdebug') ? "installed":"not availabel");
/**
 * Domain Component (DC). DC objects represent the top of an LDAP tree that uses DNS to define its namespace.
 *  Active Directory is an example of such an LDAP tree.
 *  The designator for an Active Directory domain with the DNS name Company.com would be dc=Company,dc=com.
 */

/**
 * Organizational Unit (OU). OU objects act as containers that hold other objects.
 * They provide structure to the LDAP namespace.
 * OUs are the only general-purpose container available to administrators in Active Directory.
 * An example OU name would be ou=Accounting.
 */

/**
 * Distinguished Names
 * A name that includes an object's entire path to the root of the LDAP namespace is called its distinguished name,
 * or DN. An example DN for a user named CSantana whose object is stored
 *in the cn=Users container in a domain named Company.com would be cn=CSantana,cn=Users,dc=Company,dc=com.
 */
$ldap_dn = 'cn=read-only-admin,dc=example,dc=com';
$ldap_password = 'password';
// $ldap_con = ldap_connect("ldap.forumsys.com");
$ldap_con = ldap_connect("54.196.176.103", 389);
ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);

if (ldap_bind($ldap_con, $ldap_dn, $ldap_password)) {
    // $filter = "(uid=newton)";
    $filter = "(cn=Bernhard Riemann)";

    $result = ldap_search($ldap_con, "dc=example,dc=com", $filter) or exit("Unable to search");
    $entries = ldap_get_entries($ldap_con, $result);

    print '<pre>';
    print_r($entries);
    print '</pre>';

} else {
    echo "Invalid connection";
}
