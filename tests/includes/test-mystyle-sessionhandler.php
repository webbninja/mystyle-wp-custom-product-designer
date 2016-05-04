<?php

/**
 * The MyStyleSessionHandlerTest class includes tests for testing the 
 * MyStyle_SessionHandler
 * class.
 *
 * @package MyStyle
 * @since 1.3.0
 */
class MyStyleSessionHandlerTest extends WP_UnitTestCase {
    
    /**
     * Overrwrite the setUp function so that our custom tables will be persisted
     * to the test database.
     */
    function setUp() {
        // Perform the actual task according to parent class.
        parent::setUp();
        // Remove filters that will create temporary tables. So that permanent tables will be created.
        remove_filter( 'query', array( $this, '_create_temporary_tables' ) );
        remove_filter( 'query', array( $this, '_drop_temporary_tables' ) );
        
        //Create the tables
        MyStyle_Install::create_tables();
    }
    
    /**
     * Overrwrite the tearDown function to remove our custom tables.
     */
    function tearDown() {
        global $wpdb;
        // Perform the actual task according to parent class.
        parent::tearDown();
        
        //Drop the tables that we created
        $wpdb->query("DROP TABLE IF EXISTS " . MyStyle_Design::get_table_name());
        $wpdb->query("DROP TABLE IF EXISTS " . MyStyle_Session::get_table_name());
        
    }
    
    /**
     * Test the get function.
     * @global wpdb $wpdb
     */
    function test_get_generates_new_session_if_one_doesnt_exist() {
        
        //Set the session variable
        if(session_id() == '') {
            session_start();
        }
        
        //Assert that the $_SESSION variable isn't set
        unset( $_SESSION[MyStyle_Session::$SESSION_KEY] );
        $this->assertFalse( isset( $_SESSION[MyStyle_Session::$SESSION_KEY] ) );
        
        //Call the function
        $returned_session = MyStyle_SessionHandler::get();
        
        //Assert that the session_id is set
        $this->assertNotNull( $returned_session->get_session_id() );
        
        //Assert taht the $_SESSION variable is now set
        $this->assertTrue( isset( $_SESSION[MyStyle_Session::$SESSION_KEY] ) );
    }
    
    
    /**
     * Test the get function.
     * @global wpdb $wpdb
     */
    function test_get_returns_existing_persisted_session() {
        global $wpdb;
        
        $session_id = 'testsession';
        
        //Create and persist the session
        $session = MyStyle_Session::create( $session_id );
        MyStyle_SessionManager::persist( $session );
        
        //Set the session variable
        if(session_id() == '') {
            session_start();
        }
        $_SESSION[MyStyle_Session::$SESSION_KEY] = $session;
        
        //Call the function
        $returned_session = MyStyle_SessionHandler::get();
        
        //Assert that the session_id is set
        $this->assertEquals( $session_id, $returned_session->get_session_id() );
    }

}