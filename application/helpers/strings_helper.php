<?php
/***
 * IMPORTANT for older PHP versions (<5.3.0)
 * Make a string's first character lowercase if that character is alphabetic.
 * Note that 'alphabetic' is determined by the current locale. For instance, in the default "C" locale characters such as umlaut-a (ä) will not be converted.
 ***/
if (!function_exists('lcfirst')) {
    function lcfirst($string) {
        return substr_replace($string, strtolower(substr($string, 0, 1)), 0, 1);
    }
} //lcfirst()

/***
 * IMPORTANT for older PHP versions (<5.3.0)
 * Turns a CSV string into an array
 * @param: a string of CSV,
 	 optionally (default in brackets):
	 - separator (,)
	 - enclousure (")
	 - escape (\\)
 * @return: an array
 ***/
if(!function_exists('str_getcsv')) {
    function str_getcsv($input, $delimiter = ",", $enclosure = '"', $escape = "\\") {
        $fp = fopen("php://memory", 'r+');
        fputs($fp, $input);
        rewind($fp);
        $data = fgetcsv($fp, null, $delimiter, $enclosure); // $escape only got added in 5.3.0
        fclose($fp);
        return $data;
    }
} //str_getcsv()

/***
 * Replaces a search string with a replacement string exactly once in the subject string
 * @param: 3 strings
 * @return: string
 ***/
function str_replace_once($search, $replace, $subject) {
	$firstChar = strpos($subject, $search);
	if($firstChar !== false) {
		$beforeStr = substr($subject,0,$firstChar);
		$afterStr = substr($subject, $firstChar + strlen($search));
		return $beforeStr.$replace.$afterStr;
	} else {
		return $subject;
	}
} //str_replace_once()

/***
 * Checks if a string starts with another string
 ***/
function startsWith($haystack, $needle) {
    return $needle === "" || strpos($haystack, $needle) === 0;
} //startsWith()
/***
 * Checks if a string ends with another string
 ***/
function endsWith($haystack, $needle) {
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
} //endsWith()

/***
 * Makes HTML output safe (utf8 string inputs are OK!)
   & (ampersand) becomes &amp;
   " (double quote) becomes &quot;
   ' (single quote) becomes &#039; (or &apos;)
   < (less than) becomes &lt;
   > (greater than) becomes &gt;
 ***/
function escapeHTML($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
} //escapeHTML()

/***
 * Makes filename write-safe by stripping illegal characters e.g. < > : / | ?
 ***/
function escapeFileName($filename) {
	$bad = array_merge(
        array_map('chr', range(0,31)),
        array("<", ">", ":", '"', "/", "\\", "|", "?", "*"));
	return str_replace($bad, "", $filename);
} //escapeFileName()

/***
 * Makes an input string
 * - alphanumeric
 * - starts with alphabetical letter
 * - camelCase
 * @param: input string
 * @return: formattedString
 ***/
function formatCamelCase($s) {
	//Split by non-alphanumeral
	$tmp = preg_split('/[^a-zA-Z0-9]+/', $s, NULL, PREG_SPLIT_NO_EMPTY);

	//make each alphanumeral uppercase
	$toRet = '';
	foreach ($tmp as $i) {
		$toRet .= ucfirst($i);
	}
	
	//Remove preceding numerals
	$toRet = ltrim($toRet, '0..9');
	
	//make first letter lowecase
	return lcfirst($toRet);
} //formatCamelCase()

function formatPascalCase($s) {
	//Split by non-alphanumeral
	$tmp = preg_split('/[^a-zA-Z0-9]+/', $s, NULL, PREG_SPLIT_NO_EMPTY);
	
	//make each alphanumeral uppercase
	$toRet = '';
	foreach ($tmp as $i) {
		$toRet .= ucfirst($i);
	}
	
	//Remove preceding numerals
	return ltrim($toRet, '0..9');
} //formatPascalCase()

/***
 * Formats a monetary amount in cents to $DDD,DDD.cc
 * Note: NULL and empty returns $0.00
 ***/
function formatPrice($cents, $decimal_places=2, $prefix='$') {
	return $prefix.number_format($cents / 100, $decimal_places, '.', ',');
} //formatPrice()

/***
 * Formats a weight in grams to "573g" or "1.625kg
 ***/
function formatWeight($grams) {
	if ($grams < 1000) {
		return $grams.'g';
	}
	else {
		$kilos = $grams / 1000;
		return $kilos.'kg';
	}
} //formatWeight

/***
 * Strips input of all non-numeric chars and return it as an unsigned int
 * -Note: only supports bool, int and strings
 * -Note: arrays/objects return NULL
 * -Note: NULL remains NULL,
 * -Note: empty string '' returns NULL
 ***/
function str2UnsignedInt($a) {
	if (!isset($a)) return NULL;
	else if (is_bool($a)) {
		if ($a) return 1;
		else return 0;
	} //bool
	else if (is_int($a)) {
		if ($a<0) return 0-$a;
		else return $a;
	} //int
	else if (is_string($a)) {
		if (strlen($a) == 0) return NULL;
		else return (int) preg_replace('/[^0-9.]+/', '', $a);
	} //string
	else return NULL;
} //toUnsignedInt()

/***
 * Turns an array into a CSV string
 * Note: NULL returns '' (empty string)
 * @param: an array, a separator (default ',')
 * @return: a string of CSV
 ***/
function array2csv($arr, $separator = ',') {
	if (empty($arr)) return '';
	$tmp = '';
	foreach ($arr as $data) {
		if (strpos($data,',') !== false) {
			$data = '"'.$data.'"';
		}
		$tmp .= $data . $separator;
	}
	return trim($tmp,', ');
} //array2csv()

/***
 * Converts an array to XML
 * @param array $data - the array of all data
 * @param string @indent - how much indentation to be put on the result. Each recursion would append a tab on it
 * Returns a string of XML
 ***/
function array2xml($data, $curr_indent="", $indent="\t", $newline="\n") {
	$xml = '';
	foreach ($data as $key => $value) {
		if (is_array($value)) {
			$xml .= $curr_indent.'<'.$key.'>'.$newline;
			$xml .= array2xml($value, $curr_indent.$indent, $indent, $newline);
			$xml .= $curr_indent.'</'.$key.'>'.$newline;
		}
		else {
            $xml .= $curr_indent.'<'.$key.'>'.$value.'</'.$key.'>'.$newline;
		}
	}
	return $xml;
} //array2xml()

/***
 * Changes a binary string to hex GUID
 ***/
function bin2hexGUID($b) {
	$hex = bin2hex($b);
	//Insert dashes after 8 digits, 4 digits, 4digits, 4digits
	$hex = substr_replace($hex, '-', 8, 0);
	$hex = substr_replace($hex, '-', 13, 0);
	$hex = substr_replace($hex, '-', 18, 0);
	$hex = substr_replace($hex, '-', 23, 0);
	return $hex;
} //bin2hexGUID

/*********************
 *   String Checks   *
 *********************/ 
/***
 * Checks if an input is an integer
 ***/
function isInt($a) {
	if (is_int($a)) return true;
	else return preg_match("/^-?[0-9]+$/", $a);
}
/***
 * Checks if an input is an unsigned integer
 * e.g. string '0' returns true, string '-1' returns false.
 * - Note: all floats (and strings with decimals) return false, NULL returns false
 ***/
function isUnsignedInt($a) {
	if (is_float($a)) {
		return ($a >=0 && $a == round($a));
	}
	else if (is_int($a)) {
		return ($a>=0);
	} //type: int
	else if (is_string($a)) {
		return (ctype_digit($a));
	} //type: string
	return FALSE;
} //isUnsignedInt()

/***
 * Checks if a string is a valid SG phone number, i.e.
 * - starts with 3, 6, 8, 9
 * - is 8 digits long
 * - first 3 digits are not 993, 995 or 990
 * OR starts with 1800 and is 11 digits long
 ***/
function isValidPhone($a, $locale='SG') {
	if ($locale !='SG') throw new Exception ('isValidPhone() not yet implemented for locale: '.$locale);
	
	if (!ctype_digit($a)) return FALSE;
	if (strlen($a) != 8 && strlen($a) != 11) return FALSE;
	
	//Check 1800 numbers
	if (strlen($a) == 11) {
		if ($first4char = substr($a, 0, 4) == '1800') return TRUE;
		else return FALSE;
	}
	
	//Check 3,6,8,9 numbers
	if ($a[0] != '3' && $a[0] != '6' && $a[0] != '8' && $a[0] != '9') return FALSE;
	
	$first3char = substr($a, 0, 3);	
	if ($first3char == '993' || $first3char == '995' || $first3char == '999') return FALSE;
	
	return TRUE;
} //isValidPhone()

/***
 * Checks if a string is a valid SG mobile number, i.e.
 * - is 8 digits long
 * - starts with 8 or 9
 * - first 3 digits are not 993, 995 or 990
 ***/
function isValidMobile($a, $locale='SG') {
	if ($locale !='SG') throw new Exception ('isValidMobile() not yet implemented for locale: '.$locale);
	
	if (!ctype_digit($a)) return FALSE;
	if (strlen($a) != 8) return FALSE;
	if ($a[0] != '8' && $a[0] != '9') return FALSE;
	
	$first3char = substr($a, 0, 3);
	if ($first3char == '993' || $first3char == '995' || $first3char == '999') return FALSE;
	
	return TRUE;
} //isValidMobile()

/***
 * Checks that email is valid (using PHP validation)
 ***/
function isValidEmail($email) {
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
	else return false;
} //isValidEmail()

/***
 * Checks if a string is a valid Hex GUID
 ***/
function isValidHexGUID($guid) {
	$guid = strtoupper($guid);
	return preg_match('/^\{?[A-F0-9]{8}-[A-F0-9]{4}-[A-F0-9]{4}-[A-F0-9]{4}-[A-F0-9]{12}\}?$/', $guid);
} //isValidHexGUID()

function isValidPostalCode($a, $locale='SG') {
	if ($locale !='SG') throw new Exception ('isValidPostalCode() not yet implemented for locale: '.$locale);
	
	if (strlen($a) > 6) return FALSE;
	return isUnsignedInt($a);
} //isValidPostalCode()

/***
 * Determines if string is a valid ip address, e.g. "192.168.0.1"
 ***/
function isValidIPAddress($ip) {
	return filter_var($ip, FILTER_VALIDATE_IP);
} //isValidIPAddress()

/***
 * Checks that URL is valid
 * - Note: input must be in "escaped" form, e.g. %20 instead of spaces
 ***/
function isValidURL($url) {
	$url_format = '/^'.
		'(https?:\/\/)'.												// protocol (mandatory)
		'('.															// START: domain + TLD (mandatory)
			'([a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*'.				// - domain
			'[a-z][a-z0-9-]*[a-z0-9]'.									// - TLD
		')'.															// END: domain + TLD (mandatory)
		'('.															// START: path + query string (optional)
		/*
			'((\/+([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)*'.	// - path							//doesn't work
			'(\?([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)?)?'.	// - query string (optional)		//doesn't work
		*/
			'(\/+([\?\/a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)*'.										// less rigid, but works
		')?'.															// END: path + query string (optional)
		'(#([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)?'.			// fragment (optional)
		'$/i';															// insensitive matching

	return preg_match($url_format, $url);	
} //isValidURL()

/***
 * Checks if an input is a valid NRIC / FIN
 * The math goes like this:
	1) 	Multiply first digit by 2, second multiply by 7, third by 6, fourth by 5, fifth by 4, sixth by 3, seventh by 2.
		Sum the totals, e.g. NRIC number S1234567. Sum = 1×2 + 2×7 + 3×6 + 4×5 + 5×4 + 6×3 + 7×2 = 106.

	2)	If the first letter of the NRIC starts with T or G, add 4 to the total.

	3)	Divide the number by 11 and get the remainder. 106/11 = 9r7

	4)	Last letter depends on the first letter in the IC, using the code below:
		If the IC starts with S or T: 0=J, 1=Z, 2=I, 3=H, 4=G, 5=F, 6=E, 7=D, 8=C, 9=B, 10=A
		If the IC starts with F or G: 0=X, 1=W, 2=U, 3=T, 4=R, 5=Q, 6=P, 7=N, 8=M, 9=L, 10=K
 ***/
function isValidNRIC($a) {
	if (!is_string($a)) return false;	
	if (strlen($a) != 9) return false;

	$c = str_split($a);
	$digits = (substr($a, 1, 7));
	
	if ($c[0] != 'S' && $c[0] != 'F' && $c[0] != 'T' && $c[0] != 'G') return false;
	if (!ctype_digit($digits)) return false;
	
	//Do the math
	$sum = $c[1]*2 + $c[2]*7 + $c[3]*6 + $c[4]*5 + $c[5]*4 + $c[6]*3 + $c[7]*2;
	if ($c[0] == 'T' || $c[0] == 'G') $sum +=4;
	$remainder = $sum % 11;
	
	switch ($remainder) {
		case '0':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'J';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'X';
			break;
		case '1';
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'Z';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'W';
			break;
		case '2':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'I';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'U';
			break;
		case '3':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'H';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'T';
			break;
		case '4':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'G';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'R';
			break;
		case '5':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'F';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'Q';
			break;
		case '6':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'E';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'P';
			break;
		case '7':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'D';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'N';
			break;
		case '8':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'C';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'M';
			break;
		case '9':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'B';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'L';
			break;
		case '10':
			if ($c[0] == 'S' || $c[0] == 'T') return $c[8] == 'A';
			if ($c[0] == 'F' || $c[0] == 'G') return $c[8] == 'K';
			break;
		default:
			return false;
	}
	return false;
} //isValidNRIC()
