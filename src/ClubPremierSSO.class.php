<?php

/**
 * ClubPremier SSO
 *
 * Object to communicate with the SSO Standpoint of Club Premier
 *
 */

    /**
     * Object to communicate with the SSO Standpoint of Club Premier
     *
     * @package ClubPremierSSO
     * @subpackage Classes
     * @category Session
     * @version v1.0
     */
    class ClubPremierSSO
    {

        /**
         * Member name
         * @var string
         */
        private $member_firts_name;

        /**
         * Member email address
         * @var string
         */
        private $member_email_address;

        /**
         * Member email address
         * @var string
         */
        private $member_person_id;

        /**
         * Account number
         * @var int
         */
        private $account;

        /**
         * Expiration session
         * @var double
         */
        private $expiration;

        /**
         * Signature
         * @var string
         */
        private $signature;

        /**
         * Clubpremir session token
         * @var string
         */
        private $token;

        /**
         *
         * @var string
         */
        private $balance;

        /**
         * Cards codes SA = santander, AM = american express and BA = Banamex.
         * @var array String array
         */
        private $cards;

        /**
         * Insuranced option for Menu in cookie 9
         * @var boolean
         */
        private $insuranced;

        /**
         * Cookie session sso_club_premier.
         *
         * The cookie is comma separated data corresponding in position.
         * Account number position 0, expiration position 1, signature position 2,
         * token position 3, member name position 4, balance position 5,
         * member email address position 6, member_person_id position 7, cards position 8, insuranced position 9.
         *
         * @var string
         */
        private $cookie;

        /**
         * Cards codes AM = santander, AM = american express and BA = Banamex.
         * @var string
         */
        private $access_level;

        /**
         * Get member first name
         * @return String null if does not exist
         */
        public function get_member_first_name() {
            return $this->member_firts_name;
        }

        /**
         * Get account value
         * @return String null if does not exist
         */
        public function get_account() {
            return $this->account;
        }

        /**
         * Get expiration value
         * @return String null if does not exist
         */
        public function get_expiration() {
            return $this->expiration;
        }

        /**
         * Get signature value
         * @return String null if does not exist
         */
        public function get_signature() {
            return $this->signature;
        }

        /**
         * Get token value
         * @return String null if does not exist
         */
        public function get_token() {
            return $this->token;
        }

        /**
         * Get balance value
         * @return String null if does not exist
         */
        public function get_balance() {
            return $this->balance;
        }

        /**
         * Get member email address value
         * @return String null if does not exist
         */
        public function get_member_email_address()
        {
            return $this->member_email_address;
        }

        /**
         * Get member email address value
         * @return String null if does not exist
         */
        public function get_member_person_id()
        {
            return $this->member_person_id;
        }

        /**
         * Get cards value
         * @return String null if does not exist
         */
        public function get_cards() {
            return $this->cards;
        }

        /**
         * Get insuranced value
         * @return boolean false not show menu
         */
        public function get_insuranced() {
            return $this->insuranced;
        }

        /**
         * Get cookie value
         * @return String null if does not exist
         */
        public function get_cookie() {
            return $this->cookie;
        }

        /**
         * Get access level value
         * @return String null if does not exist
         */
        public function get_access_level() {
            return $this->access_level;
        }

        /**
         * Create session clubpremier.
         */
        public function __construct() {
            $this->cookie = $this->decode_cookie();
            if ( !empty($this->cookie) ) {
                $explode_cookie = explode( ",", $this->cookie );
                $this->account = $explode_cookie[0];
                $this->expiration = $explode_cookie[1];
                $this->signature = $explode_cookie[2];
                $this->token = $explode_cookie[3];
                $this->member_firts_name = $explode_cookie[4];
                $this->balance = $explode_cookie[5];
                $this->member_email_address = $explode_cookie[6];
                $this->member_person_id = $explode_cookie[7];
                $this->cards = explode( "-", $explode_cookie[8] );
                $this->insuranced = $explode_cookie[9] == "true" ? true : false;
                $this->access_level = 1;
            } else {
                $this->account = null;
                $this->expiration = null;
                $this->signature = null;
                $this->token = null;
                $this->member_firts_name = null;
                $this->balance = null;
                $this->member_email_address = null;
                $this->member_person_id = null;
                $this->cards = null;
                $this->insuranced = false;
                $this->access_level = 0;
            }
        }

        /**
         * Decode cookie
         * @return String Return string cookie decode or null if does not exist
         **/
        private function decode_cookie( $cookie_name='sso_club_premier' ){
            $cookie = null;

            foreach(explode('; ', $_SERVER['HTTP_COOKIE']) as $rawcookie){
                list($key,$value) = explode('=', $rawcookie, 2);
                if ( $key == $cookie_name) {
                    $secret_key = getenv('SECRET_KEY');
                    $cookie = mcrypt_decrypt(MCRYPT_DES, $secret_key, base64_decode($value), MCRYPT_MODE_ECB);
                    $cookie = htmlspecialchars($cookie);
                    break;
                }
            }
            return $cookie;
        }

        /**
         * Has card
         * @param String A string name card SA = santander, AM = american express and BA = Banamex.
         * @return boolean
         **/
        public function has_card( $name ) {
            $exist = false;
            foreach($this->cards as $value){
                # importan keep substr
                if( substr($value, 0, 2) ==  $name) {
                    $exist = true;
                    break;
                }
            }
            return $exist;
        }

        /**
         * Logout method
         **/
        public function logout(){
            $this->account = null;
            $this->expiration = null;
            $this->signature = null;
            $this->token = null;
            $this->member_firts_name = null;
            $this->balance = null;
            $this->member_email_address = null;
            $this->member_person_id = null;
            $this->cards = null;
            $this->insuranced = false;
            $this->access_level = 0;

        }
    }
$club_premier_sso = new ClubPremierSSO();
