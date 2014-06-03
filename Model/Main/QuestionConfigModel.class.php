<?php

class mainQuesionConfigModel extends basic {

    public function __construct($id = null) {

        $this->child_name = 'question_config';

        parent::__construct();

        if ($id) {
            $obj['question_id'] = $id;
            $this->initialize($obj);
        }
    }
}

?>