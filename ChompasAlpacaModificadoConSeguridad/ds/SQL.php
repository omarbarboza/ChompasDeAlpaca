<?php


class SQL {

        private $_query;
        private $_type;
        
        function __construct($_query, $_type) {
            $this->_query = $_query;
            $this->_type = $_type;
        }
        public function get_query() {
            return $this->_query;
        }

        public function get_type() {
            return $this->_type;
        }

        
        public function __toString() {
            
            return $this->get_query();
        }



    
}

?>
