<?php

Class paTestBrowser extends idTestBrowser
{
  public function login($username = 'user', $password = 'user')
  {
    $this->get('/')->
                setField('login', $username)->
                setField('password', $password)->
                click('Entra')->
                followRedirect();
     return $this;
  }
}