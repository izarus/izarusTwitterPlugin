<?php


class BasesfTwitterAuthActions extends sfActions
{
  public function executeSigninSuccess(sfWebRequest $request)
  {
    var_dump($_POST); exit;
  }

  public function executeSignin(sfWebRequest $request)
  {
    $twitter = new sfTwitter();

    $twitter->getRequestToken();
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