<?php

    /**
     *
     */
    class CommentForm extends Form {
        protected $theme = '';

        /**
         *
         */
        protected function init() {
            $req    = new Required();
            $req2   = new Integer();
            $req3   = new Length(3);
            $url    = new Url();

            //$text    = new TextField("First name", array(), array($req));
            //$text    = new TextField("First name", array(), array($req, $req2));
            //$text    = new TextField("First name", array(), array($req, $req2, $req3));
            $text   = new TextField("First name");
            $text->setHelpText('Put your first name in here.');

            $hidden = new HiddenField('hidden field');
            $hidden->setValue('value');

            $this->addControl($text);
            $this->addControl(new TextField('Last name', array('a' => 'b'), array($req, $req2)));
            $this->addControl($hidden);

            $this->addControl(new MultipleChoiceField('Something else', array(1, 2, 3, 4)));
            $this->addControl(new MultipleChoiceField('Something else', array(1, 2, 3, 4)));

            $this->addControl(new SubmitField('Save'));
            //$this->addControl(new ButtonField('Button'));
        }

        public function submit() {
            var_dump($this->cleaned_data());
        }

        /**
         * Some extra information.
         */
        public function report() {
            echo '<hr />';
            if ($this->is_bound() && $this->getValid()) {
                echo '<h4>Submit handler:</h4>';
                $this->submit();
            }
            elseif ($this->has_errors()) {
                echo '<h4>Errors:</h4>';
                var_dump($this->get_errors());
            }
            else {
                echo '<p><em>The form has yet to be submitted.</em></p>';
            }
        }
    }