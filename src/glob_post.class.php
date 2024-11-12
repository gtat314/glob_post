<?php




class SecurityException extends Exception{};




/**
 * 
 */
class glob_post {

    /**
     * @var array
     */
    private $fields = [];




    /**
     * @param array $fields
     * @throws SecurityException
     * @return glob_post
     */
    public function __construct( Array $fields ) {

        for ( $i = 0 ; $i < count( $fields ) ; $i++ ) {

            if ( isset( $_POST[ $fields[ $i ] ] ) === false ) {

                throw new SecurityException( 'Mandatory Field' );

            } else {

                $this->fields[ $fields[ $i ] ] = $_POST[ $fields[ $i ] ];

            }

        }

    }

    /**
     * @param string $field
     * @return string
     */
    public function get( $field ) {

        return filter_input( INPUT_POST, $field, FILTER_DEFAULT );

    }

    /**
     * @param string $field
     * @return string
     */
    public function isValidEmail( $field ) {

        return filter_var( $this->fields[ $field ], FILTER_VALIDATE_EMAIL );

    }


    

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateEmail( $varName ) {

        $valueDetected = filter_var( $this->fields[ $varName ], FILTER_VALIDATE_EMAIL );

        if ( $valueDetected === false ) {

            throw new SecurityException( 'Not a valid email' );
            return false;

        } else {

            return true;

        }

    }

    /**
     * @param string $varName
     * @param array $acceptable
     * @throws SecurityException
     * @return boolean
     */
    public function validateAcceptable( $varName, Array $acceptable ) {

        $valueDetected = filter_var( $this->fields[ $varName ], FILTER_DEFAULT );

        if ( in_array( $valueDetected, $acceptable ) ) {

            return true;

        } else {

            throw new SecurityException( 'Not in acceptable range' );
            return false;

        }

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateInt( $varName ) {

        $return = filter_input( INPUT_POST, $varName, FILTER_VALIDATE_INT );

        if ( $return === null ) {

            throw new SecurityException( 'Not a valid integer' );
            return false;

        } else if ( $return === false ) {

            throw new SecurityException( 'Not a valid integer' );
            return false;

        } else {

            return true;

        }

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateIp( $varName ) {

        $return = filter_input( INPUT_POST, $varName, FILTER_VALIDATE_IP );

        if ( $return === null ) {

            throw new SecurityException( 'Not a valid integer' );
            return false;

        } else if ( $return === false ) {

            throw new SecurityException( 'Not a valid integer' );
            return false;

        } else {

            return true;

        }

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateFloat( $varName ) {

        $return = filter_input( INPUT_POST, $varName, FILTER_VALIDATE_FLOAT );

        if ( $return === null ) {

            throw new SecurityException( 'Not a valid float' );
            return false;

        } else if ( $return === false ) {

            throw new SecurityException( 'Not a valid float' );
            return false;

        } else {

            return true;

        }

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateAfm( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( ctype_xdigit( $valueDetected ) === true && strlen( $valueDetected ) === 9 ) {

            return true;

        } else {

            throw new SecurityException( 'Not a valid afm' );
            return false;

        }

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateFilename( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        $fileData = explode( '.', $valueDetected );

        if ( count( $fileData ) !== 2 ) {

            throw new SecurityException( 'Not a valid filename', 1001 );
            return false;

        }

        if ( strlen( $fileData[ 0 ] ) !== 40 ) {

            throw new SecurityException( 'Not a valid filename', 1002 );
            return false;

        }

        if ( ctype_xdigit( $fileData[ 0 ] ) !== true ) {

            throw new SecurityException( 'Not a valid filename', 1003 );
            return false;

        }

        return true;

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validatePrimaryKey( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_VALIDATE_INT );

        if ( $valueDetected === null || $valueDetected === false || $valueDetected === 0 ) {

            throw new SecurityException( 'Not a valid mysql primary key', 1001 );
            return false;

        }

        return true;

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateNumeric( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( is_numeric( $valueDetected ) === false ) {

            throw new SecurityException( 'Not a numerice value', 1004 );
            return false;

        }

        return true;

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validatePriceStrict( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( $valueDetected === "null" || $valueDetected === 'NULL' || $valueDetected === null ) {

            return true;

        }

        $result = preg_match( '/\d+\.\d\d/', $valueDetected, $output );

        if ( $result !== 1 ) {

            throw new SecurityException( 'Not a valid strict price' );
            return false;

        }

        return true;

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateNotEmptyString( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( $valueDetected === "null" || $valueDetected === 'NULL' || $valueDetected === null || $valueDetected === "" ) {

            throw new SecurityException( 'Not a valid not empty string' );
            return false;

        }

        return true;

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateMd5( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( strlen( $valueDetected ) == 32 && ctype_xdigit( $valueDetected ) === true ) {

            return true;

        } else {

            throw new SecurityException( 'Not a valid md5' );
            return false;

        }

    }

    /**
     * @param string $varName
     * @throws SecurityException
     * @return boolean
     */
    public function validateJson( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        $result = json_decode( $valueDetected );

        if ( $result === null ) {

            throw new SecurityException( 'Not a valid json' );
            return false;

        } else {

            return true;

        }

    }

    /**
     * @param mixed $varName
     * @param mixed $valueExpected
     * @throws SecurityException
     * @return boolean
     */
    public function validateStrictValue( $varName, $valueExpected ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( $valueDetected === $valueExpected ) {

            return true;

        } else {

            throw new SecurityException( 'Invalid expected value' );
            return false;

        }

    }




    /**
     * @param string|int $varName
     * @return int
     */
    public function filterInt( $varName ) {

        $return = filter_input( INPUT_POST, $varName, FILTER_VALIDATE_INT );

        if ( $return === null ) {

            return false;

        } else if ( $return === false ) {

            return false;

        } else {

            return intval( $return );

        }

    }

    /**
     * @param string|int $varName
     * @return int
     */
    public function filterFloat( $varName ) {

        $return = filter_input( INPUT_POST, $varName, FILTER_VALIDATE_FLOAT );

        if ( $return === null ) {

            return false;

        } else if ( $return === false ) {

            return false;

        } else {

            return floatval( $return );

        }

    }

    /**
     * @param string $varName
     * @return string|null
     */
    public function filterVarchar( $varName ) {

        $return = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( $return !== null ) {

            $return = trim( $return );

        }

        if ( $return !== null ) {

            $return = strip_tags( $return );

        }

        if ( $return === "null" || $return === 'NULL' || $return === null || $return === "" ) {

            $return = null;
            
        }

        return $return;

    }

    /**
     * @param string $varName
     * @return string|null
     */
    public function filterIp( $varName ) {

        $return = filter_input( INPUT_POST, $varName, FILTER_VALIDATE_IP );

        if ( $return === null ) {

            return null;

        } else if ( $return === false ) {

            return null;

        } else {

            return $return;

        }

    }

    /**
     * @param string $varName
     * @return float|null
     */
    public function filterPriceStrict( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( $valueDetected === "null" || $valueDetected === 'NULL' || $valueDetected === null ) {

            return null;

        }

        $result = preg_match( '/\d+\.\d\d/', $valueDetected, $output );

        if ( $result !== 1 ) {

            return null;

        } else {

            return floatval( $valueDetected );

        }

    }

    /**
     * @param string $varName
     * @param boolean|null $associative
     * @return mixed|null
     */
    public function filterJson( $varName, $associative = null ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        $result = json_decode( $valueDetected, $associative );

        if ( $result === null ) {

            return null;

        } else {

            return $result;

        }

    }

    /**
     * @param string $varName
     * @return string|null
     */
    public function filterMd5( $varName ) {

        $valueDetected = filter_input( INPUT_POST, $varName, FILTER_DEFAULT );

        if ( strlen( $valueDetected ) == 32 && ctype_xdigit( $valueDetected ) === true ) {

            return $valueDetected;

        } else {

            return null;

        }

    }

    /**
     * @param string $varName
     * @return string|null
     */
    public function filterEmail( $varName ) {

        $valueDetected = filter_var( $this->fields[ $varName ], FILTER_VALIDATE_EMAIL );

        if ( $valueDetected === false ) {

            return null;

        } else {

            return $valueDetected;

        }

    }

}