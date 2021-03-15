<?php 
class Country {
	public $name;
	public $short;
	public $api;


	function __construct($api = 1) { 
		$this->api = $api;
	}
	public function AddCountry($name = null,$short = null) {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class.
		$name = $cog->sql_prep($name);
		$short = $cog->sql_prep($short); 
		$id = uniqid(); // setting a unique id.
		$adc = $c->query("SELECT * FROM tableoperatingcountrylist WHERE country = '$name' OR short = '$short'"); // getting table country table data when the country name and short country name are the same with name and short
		if(@$adc->num_rows == 0) { // checking if the table is empty so that country can't be added twice
			if($c->query("INSERT INTO tableoperatingcountrylist (country_id,country,short)VALUES('$id','$name','$short')")){ // inserting the country.
				if ($this->api) { // checking if the request is from the api or not
					return array(
						'success' => 1,
						'statuscode' => 200,
						'msg' => 'Added Successfully!',
					);
				}else {
					return true;
				}
			}
		}else {
			if ($this->api) {
				return array(
					'success' => 0,
					'statuscode' => 400,
					'msg' => 'Sorry, this country exists!',
				);
			}else {
				return false;
			}
		}
	}
	public function ListCountry() {
		$db = Database::getInstance();
		$c = $db->getc();
		$adc = $c->query("SELECT * FROM tableoperatingcountrylist"); // getting country list
		if ($this->api) { // checking if the request is from the api or not
				if($adc->num_rows > 0) { // checking if the table is not empty
					$list[] =array();
					$i = 0; // counter variable
					while ($exe = $adc->fetch_array()) {
						$list[$i] = $exe['country']; // adding each country in the database to the list array
						$i++;
					}
					return array(
						'success' => 1,
						'statuscode' => 200,
                                    'list' => $this->CountryShowToggle(),
						'msg' => "Result found.",
						'country' => $list,
					);
			}else {
				return array(
						'success' => 0,
						'statuscode' => 400,
                                    'list' => false,
						'msg' => "List is empty",
						'country' => null,
					);
			}
		}else {
			if($adc->num_rows > 0) {
					$lister[] =array();
					$i = 0;
					while ($exe = $adc->fetch_array()) {
						$lister[$i] = $exe['country'];
						$i++;
					}
				return $lister;
			}else {
				return "No Result";
			}
		}
	}
	public function AddRegion() {
	}
      public function CountryName($id) {
            $db = Database::getInstance(); // getting instance of the database.
            $c = $db->getc();
            $adc = $c->query("SELECT * FROM tableoperatingcountrylist WHERE country_id='$id'"); // checking if the country list is showing at the app
            $exe = $adc->fetch_array();
            return $exe['country'];
      }
      public function CountryCode($id) {
            $db = Database::getInstance(); // getting instance of the database.
            $c = $db->getc();
            $adc = $c->query("SELECT * FROM tableoperatingcountrylist WHERE country_id='$id'"); // checking if the country list is showing at the app
            $exe = $adc->fetch_array();
            return $exe['short'];
      }
      public function CityName($id) {
            $db = Database::getInstance(); // getting instance of the database.
            $c = $db->getc();
            $adc = $c->query("SELECT * FROM cities WHERE city_id='$id'");
            $exe = $adc->fetch_array();
            return $exe['name'];
      }
      public function CityToCid($id) {
            $db = Database::getInstance(); // getting instance of the database.
            $c = $db->getc();
            $adc = $c->query("SELECT * FROM cities WHERE city_id='$id'"); 
            $exe = $adc->fetch_array();
            return $exe['country_id'];
      }     
	public function EnableCountryList() {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		if ($c->query("UPDATE ctoggler SET status=1")) { // Enabling country list
		 	return true;
		 }else {
		 	return false;
		 }
	}
	public function DisableCountryList() {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		if ($c->query("UPDATE ctoggler SET status=0")) { // Disabling country list
		 	return true;
		 }else {
		 	return false;
		 }
	}
	public function get_saved_countries_options($id = '') {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$options = "";
		$adc = $c->query("SELECT * FROM tableoperatingcountrylist"); // checking if the country list is showing at the app
		if ($adc->num_rows > 0) {
			while ($exe = $adc->fetch_array()) {
                        if($exe['country_id'] == $id){
                              $options .= "<option value='" . $exe['country_id'] ."' selected='selected'>". $exe['country'] . "</option>";
                        }else {
                              $options .= "<option value='" . $exe['country_id'] ."'>". $exe['country'] . "</option>";
                        }
			}
		 	return $options;
		 }else {
		 	return null;
		 }
	}
	public function CountryShowToggle() {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$adc = $c->query("SELECT * FROM ctoggler WHERE status = 0"); // checking if the country list is showing at the app
		if ($adc->num_rows == 0) {
		 	return true;
		 }else {
		 	return false;
		 }
	} 
	public function get_countries_options($selected_country = "ET") {
            $options = '';
            $selected = '';
            $countries = array
                  (
                  'AF' => 'Afghanistan',
                  'AX' => 'Aland Islands',
                  'AL' => 'Albania',
                  'DZ' => 'Algeria',
                  'AS' => 'American Samoa',
                  'AD' => 'Andorra',
                  'AO' => 'Angola',
                  'AI' => 'Anguilla',
                  'AQ' => 'Antarctica',
                  'AG' => 'Antigua And Barbuda',
                  'AR' => 'Argentina',
                  'AM' => 'Armenia',
                  'AW' => 'Aruba',
                  'AU' => 'Australia',
                  'AT' => 'Austria',
                  'AZ' => 'Azerbaijan',
                  'BS' => 'Bahamas',
                  'BH' => 'Bahrain',
                  'BD' => 'Bangladesh',
                  'BB' => 'Barbados',
                  'BY' => 'Belarus',
                  'BE' => 'Belgium',
                  'BZ' => 'Belize',
                  'BJ' => 'Benin',
                  'BM' => 'Bermuda',
                  'BT' => 'Bhutan',
                  'BO' => 'Bolivia',
                  'BA' => 'Bosnia And Herzegovina',
                  'BW' => 'Botswana',
                  'BV' => 'Bouvet Island',
                  'BR' => 'Brazil',
                  'IO' => 'British Indian Ocean Territory',
                  'BN' => 'Brunei Darussalam',
                  'BG' => 'Bulgaria',
                  'BF' => 'Burkina Faso',
                  'BI' => 'Burundi',
                  'KH' => 'Cambodia',
                  'CM' => 'Cameroon',
                  'CA' => 'Canada',
                  'CV' => 'Cape Verde',
                  'KY' => 'Cayman Islands',
                  'CF' => 'Central African Republic',
                  'TD' => 'Chad',
                  'CL' => 'Chile',
                  'CN' => 'China',
                  'CX' => 'Christmas Island',
                  'CC' => 'Cocos (Keeling) Islands',
                  'CO' => 'Colombia',
                  'KM' => 'Comoros',
                  'CG' => 'Congo',
                  'CD' => 'Congo, Democratic Republic',
                  'CK' => 'Cook Islands',
                  'CR' => 'Costa Rica',
                  'CI' => 'Cote D\'Ivoire',
                  'HR' => 'Croatia',
                  'CU' => 'Cuba',
                  'CY' => 'Cyprus',
                  'CZ' => 'Czech Republic',
                  'DK' => 'Denmark',
                  'DJ' => 'Djibouti',
                  'DM' => 'Dominica',
                  'DO' => 'Dominican Republic',
                  'EC' => 'Ecuador',
                  'EG' => 'Egypt',
                  'SV' => 'El Salvador',
                  'GQ' => 'Equatorial Guinea',
                  'ER' => 'Eritrea',
                  'EE' => 'Estonia',
                  'ET' => 'Ethiopia',
                  'FK' => 'Falkland Islands (Malvinas)',
                  'FO' => 'Faroe Islands',
                  'FJ' => 'Fiji',
                  'FI' => 'Finland',
                  'FR' => 'France',
                  'GF' => 'French Guiana',
                  'PF' => 'French Polynesia',
                  'TF' => 'French Southern Territories',
                  'GA' => 'Gabon',
                  'GM' => 'Gambia',
                  'GE' => 'Georgia',
                  'DE' => 'Germany',
                  'GH' => 'Ghana',
                  'GI' => 'Gibraltar',
                  'GR' => 'Greece',
                  'GL' => 'Greenland',
                  'GD' => 'Grenada',
                  'GP' => 'Guadeloupe',
                  'GU' => 'Guam',
                  'GT' => 'Guatemala',
                  'GG' => 'Guernsey',
                  'GN' => 'Guinea',
                  'GW' => 'Guinea-Bissau',
                  'GY' => 'Guyana',
                  'HT' => 'Haiti',
                  'HM' => 'Heard Island & Mcdonald Islands',
                  'VA' => 'Holy See (Vatican City State)',
                  'HN' => 'Honduras',
                  'HK' => 'Hong Kong',
                  'HU' => 'Hungary',
                  'IS' => 'Iceland',
                  'IN' => 'India',
                  'ID' => 'Indonesia',
                  'IR' => 'Iran, Islamic Republic Of',
                  'IQ' => 'Iraq',
                  'IE' => 'Ireland',
                  'IM' => 'Isle Of Man',
                  'IL' => 'Israel',
                  'IT' => 'Italy',
                  'JM' => 'Jamaica',
                  'JP' => 'Japan',
                  'JE' => 'Jersey',
                  'JO' => 'Jordan',
                  'KZ' => 'Kazakhstan',
                  'KE' => 'Kenya',
                  'KI' => 'Kiribati',
                  'KR' => 'Korea',
                  'KW' => 'Kuwait',
                  'KG' => 'Kyrgyzstan',
                  'LA' => 'Lao People\'s Democratic Republic',
                  'LV' => 'Latvia',
                  'LB' => 'Lebanon',
                  'LS' => 'Lesotho',
                  'LR' => 'Liberia',
                  'LY' => 'Libyan Arab Jamahiriya',
                  'LI' => 'Liechtenstein',
                  'LT' => 'Lithuania',
                  'LU' => 'Luxembourg',
                  'MO' => 'Macao',
                  'MK' => 'Macedonia',
                  'MG' => 'Madagascar',
                  'MW' => 'Malawi',
                  'MY' => 'Malaysia',
                  'MV' => 'Maldives',
                  'ML' => 'Mali',
                  'MT' => 'Malta',
                  'MH' => 'Marshall Islands',
                  'MQ' => 'Martinique',
                  'MR' => 'Mauritania',
                  'MU' => 'Mauritius',
                  'YT' => 'Mayotte',
                  'MX' => 'Mexico',
                  'FM' => 'Micronesia, Federated States Of',
                  'MD' => 'Moldova',
                  'MC' => 'Monaco',
                  'MN' => 'Mongolia',
                  'ME' => 'Montenegro',
                  'MS' => 'Montserrat',
                  'MA' => 'Morocco',
                  'MZ' => 'Mozambique',
                  'MM' => 'Myanmar',
                  'NA' => 'Namibia',
                  'NR' => 'Nauru',
                  'NP' => 'Nepal',
                  'NL' => 'Netherlands',
                  'AN' => 'Netherlands Antilles',
                  'NC' => 'New Caledonia',
                  'NZ' => 'New Zealand',
                  'NI' => 'Nicaragua',
                  'NE' => 'Niger',
                  'NG' => 'Nigeria',
                  'NU' => 'Niue',
                  'NF' => 'Norfolk Island',
                  'MP' => 'Northern Mariana Islands',
                  'NO' => 'Norway',
                  'OM' => 'Oman',
                  'PK' => 'Pakistan',
                  'PW' => 'Palau',
                  'PS' => 'Palestinian Territory, Occupied',
                  'PA' => 'Panama',
                  'PG' => 'Papua New Guinea',
                  'PY' => 'Paraguay',
                  'PE' => 'Peru',
                  'PH' => 'Philippines',
                  'PN' => 'Pitcairn',
                  'PL' => 'Poland',
                  'PT' => 'Portugal',
                  'PR' => 'Puerto Rico',
                  'QA' => 'Qatar',
                  'RE' => 'Reunion',
                  'RO' => 'Romania',
                  'RU' => 'Russian Federation',
                  'RW' => 'Rwanda',
                  'BL' => 'Saint Barthelemy',
                  'SH' => 'Saint Helena',
                  'KN' => 'Saint Kitts And Nevis',
                  'LC' => 'Saint Lucia',
                  'MF' => 'Saint Martin',
                  'PM' => 'Saint Pierre And Miquelon',
                  'VC' => 'Saint Vincent And Grenadines',
                  'WS' => 'Samoa',
                  'SM' => 'San Marino',
                  'ST' => 'Sao Tome And Principe',
                  'SA' => 'Saudi Arabia',
                  'SN' => 'Senegal',
                  'RS' => 'Serbia',
                  'SC' => 'Seychelles',
                  'SL' => 'Sierra Leone',
                  'SG' => 'Singapore',
                  'SK' => 'Slovakia',
                  'SI' => 'Slovenia',
                  'SB' => 'Solomon Islands',
                  'SO' => 'Somalia',
                  'ZA' => 'South Africa',
                  'GS' => 'South Georgia And Sandwich Isl.',
                  'ES' => 'Spain',
                  'LK' => 'Sri Lanka',
                  'SD' => 'Sudan',
                  'SR' => 'Suriname',
                  'SJ' => 'Svalbard And Jan Mayen',
                  'SZ' => 'Swaziland',
                  'SE' => 'Sweden',
                  'CH' => 'Switzerland',
                  'SY' => 'Syrian Arab Republic',
                  'TW' => 'Taiwan',
                  'TJ' => 'Tajikistan',
                  'TZ' => 'Tanzania',
                  'TH' => 'Thailand',
                  'TL' => 'Timor-Leste',
                  'TG' => 'Togo',
                  'TK' => 'Tokelau',
                  'TO' => 'Tonga',
                  'TT' => 'Trinidad And Tobago',
                  'TN' => 'Tunisia',
                  'TR' => 'Turkey',
                  'TM' => 'Turkmenistan',
                  'TC' => 'Turks And Caicos Islands',
                  'TV' => 'Tuvalu',
                  'UG' => 'Uganda',
                  'UA' => 'Ukraine',
                  'AE' => 'United Arab Emirates',
                  'GB' => 'United Kingdom',
                  'US' => 'United States',
                  'UM' => 'United States Outlying Islands',
                  'UY' => 'Uruguay',
                  'UZ' => 'Uzbekistan',
                  'VU' => 'Vanuatu',
                  'VE' => 'Venezuela',
                  'VN' => 'Viet Nam',
                  'VG' => 'Virgin Islands, British',
                  'VI' => 'Virgin Islands, U.S.',
                  'WF' => 'Wallis And Futuna',
                  'EH' => 'Western Sahara',
                  'YE' => 'Yemen',
                  'ZM' => 'Zambia',
                  'ZW' => 'Zimbabwe',
              ); // Every countries list.
        
            foreach ($countries as $code => $country_name) {
                  if($selected_country === $code){
                      $selected = 'selected="selected"';
                      $options .= '<option value="' . $country_name . '" ' . $selected . ' >'. $country_name . '</option>';
                  } else {
                      $options .= '<option value="' . $country_name . '" >'. $country_name . '</option>';
                  }
            }
            return $options;
      }
      public function get_countries_code_options($selected_country = "ET") {
        
            $options = '';
            $selected = '';
            $countries = array
                  (
                  'AF' => 'Afghanistan',
                  'AX' => 'Aland Islands',
                  'AL' => 'Albania',
                  'DZ' => 'Algeria',
                  'AS' => 'American Samoa',
                  'AD' => 'Andorra',
                  'AO' => 'Angola',
                  'AI' => 'Anguilla',
                  'AQ' => 'Antarctica',
                  'AG' => 'Antigua And Barbuda',
                  'AR' => 'Argentina',
                  'AM' => 'Armenia',
                  'AW' => 'Aruba',
                  'AU' => 'Australia',
                  'AT' => 'Austria',
                  'AZ' => 'Azerbaijan',
                  'BS' => 'Bahamas',
                  'BH' => 'Bahrain',
                  'BD' => 'Bangladesh',
                  'BB' => 'Barbados',
                  'BY' => 'Belarus',
                  'BE' => 'Belgium',
                  'BZ' => 'Belize',
                  'BJ' => 'Benin',
                  'BM' => 'Bermuda',
                  'BT' => 'Bhutan',
                  'BO' => 'Bolivia',
                  'BA' => 'Bosnia And Herzegovina',
                  'BW' => 'Botswana',
                  'BV' => 'Bouvet Island',
                  'BR' => 'Brazil',
                  'IO' => 'British Indian Ocean Territory',
                  'BN' => 'Brunei Darussalam',
                  'BG' => 'Bulgaria',
                  'BF' => 'Burkina Faso',
                  'BI' => 'Burundi',
                  'KH' => 'Cambodia',
                  'CM' => 'Cameroon',
                  'CA' => 'Canada',
                  'CV' => 'Cape Verde',
                  'KY' => 'Cayman Islands',
                  'CF' => 'Central African Republic',
                  'TD' => 'Chad',
                  'CL' => 'Chile',
                  'CN' => 'China',
                  'CX' => 'Christmas Island',
                  'CC' => 'Cocos (Keeling) Islands',
                  'CO' => 'Colombia',
                  'KM' => 'Comoros',
                  'CG' => 'Congo',
                  'CD' => 'Congo, Democratic Republic',
                  'CK' => 'Cook Islands',
                  'CR' => 'Costa Rica',
                  'CI' => 'Cote D\'Ivoire',
                  'HR' => 'Croatia',
                  'CU' => 'Cuba',
                  'CY' => 'Cyprus',
                  'CZ' => 'Czech Republic',
                  'DK' => 'Denmark',
                  'DJ' => 'Djibouti',
                  'DM' => 'Dominica',
                  'DO' => 'Dominican Republic',
                  'EC' => 'Ecuador',
                  'EG' => 'Egypt',
                  'SV' => 'El Salvador',
                  'GQ' => 'Equatorial Guinea',
                  'ER' => 'Eritrea',
                  'EE' => 'Estonia',
                  'ET' => 'Ethiopia',
                  'FK' => 'Falkland Islands (Malvinas)',
                  'FO' => 'Faroe Islands',
                  'FJ' => 'Fiji',
                  'FI' => 'Finland',
                  'FR' => 'France',
                  'GF' => 'French Guiana',
                  'PF' => 'French Polynesia',
                  'TF' => 'French Southern Territories',
                  'GA' => 'Gabon',
                  'GM' => 'Gambia',
                  'GE' => 'Georgia',
                  'DE' => 'Germany',
                  'GH' => 'Ghana',
                  'GI' => 'Gibraltar',
                  'GR' => 'Greece',
                  'GL' => 'Greenland',
                  'GD' => 'Grenada',
                  'GP' => 'Guadeloupe',
                  'GU' => 'Guam',
                  'GT' => 'Guatemala',
                  'GG' => 'Guernsey',
                  'GN' => 'Guinea',
                  'GW' => 'Guinea-Bissau',
                  'GY' => 'Guyana',
                  'HT' => 'Haiti',
                  'HM' => 'Heard Island & Mcdonald Islands',
                  'VA' => 'Holy See (Vatican City State)',
                  'HN' => 'Honduras',
                  'HK' => 'Hong Kong',
                  'HU' => 'Hungary',
                  'IS' => 'Iceland',
                  'IN' => 'India',
                  'ID' => 'Indonesia',
                  'IR' => 'Iran, Islamic Republic Of',
                  'IQ' => 'Iraq',
                  'IE' => 'Ireland',
                  'IM' => 'Isle Of Man',
                  'IL' => 'Israel',
                  'IT' => 'Italy',
                  'JM' => 'Jamaica',
                  'JP' => 'Japan',
                  'JE' => 'Jersey',
                  'JO' => 'Jordan',
                  'KZ' => 'Kazakhstan',
                  'KE' => 'Kenya',
                  'KI' => 'Kiribati',
                  'KR' => 'Korea',
                  'KW' => 'Kuwait',
                  'KG' => 'Kyrgyzstan',
                  'LA' => 'Lao People\'s Democratic Republic',
                  'LV' => 'Latvia',
                  'LB' => 'Lebanon',
                  'LS' => 'Lesotho',
                  'LR' => 'Liberia',
                  'LY' => 'Libyan Arab Jamahiriya',
                  'LI' => 'Liechtenstein',
                  'LT' => 'Lithuania',
                  'LU' => 'Luxembourg',
                  'MO' => 'Macao',
                  'MK' => 'Macedonia',
                  'MG' => 'Madagascar',
                  'MW' => 'Malawi',
                  'MY' => 'Malaysia',
                  'MV' => 'Maldives',
                  'ML' => 'Mali',
                  'MT' => 'Malta',
                  'MH' => 'Marshall Islands',
                  'MQ' => 'Martinique',
                  'MR' => 'Mauritania',
                  'MU' => 'Mauritius',
                  'YT' => 'Mayotte',
                  'MX' => 'Mexico',
                  'FM' => 'Micronesia, Federated States Of',
                  'MD' => 'Moldova',
                  'MC' => 'Monaco',
                  'MN' => 'Mongolia',
                  'ME' => 'Montenegro',
                  'MS' => 'Montserrat',
                  'MA' => 'Morocco',
                  'MZ' => 'Mozambique',
                  'MM' => 'Myanmar',
                  'NA' => 'Namibia',
                  'NR' => 'Nauru',
                  'NP' => 'Nepal',
                  'NL' => 'Netherlands',
                  'AN' => 'Netherlands Antilles',
                  'NC' => 'New Caledonia',
                  'NZ' => 'New Zealand',
                  'NI' => 'Nicaragua',
                  'NE' => 'Niger',
                  'NG' => 'Nigeria',
                  'NU' => 'Niue',
                  'NF' => 'Norfolk Island',
                  'MP' => 'Northern Mariana Islands',
                  'NO' => 'Norway',
                  'OM' => 'Oman',
                  'PK' => 'Pakistan',
                  'PW' => 'Palau',
                  'PS' => 'Palestinian Territory, Occupied',
                  'PA' => 'Panama',
                  'PG' => 'Papua New Guinea',
                  'PY' => 'Paraguay',
                  'PE' => 'Peru',
                  'PH' => 'Philippines',
                  'PN' => 'Pitcairn',
                  'PL' => 'Poland',
                  'PT' => 'Portugal',
                  'PR' => 'Puerto Rico',
                  'QA' => 'Qatar',
                  'RE' => 'Reunion',
                  'RO' => 'Romania',
                  'RU' => 'Russian Federation',
                  'RW' => 'Rwanda',
                  'BL' => 'Saint Barthelemy',
                  'SH' => 'Saint Helena',
                  'KN' => 'Saint Kitts And Nevis',
                  'LC' => 'Saint Lucia',
                  'MF' => 'Saint Martin',
                  'PM' => 'Saint Pierre And Miquelon',
                  'VC' => 'Saint Vincent And Grenadines',
                  'WS' => 'Samoa',
                  'SM' => 'San Marino',
                  'ST' => 'Sao Tome And Principe',
                  'SA' => 'Saudi Arabia',
                  'SN' => 'Senegal',
                  'RS' => 'Serbia',
                  'SC' => 'Seychelles',
                  'SL' => 'Sierra Leone',
                  'SG' => 'Singapore',
                  'SK' => 'Slovakia',
                  'SI' => 'Slovenia',
                  'SB' => 'Solomon Islands',
                  'SO' => 'Somalia',
                  'ZA' => 'South Africa',
                  'GS' => 'South Georgia And Sandwich Isl.',
                  'ES' => 'Spain',
                  'LK' => 'Sri Lanka',
                  'SD' => 'Sudan',
                  'SR' => 'Suriname',
                  'SJ' => 'Svalbard And Jan Mayen',
                  'SZ' => 'Swaziland',
                  'SE' => 'Sweden',
                  'CH' => 'Switzerland',
                  'SY' => 'Syrian Arab Republic',
                  'TW' => 'Taiwan',
                  'TJ' => 'Tajikistan',
                  'TZ' => 'Tanzania',
                  'TH' => 'Thailand',
                  'TL' => 'Timor-Leste',
                  'TG' => 'Togo',
                  'TK' => 'Tokelau',
                  'TO' => 'Tonga',
                  'TT' => 'Trinidad And Tobago',
                  'TN' => 'Tunisia',
                  'TR' => 'Turkey',
                  'TM' => 'Turkmenistan',
                  'TC' => 'Turks And Caicos Islands',
                  'TV' => 'Tuvalu',
                  'UG' => 'Uganda',
                  'UA' => 'Ukraine',
                  'AE' => 'United Arab Emirates',
                  'GB' => 'United Kingdom',
                  'US' => 'United States',
                  'UM' => 'United States Outlying Islands',
                  'UY' => 'Uruguay',
                  'UZ' => 'Uzbekistan',
                  'VU' => 'Vanuatu',
                  'VE' => 'Venezuela',
                  'VN' => 'Viet Nam',
                  'VG' => 'Virgin Islands, British',
                  'VI' => 'Virgin Islands, U.S.',
                  'WF' => 'Wallis And Futuna',
                  'EH' => 'Western Sahara',
                  'YE' => 'Yemen',
                  'ZM' => 'Zambia',
                  'ZW' => 'Zimbabwe',
              ); // Every countries list.
        
            foreach ($countries as $code => $country_name) {
                  if($selected_country === $code){
                      $selected = 'selected="selected"';
                      $options .= '<option value="' . $code . '" ' . $selected . ' >'. $code . ' ( '. $country_name.' )</option>';
                  } else {
                      $options .= '<option value="' . $code . '" >'. $code . ' ( '. $country_name.' )</option>';
                  }
            }
            return $options;
      }
      public function AddCity($countryid,$city) {
		$db = Database::getInstance(); // getting instance of the database.
		$c = $db->getc();
		$cog = new Cog(); // getting instance of cog class.
		$countryid = $cog->sql_prep($countryid);
		$city = $cog->sql_prep($city);
		$id = uniqid(); // setting a unique id.
		$adc = $c->query("SELECT * FROM cities WHERE name = '$city' AND country_id = '$countryid'"); // getting cities table data when the city name and country id is the same with the fields provided. 
		if(@$adc->num_rows == 0) { // checking if the table is empty so that country can't be added twice
			if($c->query("INSERT INTO cities (city_id,name,country_id)VALUES('$id','$city','$countryid')")){ // inserting the country.
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
}