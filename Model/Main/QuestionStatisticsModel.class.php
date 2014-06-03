<?php

class mainQuestionStatisticsModel extends basic {

    public function __construct() {

        $this->child_name = 'question_statistics';

        parent::__construct();
    }

    public function get_info($id,$data) {

        $this->initialize('question_id = '.$id);

        if ($this->vars_number > 0) {

            $this->update($data);
            
        } else{

            $data['question_id'] = $id;

            $this->insert($data);
        }
    }

}

?>