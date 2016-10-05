<?php

namespace KingLoui\BaseKitUkUsers\Controller\Traits;

use CakeDC\Users\Controller\Component\UsersAuthComponent;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\Core\Configure;

trait LoginTrait
{
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('logout');
    }

    public function login()
    {
        if ($this->request->is('post')) 
        {
            // Check if user is already logged in
            if ($this->Auth->user()) {
                $this->Flash->error(__d('KingLoui/BaseKitUkUsers', 'You are already logged in'));
                return $this->redirect($this->Auth->redirectUrl());
            }


            $event = $this->dispatchEvent(UsersAuthComponent::EVENT_BEFORE_LOGIN);

            $login = false;

            //setup vars to determin login
            $user = $this->Auth->identify();
            $query = $this->Users->find('all')->where(['username' => $user['uid'][0]]);

            //
            // Check login
            //

            // check if logindata is correct
            if($user){
                // check if user has account
                if($query->count() == 1) 
                    // authed
                    if($query->first()->active == true)
                        $login = true;
                    else 
                        $this->Flash->error(__d('KingLoui/BaseKitUkUsers', 'Your account is set to inactive'));
                else {
                    $checker =  Configure::read('UkLdap.loginConstraintChecker');
                    if (isset($checker) && is_object($checker) && ($checker instanceof \Closure)) {
                        if($checker($user, $this))
                            $login = true;
                    } else {
                        $login = true;
                    }
                }
            } else
                $this->Flash->error(__d('KingLoui/BaseKitUkUsers', 'Username and/or password incorrect'));

            //
            // Perform Login
            //

            if($login) {
                // setup user database entity
                $dbuser = null;
                if($query->count() == 0) {
                    // setup new entry
                    $dbuser = $this->Users->newEntity();
                    $dbuser->role = 'user';
                    $dbuser->is_active = 1;
                } else {
                    // update entry
                    $dbuser = $query->first();
                }

                $dbuser->username = $user['uid'][0];
                $dbuser->email = $user['userPreferredEmail'][0];
                $dbuser->first_name = $user['givenName'][0];
                $dbuser->last_name = $user['sn'][0];
                
                // write/update database entry
                if($dbuser != null)
                    $result = $this->Users->save($dbuser);

                // add additional data from dbuser to session
                if(isset($result->id))
                    $lastinsertid = $result->id;
                $user['role'] = $dbuser->role;
                $user['is_superuser'] = $dbuser->is_superuser;
                $user['id'] = isset($user_id) ? $lastinsertid : $dbuser->id;

                // log the user in
                //$this->Auth->setUser($user);
                $this->Auth->setUser($dbuser->toArray());
                $event = $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_LOGIN);

                // redirect the user
                if($user['role'] == 'admin')
                    return $this->redirect('/admin');
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
    }

    public function logout()
    {
        $eventBefore = $this->dispatchEvent(UsersAuthComponent::EVENT_BEFORE_LOGOUT);
        if (is_array($eventBefore->result)) {
            return $this->redirect($eventBefore->result);
        }

        $this->request->session()->destroy();
        $this->Flash->success(__d('KingLoui/BaseKitUkUsers', 'You\'ve successfully logged out'));

        $eventAfter = $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_LOGOUT);
        if (is_array($eventAfter->result)) {
            return $this->redirect($eventAfter->result);
        }

        return $this->redirect($this->Auth->logout());
    }

}