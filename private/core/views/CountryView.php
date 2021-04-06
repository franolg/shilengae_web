<?php

/**
 * 
 */
class CountryView extends Country {
	public $api;

	function __construct($api = 1) {
		$this->api = $api;
	}

	public function Countries() {
		$exe = $this->ListAll();
		if ($this->api) { // checking if the request is from the api or not
			if(!empty($exe)) { // checking if the table is not empty
			    $country = array();
			    $id = 0;
			    foreach($exe as $con) {
			        $country[$id] = $con['country'];
			    	$id++;
			    }
				return array(
					'success' => 1,
					'statuscode' => 200,
					'list' => $this->TCountries(),
					'msg' => "Result found.",
					'country' => $country,
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
			if(!empty($exe)) {
				return $exe['country'];
			}else {
				return "No Result";
			}
		}
	}
	public function CountryEmpty() {
		$exe = $this->ListAll();
		if(empty($exe)) {
			return true;
		}else {
			return false;
		}
	}
	public function CountryShowToggle() {
		return $this->Ctoggler();
	} 
	public function DBCountry() {
		$exes = $this->ListAll();
		$counter = 0;
		if(!empty($exes)) {
			foreach ($exes as $exe) {
				?>
				<tr>
	                <td class="text-center"><?php echo ++$counter?></td>
	                <td><?php echo $exe['country'] ?></td>
	                <td><?php echo $exe['short'] ?></td>
	                <td><?php echo $exe['status'] ? "ON" : "OFF"; ?></td>
	                <td class="td-actions text-right">
	                    <a href="editcountry?q=<?php echo $exe['country_id'] ?>" class="btn btn-success">
	                        <i class="material-icons">edit</i>
	                    </a>
	                    <a href="country?q=<?php echo $exe['country_id'] ?>" class="btn btn-danger">
	                        <i class="material-icons">close</i>
	                    </a>
	                </td>
	            </tr>	
				<?php
			}
		}else {
			?><tr><td>No Result</td></tr><?php
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
      	              $options .= '<option value="' . $code . '" ' . $selected . ' >'.$country_name.'</option>';
      	          } else {
      	              $options .= '<option value="' . $code . '" >'.$country_name.'</option>';
      	          }
      	    }
      	    return $options;
      	}
	public function checkCountryID($id) {
		return $this->isCountryID($id);
	}
	public function showCountry($id,$request) {
		return $this->show($id,$request);
	}
}