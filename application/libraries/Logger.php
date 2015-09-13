<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Logger Class
 *
 * Advanced logger to write log with custom message, zip all older versions and send email
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Florian GUERIN
 * @link			http://timoagency.fr
 */

 class Logger{

 	/**
	 * Default CodeIgniter handler
	 *
	 * @var handler
	 */
 	private 		$_ci;

 	/**
	 * Default log directory
	 *
	 * @var string
	 */
 	private 		$_log_directory 	=		"./application/logs/";

 	/**
	 * Default log extension
	 *
	 * @var string
	 */
 	private 		$_log_extention		=		"log";

 	/**
	 * Default log separator
	 *
	 * @var string
	 */
 	private 		$_log_separator		=		"\r\n";

 	/**
	 * Default log date format
	 *
	 * @var string
	 */
 	private 		$_log_format		=		"Y-m-d H:i:s";

 	/**
	 * Default log style
	 *
	 * @var string
	 */
 	private 		$_log_style			=		" --> ";

 	/**
	 * Default log web viewer status
	 *
	 * @var string
	 */
 	private 		$_log_web_viewer	=		true;


 	// --------------------------------------------------------------------


 	/**
	 * Class constructor
	 *
	 * @return void
	 * @param array all configuration datas
	 */

 	public function __construct( $config = array() )
    {
    	$this->_ci = & get_instance();

    	if ( $config[ "log_directory" ] != null )
        	$this->_log_directory = $config[ "log_directory" ];
        if ( $config[ "log_directory" ] != null )
        	$this->_log_extension = $config[ "log_file_extension" ];
        if ( $config[ "log_directory" ] != null )
        	$this->_log_separator = $config[ "log_file_separator" ];
        if ( $config[ "log_directory" ] != null )
       		$this->_log_format = $config[ "log_date_format" ];
       	if ( $config[ "log_directory" ] != null )
        	$this->_log_style = $config[ "log_style" ];
        if ( is_bool( $config[ "log_web_viewer" ] ) )
        	$this->_log_web_viewer = $config[ "log_web_viewer" ];

        log_message('info', 'Logger Class Initialized');
    }

    /**
	 * Write Log File
	 *
	 * This function write into the file log 
	 *
	 * @param	string	the name of the log file
	 * @param	string	the error level like 'error', 'debug' or 'info' but custom ones like 'test', 'frequence' etc...
	 * @param	string	the error message 
	 * @return	bool
	 */
    public function write( $name, $level, $message )
    {

    	$name = $name . "-" . date( "Y-m-d" );
    	$file = $this->_log_directory . $name . "." . $this->_log_extention;

    	$content = strtoupper( $level ) . " - " . date( $this->_log_format ) . $this->_log_style . $message . $this->_log_separator;

    	file_put_contents( $file, $content, FILE_APPEND );

    	$this->zip();

    	return true;

    }

    /**
	 * Zip the older log file
	 *
	 * This function will compress all older log files into zip and delete the .log
	 *
	 * @return	void
	 */
    public function zip()
    {

    	$this->_ci->load->library( 'zip' );

    	$files = get_filenames( $this->_log_directory );

    	foreach ( $files as $f )
    	{
    		if ( $f == "index.html" || strstr( $f, ".zip" ) != false )
    			continue;

    		$name = str_replace( "." . $this->_log_extention, "", $f );
    		$date = substr( $name, count( $name ) - 11 );
    		if ( strtotime( $date ) < strtotime( date( "Y-m-d" ) ) )
    		{
				$data = read_file( $this->_log_directory . $f );

				$this->_ci->zip->add_data( $f, $data );
				$this->_ci->zip->archive( $this->_log_directory . $name . '.zip');

				unlink( $this->_log_directory . $f );
    		}
    	}

    }

    /**
	 * get log_separator
	 *
	 * This function return the value of the log separator
	 *
	 * @return	string
	 */
    public function get_log_separator()
    {
    	return $this->_log_separator;
    }

    /**
	 * get log_directory
	 *
	 * This function return the value of the log directory
	 *
	 * @return	string
	 */
    public function get_log_directory()
    {
    	return $this->_log_directory;
    }

    /**
	 * get log_extension
	 *
	 * This function return the value of the log extension
	 *
	 * @return	string
	 */
    public function get_log_extension()
    {
    	return $this->_log_extension;
    }

    /**
	 * get log_format
	 *
	 * This function return the value of the log format
	 *
	 * @return	string
	 */
    public function get_log_format()
    {
    	return $this->_log_format;
    }

    /**
	 * get log_style
	 *
	 * This function return the value of the log style
	 *
	 * @return	string
	 */
    public function get_log_style()
    {
    	return $this->_log_style;
    }

    /**
	 * get log_style
	 *
	 * This function return the value of the log style
	 *
	 * @return	string
	 */
    public function get_log_web_viewer()
    {
    	return $this->_log_web_viewer;
    }

 }