<?php
//C'est moi qui ai crée ce model
namespace Application\Models;

abstract class Contact
{
    protected $id;
    protected $name;
    protected $email;
    protected $message;
    protected $date;

    function _construct()
    {
    }

    //Getter & Setters

    /* function title()
    {
        return $this->title;
    }

    function content()
    {
        return $this->content;
    }*/

    function id()
    {
        return $this->id;
    }

    function name()
    {
        return $this->name;
    }
}
