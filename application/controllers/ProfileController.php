<?php

class ProfileController extends BaseController
{

    protected $userId;

    public function profileAction()
    {
        $userId = $this->getParams('user');
        if ($userId) {
            $this->userId = $userId;
        } else {
            $this->userId = $_SESSION['userId'];
        }
        $data = $this->getModel()->getProfile($this->userId);
        $this->view('content/profile', $data);
    }

    public function editProfileAction()
    {
        $post['user'] = $this->getPost([
                        'login',
                        'email',
                        'old-password',
                        'new-password',
                        ]);

        $post['profile'] = $this->getPost([
                        'firstname',
                        'lastname',
                        'phone',
                        'skype'
                        ]);


        $this->userId = $_SESSION['userId'];
        $users = new User();
        $profile = $this->getModel()->getProfile($this->userId);
        $user = $users->getBy('id', $this->userId);

        $data['user'] = $user;
        $data['profile'] = $profile;

        if (!empty($post['user']) && !empty($post['profile'])){
            $validateProfile = $this->getModel()->validate($post['profile']);
            if ($validateProfile==true){
                $userSave = $users->update($post['user']);
                if ($userSave!==true){
                    var_dump($userSave);
                } elseif ($userSave==true){
                    $this->getModel()->update($post['profile'], $data['profile']['id']);
                    echo 'Save changes';
                }
            } else {
                var_dump($validateProfile);
            }
        }

        if ($post['user']==false || $post['profile']==false){
            $this->view('content/editProfile', $data);
        }
    }
} 