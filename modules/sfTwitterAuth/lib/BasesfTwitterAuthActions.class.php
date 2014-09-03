<?php


class BasesfTwitterAuthActions extends sfActions
{
  public function executeAuth(sfWebRequest $request)
  {
    $oauth_verifier = $request->getParameter('oauth_verifier');

    $twitter = new sfTwitter($this->getUser()->getFlash('oauth_token',null),$this->getUser()->getFlash('oauth_token_secret',null));

    $data = $twitter->getAccessToken($oauth_verifier);
    if ($data) {

      $user_data = $twitter->get('account/verify_credentials');

      var_dump($user_data->name);
    }

    return sfView::NONE;

  }

  public function executeSignin(sfWebRequest $request)
  {
    $twitter = new sfTwitter();

    $data = $twitter->getRequestToken($this->getContext()->getRouting()->generate('twitter_auth',array(),true));

    $this->getUser()->setFlash('oauth_token',$data['oauth_token']);
    $this->getUser()->setFlash('oauth_token_secret',$data['oauth_token_secret']);

    $url = $twitter->getAuthorizeUrl();
    if ($url) {
      $this->redirect($url);
    }

    /*


    if (!$facebook->getUser()) {
      return $this->redirect($facebook->getLoginUrl());
    } else {
      $guard_user = $facebook->findUserByEmail();
      if ($guard_user) {
        $this->getUser()->signIn($guard_user);
      } else {

        $conn = Doctrine_Manager::connection();
        try {
          $conn->beginTransaction();

          $profile = $facebook->getUserProfile();
          $genero = NULL;
          if ($profile['gender']=='male') $genero = 'Masculino';
            elseif($profile['gender']=='female') $genero = 'Femenino';

          $guard_user = new sfGuardUser();
          $guard_user->setEmailAddress($profile['email']);
          //$guard_user->setFacebookUid($profile['id']);
          $guard_user->setFirstName($profile['first_name']);
          $guard_user->setLastName($profile['last_name']);
          $guard_user->setGenero($genero);
          $guard_user->save();

          $postulante = new Postulante();
          $postulante->setUsuarioId($guard_user->getId());
          $postulante->save();

          $conn->commit();

          $this->getUser()->signIn($guard_user);

        } catch (Exception $e) {
          $conn->rollback();
          $this->logMessage('Fail to create user based on Facebook email: '.$e->getMessage(),'err');
        }
      }
      return $this->redirect(sfConfig::get('app_facebook_after_signin_url','@homepage'));
    }
    */
  }
}