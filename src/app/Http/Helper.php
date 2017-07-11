<?php

function sanitize_number($str)
{
	return preg_replace("/([^0-9\\.])/i", "", $str);
}

function sanitize_string($string)
{
	return trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9\\-]/', ' ', urldecode(html_entity_decode(strip_tags($string))))));
}

function validate_email($email)
{
    // SET INITIAL RETURN VARIABLES

        $emailIsValid = FALSE;

    // MAKE SURE AN EMPTY STRING WASN'T PASSED

        if (!empty($email))
        {
            // GET EMAIL PARTS

                $domain = ltrim(stristr($email, '@'), '@');
                $user   = stristr($email, '@', TRUE);

            // VALIDATE EMAIL ADDRESS

                if
                (
                    !empty($user) &&
                    !empty($domain) &&
                    checkdnsrr($domain)
                )
                {$emailIsValid = TRUE;}
        }

    // RETURN RESULT

        return $emailIsValid;
}