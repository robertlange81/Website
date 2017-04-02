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
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class EmailController extends AppController
{
    public function sendContact()
    {
        if( $this->request->is('ajax') ) {
            $this->autoRender = false;
        }

        if ($this->request->isPost()) {
           
            $validator = new Validator();
            $validator
                ->requirePresence('email')
                ->notEmpty('email', 'Bitte geben Sie eine gültige Email-Adresse an.')
                ->add('email', 'validFormat', [
                    'rule' => 'email',
                    'message' => 'Bitte geben Sie gültige eine Email-Adresse an.'
                ])
                ->requirePresence('name')
                ->notEmpty('name', 'Bitte geben Sie Ihren Namen an.')
                ->requirePresence('text')
                ->notEmpty('text', 'Bitte geben Sie eine Nachricht ein.');

            $errors = $validator->errors($this->request->data());
            if (empty($errors)) {
                try {
                    $email = new Email('default');
                    $email->from(['info@standard80.de' => $this->request->data['email']])
                        ->to('robert.lange.81@gmail.com')
                        ->subject('Neue Kontaktanfrage' . $this->request->data['name'])
                        ->send('von: ' . $this->request->data['name'] . ', Nachricht: ' . $this->request->data['text']);    

                    echo json_encode(['msg' => 'Ihre Nachricht wurde erfolgreich versendet.', 'success' => true]);
                } catch (Exception $ex) {
                    echo json_encode(['msg' => $ex,'status'=>500]);
                }
            } else {
                $response = [];
                foreach ($errors as $model => $modelErrors) {
                  foreach ($modelErrors as $field => $error) {
                    $response['msg'] .= $error . ' ';
                  }
                }
                $response['success'] = false;
                echo json_encode($response);
            }        
        }
    }
}
