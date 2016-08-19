<?php

/**
 * MyStyle_Pager class. 
 * 
 * The MyStyle_Pager class is used for controlling a paged interface.
 *
 * @package MyStyle
 * @since 1.4.4
 * @todo Add unit testing
 */
class MyStyle_Pager {
    
    /**
     * An array of items for the current page.
     * @var array
     */
    private $items;
    
    /**
     * The start index or offset.
     * @var int 
     */
    private $start;
    
    /**
     * The total number of items in the collection (across all pages).
     * @var int 
     */
    private $total_item_count;
    
    /**
     * The number of results to return per page.
     * @var int 
     */
    private $items_per_page;
    
    /**
     * The current page number.
     * @var int 
     */
    private $current_page_number;
    
    /**
     * The total number of available pages.
     * @var int 
     */
    private $page_count;
    
    /**
     * Constructor
     */
    public function __construct( ) {
        //
    }
    
    /**
     * Sets the items for the current page.
     * @param array $items The items for the current page.
     */
    public function set_items( $items ) {
        $this->items = $items;
    }
    
    /**
     * Gets an array of items for the current page.
     * @return array Returns an array of items for the current page. The array
     * elements can be of any type
     */
    public function get_items() {
        return $this->items;
    }
    
    /**
     * Gets the start index/offset for the pager.
     * @return int Returns the start index/offset for the pager.
     */
    public function get_start() {
        $start = 0;
        if( $this->current_page_number > 1 ) {
            $start = ( $this->current_page_number - 1 ) * $this->items_per_page; 
        }
        
        $this->start = $start;
        
        return $this->start;
    }
    
    /**
     * Sets the total item count (across all pages).
     * @param int $total_item_count The total item count (across all pages).
     */
    public function set_total_item_count( $total_item_count ) {
        $this->total_item_count = $total_item_count;
    }
    
    /**
     * Gets the total item count (across all pages).
     * @return int Returns the total item count (across all pages).
     */
    public function get_total_item_count() {
        return $this->total_item_count;
    }
    
    /**
     * Sets the number of items per page.
     * @param int $items_per_page The number of items per page.
     */
    public function set_items_per_page( $items_per_page ) {
        $this->items_per_page = $items_per_page;
    }
    
    /**
     * Gets the number of items per page.
     * @return int Returns the number of items per page.
     */
    public function get_items_per_page() {
        return $this->items_per_page;
    }
    
    /**
     * Sets the number of items per page.
     * @param int $current_page_number The number of items per page.
     */
    public function set_current_page_number( $current_page_number ) {
        $this->current_page_number = $current_page_number;
    }
    
    /**
     * Gets the current page number.
     * @return int Returns current page number.
     */
    public function get_current_page_number() {
        return $this->current_page_number;
    }
    
    /**
     * Gets the total number of available pages.
     * @return int Returns the total number of available pages.
     */
    public function get_page_count() {
        $this->page_count = ceil( $this->total_item_count / $this->items_per_page );
        
        return $this->page_count;
    }
    
    /**
     * Looks at the current pager variables to determine if the page is valid.
     * @throws MyStyle_Not_Found_Exception
     */
    public function validate() {
        if( $this->current_page_number > $this->get_page_count() ) {
            throw new MyStyle_Not_Found_Exception( 'Page not found.' );
        }
    }

}
