<?php

namespace KingLoui\BaseKitUkUsers\Controller\Traits;

trait LoginTrait
{

    public function login()
    {
        if ($this->request->is('post')) 
        {
            // Check if user is already logged in
            if ($this->Auth->user()) {
                $this->Flash->error(__('You are already logged in'));
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
                    $login = true;
                else {
                    // check if user has correct role
                    if (    in_array('Student', $user['eduPersonAffiliation']) 
                        ||  in_array('Staff', $user['eduPersonAffiliation'])) {
                        // check if useraccount is not secondary
                        if(!in_array('Sekundäraccount', $user['workforceID']))
                            // authed
                            $login = true;
                        else
                            $this->Flash->error(__('Sie können sich nur mit ihrem Primäraccount anmelden.'));
                    } else
                        $this->Flash->error(__('Nur Studenten und Mitarbeiter haben die Möglichkeit sich einen Account auszuleihen.'));
                }
            } else
                $this->Flash->error(__('Benutzername oder Passwort falsch, bitte versuchen Sie es erneut!'));

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
        $this->Flash->success(__('You\'ve successfully logged out'));

        $eventAfter = $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_LOGOUT);
        if (is_array($eventAfter->result)) {
            return $this->redirect($eventAfter->result);
        }

        return $this->redirect($this->Auth->logout());
    }

}