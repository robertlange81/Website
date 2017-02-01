<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Validation\Validator;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class EmailController extends AppController
{
    public function send()
    {
        if( $this->request->is('ajax') ) {
            $this->autoRender = false;
        }

        if ($this->request->isPost()) {

            // get values here 
            echo $this->request->data['email'] . 'blub';
            echo $this->request->data['text']; 
            
            $validator = new Validator();
            $validator
                ->requirePresence('email')
                ->add('email', 'validFormat', [
                    'rule' => 'email',
                    'message' => 'E-mail must be valid'
                ])
                ->requirePresence('name')
                ->notEmpty('name', 'We need your name.')
                ->requirePresence('comment')
                ->notEmpty('comment', 'You need to give a comment.');

            $errors = $validator->errors($this->request->data());
            if (empty($errors)) {
                // Send an email.
            }        
        }
    }
}
